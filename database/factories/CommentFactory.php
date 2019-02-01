<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'post_id'=>rand(1,150),
        'user_id'=>rand(1,20),
        'comment'=>$faker->paragraph,
    ];
});
