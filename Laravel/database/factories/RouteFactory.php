<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Route::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
        'length' => $faker->randomDigit,
    ];
});
