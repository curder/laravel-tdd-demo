<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'body'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
