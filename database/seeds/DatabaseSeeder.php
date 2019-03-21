<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserGroupSeeder::class,
            UserSeeder::class,
            LanguageSeeder::class,
            CountrySeeder::class,
            WheelSeeder::class,
            AreaSeeder::class,
            ObservationSeeder::class,
            SchoolSeeder::class,
        ]);
    }
}
