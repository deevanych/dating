<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property BelongsTo type
 */
class UserInterest extends Model
{
    //
    use HasFactory;

    protected $appends = [
        'type'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(UserInterestType::class, 'user_interest_type_id', 'id');
    }

    public function getTypeAttribute(): string {
        return $this->type()->pluck('title')[0];
    }
}
