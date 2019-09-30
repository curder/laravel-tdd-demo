<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\History;
use App\User;
use Faker\Generator as Faker;

$factory->define(History::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
    ];
});
