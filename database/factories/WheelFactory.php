<?php

use Faker\Generator as Faker;
use App\Wheel;

$factory->define(Wheel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'layers' => $faker->randomNumber(),
    ];
});
