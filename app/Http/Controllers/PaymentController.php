<?php

namespace App\Http\Controllers;

use App\Models\HouseBooking;
use App\Models\Payment;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $query = Payment::with(['user', 'houseBooking.house'])->latest();

        if (! Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        $payments = $query->paginate(12);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = HouseBooking::with('house')
            ->when(! Auth::user()->isAdmin(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('payments.create', compact('bookings'));
    }

    public function store(Request $request, PaymentGatewayService $gateway)
    {
        $validated = $request->validate([
            'house_booking_id' => ['nullable', 'exists:house_bookings,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => ['required', 'string', 'max:50'],
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'house_booking_id' => $validated['house_booking_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'transaction_reference' => 'TMP-' . strtoupper(uniqid()),
            'status' => 'PENDING',
        ]);

        $result = $gateway->charge($payment);

        $payment->update([
            'status' => $result['success'] ? 'PAID' : 'FAILED',
            'transaction_reference' => $result['reference'],
            'provider_response' => $result,
            'paid_at' => $result['success'] ? now() : null,
        ]);

        return redirect()->route('payments.index')
            ->with('success', $result['success'] ? 'Payment processed successfully.' : 'Payment failed.');
    }
}
