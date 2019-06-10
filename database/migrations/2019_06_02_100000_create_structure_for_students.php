<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForStudents extends StructureMigration
{
    protected $permissions = [
        // ['name' => 'administration.users.students', 'description' => 'Show students', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.initTable', 'description' => 'Init table for students', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.tableData', 'description' => 'Get table data for students', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.exportExcel', 'description' => 'Export excel for students', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.create', 'description' => 'Create user', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.students.edit', 'description' => 'Edit existing user', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.students.index', 'description' => 'Show students', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.students.show', 'description' => 'Display user information', 'type' => 0, 'is_default' => true],
        ['name' => 'administration.students.store', 'description' => 'Store newly created user', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.students.update', 'description' => 'Update edited user', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.students.destroy', 'description' => 'Delete user', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
      'name' => 'Students', 'icon' => 'child', 'route' => 'administration.students.index', 'order_index' => 150, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}

