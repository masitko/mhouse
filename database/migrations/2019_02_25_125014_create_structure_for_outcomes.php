<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForOutcomes extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.outcomes.index', 'description' => 'Show index for outcome', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.create', 'description' => 'Create outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.store', 'description' => 'Store a new outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.show', 'description' => 'Show outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.edit', 'description' => 'Edit outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.update', 'description' => 'Update outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.destroy', 'description' => 'Delete outcome', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.outcomes.initTable', 'description' => 'Init table for outcome', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.tableData', 'description' => 'Get table data for outcome', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.exportExcel', 'description' => 'Export excel for outcome', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.options', 'description' => 'Get outcome options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.getWheel', 'description' => 'Get outcome wheel info', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.outcomes.storeWheel', 'description' => 'Store outcomes', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Outcomes', 'icon' => 'clipboard', 'route' => 'schools.outcomes.index', 'order_index' => 300, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

