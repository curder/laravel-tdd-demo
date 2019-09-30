<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video;
use App\User;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => $faker->title,
        'url' => $faker->url,
        'description' => $faker->sentence,
        'size' => $faker->randomFloat(10, 30),
        'length' => $faker->numberBetween(100,5000)
    ];
});
