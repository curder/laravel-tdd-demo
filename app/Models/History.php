<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class History.
 */
class History extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function getSupplierAttribute()
    {
        return $this->user->supplier;
    }
}
