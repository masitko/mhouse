<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForAreas extends StructureMigration
{
    protected $permissions = [
        ['name' => 'wheels.areas.index', 'description' => 'Show index for area', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.areas.create', 'description' => 'Create area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.store', 'description' => 'Store a new area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.show', 'description' => 'Show area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.edit', 'description' => 'Edit area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.update', 'description' => 'Update area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.destroy', 'description' => 'Delete area', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.areas.initTable', 'description' => 'Init table for area', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.areas.tableData', 'description' => 'Get table data for area', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.areas.exportExcel', 'description' => 'Export excel for area', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.areas.options', 'description' => 'Get area options for select', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Areas', 'icon' => 'layer-group', 'route' => 'wheels.areas.index', 'order_index' => 100, 'has_children' => false
    ];

    protected $parentMenu = 'Wheels Configuration';
}

