<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForChecklists extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.checklists.index', 'description' => 'Show index for checklist', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.checklists.initTable', 'description' => 'Init table for checklist', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.checklists.tableData', 'description' => 'Get table data for checklist', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.checklists.exportExcel', 'description' => 'Export excel for checklist', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Checklists', 'icon' => 'clipboard', 'route' => 'schools.checklists.index', 'order_index' => 500, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

