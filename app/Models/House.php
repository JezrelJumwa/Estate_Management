<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'house_number',
        'rent',
        'house_type',
        'file_path',
        'file_name',
        'description',
    ];

    protected $casts = [
        'rent' => 'decimal:2',
    ];

    /**
     * Get the landlord who owns this house.
     */
    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    /**
     * Get all estates associated with this house
     */
    public function estates(): HasMany
    {
        return $this->hasMany(Estate::class);
    }

    /**
     * Get all bookings for this house
     */
    public function houseBookings(): HasMany
    {
        return $this->hasMany(HouseBooking::class);
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->file_path) {
            return Storage::url($this->file_path);
        }
        return null;
    }

    /**
     * Check if house is available
     */
    public function isAvailable(): bool
    {
        return !$this->houseBookings()
            ->whereHas('booking', function ($query) {
                $query->where('status', 'UNAVAILABLE');
            })
            ->exists();
    }
}
