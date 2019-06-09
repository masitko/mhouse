<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForOutcomesHistory extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.outcomes.history', 'description' => 'Show index for outcome history', 'type' => 0, 'is_default' => true],
    ];

    protected $menu = [
        'name' => 'Outcomes History', 'icon' => 'clipboard', 'route' => 'schools.outcomes.history', 'order_index' => 400, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

