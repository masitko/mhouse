<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForTerms extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.terms.index', 'description' => 'Show index for term', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.terms.create', 'description' => 'Create term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.store', 'description' => 'Store a new term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.show', 'description' => 'Show term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.edit', 'description' => 'Edit term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.update', 'description' => 'Update term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.destroy', 'description' => 'Delete term', 'type' => 1, 'is_default' => false],
        ['name' => 'schools.terms.initTable', 'description' => 'Init table for term', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.terms.tableData', 'description' => 'Get table data for term', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.terms.exportExcel', 'description' => 'Export excel for term', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.terms.options', 'description' => 'Get term options for select', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Terms', 'icon' => 'terms', 'route' => 'schools.terms.index', 'order_index' => 10, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

