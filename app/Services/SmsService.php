<?php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\User;

class SmsService
{
    public function send(string $recipient, string $message, ?User $user = null): SmsLog
    {
        return SmsLog::create([
            'user_id' => $user?->id,
            'recipient' => $recipient,
            'message' => $message,
            'status' => 'SENT',
            'provider_response' => 'Simulated SMS delivery',
        ]);
    }
}
