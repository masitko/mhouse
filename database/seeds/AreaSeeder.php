<?php

use Illuminate\Database\Seeder;
use App\Area;
use LaravelEnso\PermissionManager\app\Models\Permission;

class AreaSeeder extends Seeder
{
    private const Areas = [
        [ 'name' => 'Personal independence', 'description' => 'Personal independence', 'order' => 10],
        [ 'name' => 'Daily and living skills', 'description' => 'Daily and living skills', 'order' => 20],
        [ 'name' => 'Money management', 'description' => 'Money management', 'order' => 30],
        [ 'name' => 'Accessing the community', 'description' => 'Accessing the community', 'order' => 40],
        [ 'name' => 'Work ready/employability', 'description' => 'Work ready/employability', 'order' => 50],
        [ 'name' => 'Health and well-being', 'description' => 'Health and well-being', 'order' => 60],
        [ 'name' => 'Learning and development', 'description' => 'Learning and development', 'order' => 70],
    ];

    public function run()
    {
        $areas = collect(self::Areas)->map(function ($area) {
            return factory(Area::class)->create($area);
        });

    }
}
