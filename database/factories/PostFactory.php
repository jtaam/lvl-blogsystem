<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 20),
        'title' => $faker->sentence(12, true),
        'slug' => $faker->unique()->slug(12, true),
        'post_promo' => $faker->paragraph,
        'image' => $faker->imageUrl(1600, 1066),
        'body' => $faker->paragraphs(4, true),
        'view_count' => rand(0, 15),
        'status' => rand(1, 0),
        'is_approved' => rand(1, 0),
    ];
});
