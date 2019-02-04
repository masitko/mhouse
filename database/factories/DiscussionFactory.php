<?php

use Faker\Generator as Faker;
use LaravelEnso\Schools\app\Models\School;
use LaravelEnso\Discussions\app\Models\Discussion;

$factory->define(Discussion::class, function (Faker $faker) {
    return [
        'discussable_id' => function () {
            return factory(School::class)->create()->id;
        },
        'discussable_type' => School::class,
        'body' => $faker->sentence,
        'title' => $faker->sentence,
    ];
});
