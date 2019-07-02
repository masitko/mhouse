<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForLogos extends StructureMigration
{
  protected $permissions = [
    ['name' => 'administration.schools.getLogo', 'description' => 'Get logo for schools', 'type' => 0, 'is_default' => true],
    ['name' => 'administration.schools.logoUpload', 'description' => 'Upload logo for schools', 'type' => 1, 'is_default' => true],
  ];

  protected $menu = [];

  protected $parentMenu = 'School';
}
