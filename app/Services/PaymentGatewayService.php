<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentGatewayService
{
    /**
     * Simulate payment gateway charge.
     */
    public function charge(Payment $payment): array
    {
        $approved = true;

        return [
            'success' => $approved,
            'reference' => 'PAY-' . Str::upper(Str::random(10)),
            'message' => $approved ? 'Payment accepted by gateway.' : 'Payment failed at gateway.',
            'provider' => config('services.payment.provider', 'SIMULATED'),
        ];
    }
}
