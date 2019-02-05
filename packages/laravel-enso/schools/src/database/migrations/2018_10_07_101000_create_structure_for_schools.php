<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForSchools extends StructureMigration
{
    protected $permissions = [
        ['name' => 'administration.schools.initTable', 'description' => 'Init table for schools', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.tableData', 'description' => 'Get table data for schools', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.exportExcel', 'description' => 'Export excel for schools', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.create', 'description' => 'Create school', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.edit', 'description' => 'Edit existing school', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.index', 'description' => 'Show schools', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.store', 'description' => 'Store newly created school', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.update', 'description' => 'Update edited school', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.destroy', 'description' => 'Delete school', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Schools', 'icon' => 'building', 'route' => 'administration.schools.index', 'order_index' => 250, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
