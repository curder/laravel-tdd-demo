<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App\Models
 */
class Image extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'url', 'imageable_id', 'imageable_type'
    ];

    /**
     * Get the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
