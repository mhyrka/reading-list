<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\books;
use Faker\Generator as Faker;

$factory->define(books::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'author_first' => $faker->firstName,
        'author_last' => $faker->lastName,
        'publisher' => $faker->company,
        'isbn' => $faker->uuid
    ];
});
