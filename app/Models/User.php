<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property HasMany photos
 * @property int age
 * @property int id
 * @property string name
 * @property string|null birthday_date
 * @property string city
 * @property boolean sex (1 - male, 0 - female)
 * @property string|null about
 * @property string|null status
 * @property string email
 * @property boolean is_verified (1 - verified, 0 - not verified)
 * @property string|null created_at
 * @property string|null updated_at
 */
class User extends Model
{
    use HasFactory;

    protected $with = [
        'photos',
        'interests',
    ];

    protected $appends = [
        'age',
    ];

    public function getAgeAttribute(): int {
        return Carbon::parse($this->birthday_date)->diffInYears();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(UserPhoto::class)->orderBy('is_default', 'desc');
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(UserInterest::class);
    }
}
