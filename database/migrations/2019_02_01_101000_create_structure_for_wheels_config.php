<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForWheelsConfig extends StructureMigration
{
    protected $menu = [
        'name' => 'Wheel Builder', 'icon' => 'cogs', 'route' => null, 'order_index' => 300, 'has_children' => true,
    ];
}
