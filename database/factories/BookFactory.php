<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'author' => $faker->name,
        'summary' => $faker->paragraph,
        'image'=>'bookcase-books-bookshelf-1166657.jpg',
        'price'=>$faker->randomNumber(2),
        'user_id'=>'1'
    ];
});
