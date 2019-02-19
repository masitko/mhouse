<?php

use Illuminate\Database\Seeder;
use App\Area;
use LaravelEnso\PermissionManager\app\Models\Permission;

class AreaSeeder extends Seeder
{
    private const Areas = [
        [ 'name' => 'Personal independence', 'description' => 'Personal independence', 'order' => 10, 'colour' => '#C5D1EB'],
        [ 'name' => 'Daily and living skills', 'description' => 'Daily and living skills', 'order' => 20, 'colour' => '#8DFFCD'],
        [ 'name' => 'Money management', 'description' => 'Money management', 'order' => 30, 'colour' => '#B98EA7'],
        [ 'name' => 'Accessing the community', 'description' => 'Accessing the community', 'order' => 40, 'colour' => '#77B28C'],
        [ 'name' => 'Work ready/employability', 'description' => 'Work ready/employability', 'order' => 50, 'colour' => '#CBE896'],
        [ 'name' => 'Health and well-being', 'description' => 'Health and well-being', 'order' => 60, 'colour' => '#FFC09F'],
        [ 'name' => 'Learning and development', 'description' => 'Learning and development', 'order' => 70, 'colour' => '#58A4B0'],
    ];

    public function run()
    {
        $areas = collect(self::Areas)->map(function ($area) {
            return factory(Area::class)->create($area);
        });

    }
}
