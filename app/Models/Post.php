<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Post.
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'body',
    ];

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
     * With this attribute defined it can be used as $this->country.
     */
    public function getCountryAttribute()
    {
        return $this->user->country;
    }
}
