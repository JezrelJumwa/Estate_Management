<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'house_id',
    ];

    /**
     * Get the house that belongs to this estate
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }
}
