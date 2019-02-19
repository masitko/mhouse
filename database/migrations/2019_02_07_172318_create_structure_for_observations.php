<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForObservations extends StructureMigration
{
    protected $permissions = [
        ['name' => 'wheels.observations.index', 'description' => 'Show index for observation', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.observations.create', 'description' => 'Create observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.store', 'description' => 'Store a new observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.show', 'description' => 'Show observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.edit', 'description' => 'Edit observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.update', 'description' => 'Update observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.destroy', 'description' => 'Delete observation', 'type' => 1, 'is_default' => false],
        ['name' => 'wheels.observations.initTable', 'description' => 'Init table for observation', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.observations.tableData', 'description' => 'Get table data for observation', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.observations.exportExcel', 'description' => 'Export excel for observation', 'type' => 0, 'is_default' => false],
        ['name' => 'wheels.observations.options', 'description' => 'Get observation options for select', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Observations', 'icon' => 'clipboard', 'route' => 'wheels.observations.index', 'order_index' => 200, 'has_children' => false
    ];

    protected $parentMenu = 'Wheel Builder';
}

