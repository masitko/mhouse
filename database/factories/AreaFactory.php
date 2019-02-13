<?php

use Faker\Generator as Faker;
use App\Area;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order' => $faker->randomNumber(),
    ];
});
