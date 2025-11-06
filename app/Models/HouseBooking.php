<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HouseBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_id',
        'booking_id',
    ];

    /**
     * Get the user who made the booking
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the house that was booked
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    /**
     * Get the booking status
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
