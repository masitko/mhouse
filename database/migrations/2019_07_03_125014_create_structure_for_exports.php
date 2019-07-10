<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForExports extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.exports.index', 'description' => 'Show index for export', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.exports.initTable', 'description' => 'Init table for export', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.exports.tableData', 'description' => 'Get table data for export', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.exports.exportExcel', 'description' => 'Export excel for export', 'type' => 0, 'is_default' => false],
        // ['name' => 'schools.exports.getChart', 'description' => 'Get chart', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Exports', 'icon' => 'file-export', 'route' => 'schools.exports.index', 'order_index' => 600, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

