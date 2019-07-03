<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForReports extends StructureMigration
{
    protected $permissions = [
        ['name' => 'schools.reports.index', 'description' => 'Show index for report', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.reports.initTable', 'description' => 'Init table for report', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.reports.tableData', 'description' => 'Get table data for report', 'type' => 0, 'is_default' => false],
        ['name' => 'schools.reports.exportExcel', 'description' => 'Export excel for report', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Reports', 'icon' => 'chart-line', 'route' => 'schools.reports.index', 'order_index' => 600, 'has_children' => false
    ];

    protected $parentMenu = 'School';
}

