<?php

use Illuminate\Database\Seeder;

use LaravelEnso\Schools\app\Models\School;


class SchoolSeeder extends Seeder
{
    private const Schools = [
        [ 'name' => 'Muntham House'],
    ];

    public function run()
    {
        $schools = collect(self::Schools)->map(function ($school) {
            return factory(School::class)->create($school);
        });

    }
}
