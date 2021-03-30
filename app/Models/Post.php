<?php

namespace App\Models;

use App\User;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Post.
 */
class Post extends Model
{
    use GeneratesUuid;

    protected $uuidVersion = 'ordered';

    /**
     * @var array
     */
    protected $fillable = [
        'uuid', 'user_id', 'title', 'description', 'body',
    ];

    public static function boot()
    {
        parent::boot();

        self::updating(static function (Post $model) {
            if ($model->isDirty('uuid')) {
                $model->uuid = $model->getOriginal('uuid');
            }
        });
    }

    /**
     * @return UuidInterface
     * @throws InvalidUuidStringException
     */
    public function getUuidAttribute(): ?UuidInterface
    {
        $attribute = $this->attributes[$this->getRouteKeyName()] ?? null;

        return ! $attribute ? null : Uuid::fromString($attribute);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * With this attribute defined it can be used as $this->country.
     */
    public function getCountryAttribute()
    {
        return $this->user->country;
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
