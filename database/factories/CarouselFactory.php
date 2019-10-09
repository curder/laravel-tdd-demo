<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Carousel;
use Faker\Generator as Faker;

$factory->define(Carousel::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'link' => $faker->url,
        'src' => $faker->url,
    ];
});
