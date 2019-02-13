<?php

use Faker\Generator as Faker;
use App\Observation;

$factory->define(Observation::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order' => $faker->randomNumber(),
    ];
});
