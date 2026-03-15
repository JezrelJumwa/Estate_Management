<?php

namespace App\Http\Controllers;

use App\Models\HouseBooking;
use App\Models\MaintenanceRequest;
use App\Models\Payment;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue = (float) Payment::where('status', 'PAID')->sum('amount');
        $paidPayments = Payment::where('status', 'PAID')->count();
        $pendingMaintenance = MaintenanceRequest::whereIn('status', ['OPEN', 'IN_PROGRESS'])->count();
        $occupiedHouses = HouseBooking::whereHas('booking', function ($query) {
            $query->where('status', 'UNAVAILABLE');
        })->count();

        return view('reports.index', compact('totalRevenue', 'paidPayments', 'pendingMaintenance', 'occupiedHouses'));
    }

    public function paymentsCsv(): Response
    {
        $rows = Payment::with('user')->latest()->get();

        $csv = "id,user,amount,currency,status,reference,created_at\n";
        foreach ($rows as $payment) {
            $csv .= implode(',', [
                $payment->id,
                '"' . ($payment->user?->full_name ?? 'N/A') . '"',
                $payment->amount,
                $payment->currency,
                $payment->status,
                $payment->transaction_reference,
                $payment->created_at,
            ]) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payments-report.csv"',
        ]);
    }
}
