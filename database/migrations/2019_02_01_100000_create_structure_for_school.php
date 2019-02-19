<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForSchool extends StructureMigration
{
    protected $menu = [
        'name' => 'School', 'icon' => 'hotel', 'route' => null, 'order_index' => 200, 'has_children' => true,
    ];
}
