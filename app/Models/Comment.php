<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Comment.
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'body',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
