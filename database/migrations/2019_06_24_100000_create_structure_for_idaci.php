<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForIdaci extends StructureMigration
{
    protected $permissions = [
        ['name' => 'idaci.getForPostCode', 'description' => 'Get IDACI score for post code', 'type' => 0, 'is_default' => true],
    ];

    protected $menu = [
      // 'name' => 'Students', 'icon' => 'child', 'route' => 'administration.students.index', 'order_index' => 150, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}

