<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carousel
 *
 * @property string $title
 * @property string $link
 * @property string src
 *
 * @package App\Models
 */
class Carousel extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'link', 'src',
    ];
}
