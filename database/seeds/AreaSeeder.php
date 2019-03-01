<?php

use Illuminate\Database\Seeder;
use App\Area;
use LaravelEnso\PermissionManager\app\Models\Permission;

class AreaSeeder extends Seeder
{
  private const Areas = [
    ['name' => 'Personal independence', 'description' => 'Description for Personal independence', 'order' => 10, 'colour' => '#C5D1EB'],
    ['name' => 'Daily and living skills', 'description' => 'Description for Daily and living skills', 'order' => 20, 'colour' => '#8DFFCD'],
    ['name' => 'Money management', 'description' => 'Description for Money management', 'order' => 30, 'colour' => '#B98EA7'],
    ['name' => 'Accessing the community', 'description' => 'Description for Accessing the community', 'order' => 40, 'colour' => '#2F60BC'],
    ['name' => 'Work ready/employability', 'description' => 'Description for Work ready/employability', 'order' => 50, 'colour' => '#CBE896'],
    ['name' => 'Health and well-being', 'description' => 'Description for Health and well-being', 'order' => 60, 'colour' => '#8D89A6'],
    ['name' => 'Learning and development', 'description' => 'Description for Learning and development', 'order' => 70, 'colour' => '#77B28C'],

    ['name' => 'Self Awareness', 'description' => 'Description for Self Awareness', 'order' => 10, 'colour' => '#C5D1EB'],
    ['name' => 'Managing Feelings', 'description' => 'Description Managing Feelings', 'order' => 20, 'colour' => '#8DFFCD'],
    ['name' => 'Motivation', 'description' => 'Motivation', 'order' => 30, 'colour' => '#B98EA7'],
    ['name' => 'Empathy', 'description' => 'Description for Empathy', 'order' => 40, 'colour' => '#2F60BC'],
    ['name' => 'Social Skills', 'description' => 'Description for Social Skills', 'order' => 50, 'colour' => '#CBE896'],
    ['name' => 'Task Orientation', 'description' => 'Description for Task Orientation', 'order' => 60, 'colour' => '#8D89A6'],
    ['name' => 'Classroom Conformity', 'description' => 'Description for Classroom Conformity', 'order' => 70, 'colour' => '#77B28C'],

  ];

  public function run()
  {
    $areas = collect(self::Areas)->map(function ($area) {
      return factory(Area::class)->create($area);
    });
  }
}
