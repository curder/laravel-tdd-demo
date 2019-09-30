<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class Supplier.
 */
class Supplier extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
       'name', 'services',
    ];

    /**
     * @return HasOneThrough
     */
    public function userHistory()
    {
        return $this->hasOneThrough(History::class, User::class);
    }
}
