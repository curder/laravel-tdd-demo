<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App\Models
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
