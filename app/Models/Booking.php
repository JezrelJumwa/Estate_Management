<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    /**
     * Get all house bookings with this booking status
     */
    public function houseBookings(): HasMany
    {
        return $this->hasMany(HouseBooking::class);
    }
}
