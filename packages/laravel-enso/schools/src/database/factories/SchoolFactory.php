<?php

use Faker\Generator as Faker;
use LaravelEnso\Schools\app\Models\School;

$factory->define(School::class, function (Faker $faker) {
    return [
        'mandatary_id' => null,
        'name' => $faker->word,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'obs' => $faker->sentence,
    ];
});
