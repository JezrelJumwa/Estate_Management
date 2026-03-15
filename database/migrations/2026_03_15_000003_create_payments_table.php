<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('house_booking_id')->nullable()->constrained('house_bookings')->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('KES');
            $table->string('payment_method', 50)->default('MOBILE_MONEY');
            $table->string('status', 30)->default('PENDING');
            $table->string('transaction_reference', 120)->unique();
            $table->json('provider_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
