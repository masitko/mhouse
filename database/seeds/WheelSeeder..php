<?php

use Illuminate\Database\Seeder;
use App\Wheel;

class WheelSeeder extends Seeder
{
  private const Wheels = [
    ['name' => 'Primary Wheel',   'description' => '', 'layers' => 6, 'is_active' => true],
    ['name' => 'Secondary Wheel', 'description' => '', 'layers' => 6, 'is_active' => true],
    ['name' => 'Keyworker Wheel', 'description' => '', 'layers' => 6, 'is_active' => true],
    ['name' => 'Work Life Ready', 'description' => '', 'layers' => 6, 'is_active' => true],
  ];

  public function run()
  {
    $areas = collect(self::Wheels)->map(function ($wheel) {
      return factory(Wheel::class)->create($wheel);
    });
  }
}
