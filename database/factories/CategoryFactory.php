<?php

use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->word,
        'slug'=>$faker->unique()->slug,
        'public_id'=>$faker->word,
        'image'=>$faker->imageUrl(1600,479),
    ];
});
