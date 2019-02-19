<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForWheels extends StructureMigration
{
    protected $permissions = [
        ['name' => 'wheels.wheels.index', 'description' => 'Show index for wheel', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.wheels.create', 'description' => 'Create wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.store', 'description' => 'Store a new wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.show', 'description' => 'Show wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.edit', 'description' => 'Edit wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.update', 'description' => 'Update wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.destroy', 'description' => 'Delete wheel', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.wheels.initTable', 'description' => 'Init table for wheel', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.wheels.tableData', 'description' => 'Get table data for wheel', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.wheels.exportExcel', 'description' => 'Export excel for wheel', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.wheels.options', 'description' => 'Get wheel options for select', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Wheels', 'icon' => 'dharmachakra', 'route' => 'wheels.wheels.index', 'order_index' => 300, 'has_children' => false
    ];

    protected $parentMenu = 'Wheel Builder';
}

