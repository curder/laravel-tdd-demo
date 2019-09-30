<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Post;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'post_id' => factory(Post::class)->create()->id,
        'body' => $faker->sentence,
    ];
});
