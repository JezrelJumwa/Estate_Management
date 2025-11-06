<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_role_id',
        'menu_name',
        'page',
    ];

    /**
     * Get the system role that owns this right
     */
    public function systemRole(): BelongsTo
    {
        return $this->belongsTo(SystemRole::class);
    }
}
