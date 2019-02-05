<?php

use Faker\Generator as Faker;
use LaravelEnso\Schools\app\Models\School;

$factory->define(School::class, function (Faker $faker) {
    return [
        'mandatary_id' => null,
        'name' => $faker->school,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'bank' => $faker->school,
        'bank_account' => $faker->bankAccountNumber,
        'obs' => $faker->sentence,
        'pays_vat' => $faker->boolean,
    ];
});
