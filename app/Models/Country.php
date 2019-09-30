<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

/**
 * Class Country
 * @property Collection posts
 * @package App\Models
 */
class Country extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'population',
    ];

    /**
     * @return HasManyThrough
     */
    public function posts() : HasManyThrough
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}
