<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForSchoolClasses extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.classes.index', 'description' => 'Show index for school class', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.classes.create', 'description' => 'Create school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.store', 'description' => 'Store a new school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.show', 'description' => 'Show school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.edit', 'description' => 'Edit school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.update', 'description' => 'Update school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.destroy', 'description' => 'Delete school class', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.classes.initTable', 'description' => 'Init table for school class', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.classes.tableData', 'description' => 'Get table data for school class', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.classes.exportExcel', 'description' => 'Export excel for school class', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.classes.options', 'description' => 'Get school class options for select', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Classes', 'icon' => 'users', 'route' => 'schools.classes.index', 'order_index' => 20, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

