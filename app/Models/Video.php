<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video
 *
 * @package App\Models
 */
class Video extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'url',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
