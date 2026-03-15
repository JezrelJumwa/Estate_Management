<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PaymentGatewayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{
    public function store(Request $request, PaymentGatewayService $gateway): JsonResponse
    {
        $validated = $request->validate([
            'house_booking_id' => ['nullable', 'exists:house_bookings,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => ['nullable', 'string', 'max:50'],
        ]);

        $payment = Payment::create([
            'user_id' => $request->user()->id,
            'house_booking_id' => $validated['house_booking_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'] ?? 'MOBILE_MONEY',
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

        return response()->json($payment->fresh(), $result['success'] ? 201 : 422);
    }
}
