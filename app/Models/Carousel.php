<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carousel
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
