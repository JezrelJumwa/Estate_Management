<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_booking_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'transaction_reference',
        'provider_response',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'provider_response' => 'array',
            'paid_at' => 'datetime',
            'amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function houseBooking(): BelongsTo
    {
        return $this->belongsTo(HouseBooking::class);
    }
}
