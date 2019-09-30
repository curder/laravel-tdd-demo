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
}
