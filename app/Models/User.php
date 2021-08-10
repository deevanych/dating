<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string|null birthday_date
 * @property string city
 * @property boolean sex (1 - male, 0 - female)
 * @property string|null about
 * @property string|null status
 * @property Collection photos
 * @property int age
 * @property string email
 * @property boolean is_verified (1 - verified, 0 - not verified)
 * @property string|null created_at
 * @property string|null updated_at
 */
class User extends Model
{
    use HasFactory;

    protected $with = [
        'interests',
    ];

    protected $hidden = [
        'photosRelation',
    ];

    protected $appends = [
        'age',
        'photos',
    ];

    public function getAgeAttribute(): int {
        return Carbon::parse($this->birthday_date)->diffInYears();
    }

    public function photosRelation(): HasMany
    {
        return $this->hasMany(UserPhoto::class)->orderBy('is_default', 'desc');
    }

    public function getPhotosAttribute(): Collection
    {
        $photos = $this->photosRelation()->get();

        if ($photos->count() === 0) {
            $photos = new Collection();
            $photo = new UserPhoto();
            $photo->url = 'https:\/\/via.placeholder.com\/400x600.png\/00aa66?text=MY';
            $photos->add($photo);
        }

        return $photos;
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(UserInterest::class);
    }
}
