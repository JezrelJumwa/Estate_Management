<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Document;
use App\Models\House;
use App\Models\HouseBooking;
use App\Models\Payment;
use App\Models\SystemRole;
use App\Models\User;
use App\Notifications\RentReminderNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdvancedFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_login_returns_token_for_valid_credentials(): void
    {
        $tenant = $this->createUserWithRole('TENANT');

        $response = $this->postJson('/api/auth/login', [
            'email' => $tenant->email,
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'token',
                'user' => ['id', 'name', 'email', 'role'],
            ]);

        $tenant->refresh();
        $this->assertNotNull($tenant->api_token);
    }

    public function test_api_protected_route_requires_token(): void
    {
        $response = $this->getJson('/api/houses');

        $response->assertUnauthorized()
            ->assertJsonPath('message', 'Missing API token.');
    }

    public function test_api_booking_and_payment_flow_with_token(): void
    {
        $tenant = $this->createUserWithRole('TENANT');
        $landlord = $this->createUserWithRole('LANDLORD');

        $house = House::create([
            'landlord_id' => $landlord->id,
            'house_number' => 101,
            'rent' => 25000,
            'house_type' => 'Apartment',
            'description' => 'API test house',
        ]);

        $availableStatus = Booking::query()->where('status', 'AVAILABLE')->firstOrFail();

        $token = $this->postJson('/api/auth/login', [
            'email' => $tenant->email,
            'password' => 'password',
        ])->json('token');

        $bookingResponse = $this->withToken($token)->postJson('/api/bookings', [
            'house_id' => $house->id,
            'booking_id' => $availableStatus->id,
        ]);

        $bookingResponse->assertCreated();

        $paymentResponse = $this->withToken($token)->postJson('/api/payments', [
            'house_booking_id' => $bookingResponse->json('id'),
            'amount' => 25000,
            'payment_method' => 'CARD',
        ]);

        $paymentResponse->assertCreated()
            ->assertJsonPath('status', 'PAID');

        $this->assertDatabaseHas('payments', [
            'user_id' => $tenant->id,
            'status' => 'PAID',
        ]);
    }

    public function test_tenant_portal_is_only_accessible_to_tenants(): void
    {
        $tenant = $this->createUserWithRole('TENANT');
        $landlord = $this->createUserWithRole('LANDLORD');

        $this->actingAs($tenant)
            ->get(route('tenant.portal'))
            ->assertOk();

        $this->actingAs($landlord)
            ->get(route('tenant.portal'))
            ->assertForbidden();
    }

    public function test_tenant_can_create_maintenance_request_and_sms_log_is_recorded(): void
    {
        $tenant = $this->createUserWithRole('TENANT');
        $landlord = $this->createUserWithRole('LANDLORD');

        $house = House::create([
            'landlord_id' => $landlord->id,
            'house_number' => 202,
            'rent' => 18000,
            'house_type' => 'Bedsitter',
            'description' => 'Maintenance house',
        ]);

        $response = $this->actingAs($tenant)->post(route('maintenance-requests.store'), [
            'house_id' => $house->id,
            'title' => 'Leaking sink',
            'description' => 'Kitchen sink has a leak.',
            'priority' => 'HIGH',
        ]);

        $response->assertRedirect(route('maintenance-requests.index'));

        $this->assertDatabaseHas('maintenance_requests', [
            'user_id' => $tenant->id,
            'house_id' => $house->id,
            'title' => 'Leaking sink',
            'status' => 'OPEN',
        ]);

        $this->assertDatabaseHas('sms_logs', [
            'user_id' => $tenant->id,
            'recipient' => $tenant->id_number,
            'status' => 'SENT',
        ]);
    }

    public function test_user_can_upload_and_download_own_private_document(): void
    {
        Storage::fake('public');

        $tenant = $this->createUserWithRole('TENANT');

        $uploadResponse = $this->actingAs($tenant)->post(route('documents.store'), [
            'name' => 'Lease Agreement',
            'file' => UploadedFile::fake()->create('lease.pdf', 100, 'application/pdf'),
            'visibility' => 'PRIVATE',
        ]);

        $uploadResponse->assertRedirect(route('documents.index'));

        $document = Document::query()->firstOrFail();

        $this->actingAs($tenant)
            ->get(route('documents.download', $document))
            ->assertOk();
    }

    public function test_private_document_is_forbidden_to_other_non_admin_users(): void
    {
        Storage::fake('public');

        $owner = $this->createUserWithRole('TENANT');
        $otherTenant = $this->createUserWithRole('TENANT');

        Storage::disk('public')->put('documents/private-note.txt', 'secret');

        $document = Document::create([
            'user_id' => $owner->id,
            'name' => 'Private Note',
            'file_path' => 'documents/private-note.txt',
            'mime_type' => 'text/plain',
            'size' => 6,
            'visibility' => 'PRIVATE',
        ]);

        $this->actingAs($otherTenant)
            ->get(route('documents.download', $document))
            ->assertForbidden();
    }

    public function test_admin_can_access_reports_and_download_csv(): void
    {
        $admin = $this->createUserWithRole('ADMINISTRATOR');
        $tenant = $this->createUserWithRole('TENANT');

        Payment::create([
            'user_id' => $tenant->id,
            'amount' => 5000,
            'payment_method' => 'MOBILE_MONEY',
            'status' => 'PAID',
            'transaction_reference' => 'PAY-REPORT-001',
            'provider_response' => ['message' => 'ok'],
            'paid_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('reports.index'))
            ->assertOk();

        $this->actingAs($admin)
            ->get(route('reports.payments.csv'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }

    public function test_locale_switch_updates_session_for_supported_locale(): void
    {
        $response = $this->from('/dashboard')->get(route('locale.switch', 'sw'));

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('locale', 'sw');
    }

    public function test_rent_reminder_command_sends_notifications_and_sms_logs(): void
    {
        Notification::fake();

        $tenant = $this->createUserWithRole('TENANT');
        $landlord = $this->createUserWithRole('LANDLORD');

        $house = House::create([
            'landlord_id' => $landlord->id,
            'house_number' => 303,
            'rent' => 32000,
            'house_type' => 'Maisonette',
            'description' => 'Reminder house',
        ]);

        $unavailableStatus = Booking::query()->where('status', 'UNAVAILABLE')->firstOrFail();

        HouseBooking::create([
            'user_id' => $tenant->id,
            'house_id' => $house->id,
            'booking_id' => $unavailableStatus->id,
        ]);

        $this->artisan('rent:send-reminders')
            ->assertSuccessful();

        Notification::assertSentTo($tenant, RentReminderNotification::class);

        $this->assertDatabaseHas('sms_logs', [
            'user_id' => $tenant->id,
            'recipient' => $tenant->id_number,
            'status' => 'SENT',
        ]);
    }

    private function createUserWithRole(string $role): User
    {
        $roleId = SystemRole::query()->where('name', strtoupper($role))->value('id');

        return User::factory()->create([
            'system_role_id' => $roleId,
            'status_id' => 1,
        ]);
    }
}
