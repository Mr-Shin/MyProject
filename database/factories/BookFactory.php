<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'author' => $faker->name,
        'summary' => $faker->paragraph,
        'image'=>'Screenshot (5)_1567246975.png',
        'user_id'=>'1'
    ];
});
