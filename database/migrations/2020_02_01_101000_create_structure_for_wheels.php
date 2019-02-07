<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForWheels extends StructureMigration
{
    protected $menu = [
        'name' => 'Wheels Configuration', 'icon' => 'cogs', 'route' => null, 'order_index' => 580, 'has_children' => true,
    ];
}
