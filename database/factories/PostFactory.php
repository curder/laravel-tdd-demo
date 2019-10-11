<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'user_id' => factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
