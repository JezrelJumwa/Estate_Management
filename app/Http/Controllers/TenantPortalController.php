<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\HouseBooking;
use App\Models\MaintenanceRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class TenantPortalController extends Controller
{
    public function index()
    {
        $tenantId = Auth::id();

        $bookings = HouseBooking::with(['house', 'booking'])
            ->where('user_id', $tenantId)
            ->latest()
            ->get();

        $maintenanceRequests = MaintenanceRequest::where('user_id', $tenantId)->latest()->get();
        $payments = Payment::where('user_id', $tenantId)->latest()->get();
        $documents = Document::where('user_id', $tenantId)->latest()->get();

        return view('tenant.portal', compact('bookings', 'maintenanceRequests', 'payments', 'documents'));
    }
}
