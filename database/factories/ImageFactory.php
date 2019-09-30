<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use App\User;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(),
        'imageable_id' => factory(User::class)->create()->id,
        'imageable_type' => User::class,
    ];
});
