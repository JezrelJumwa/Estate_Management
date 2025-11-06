<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_number',
        'first_name',
        'last_name',
        'other_name',
        'gender',
        'status_id',
        'system_role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the status of the user
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the system role of the user
     */
    public function systemRole(): BelongsTo
    {
        return $this->belongsTo(SystemRole::class);
    }

    /**
     * Get all house bookings for this user
     */
    public function houseBookings(): HasMany
    {
        return $this->hasMany(HouseBooking::class);
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $roleName): bool
    {
        return $this->systemRole->name === strtoupper($roleName);
    }

    /**
     * Check if user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('ADMINISTRATOR');
    }

    /**
     * Check if user is a landlord
     */
    public function isLandlord(): bool
    {
        return $this->hasRole('LANDLORD');
    }

    /**
     * Check if user is a tenant
     */
    public function isTenant(): bool
    {
        return $this->hasRole('TENANT');
    }
}
