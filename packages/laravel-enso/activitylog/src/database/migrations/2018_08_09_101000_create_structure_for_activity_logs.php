<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForActivityLogs extends StructureMigration
{
    protected $permissions = [
        ['name' => 'core.activityLogs.index', 'description' => 'Show index for activity log', 'type' => 0, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Activity Log', 'icon' => 'shoe-prints', 'route' => 'core.activityLogs.index', 'order_index' => 900, 'has_children' => false,
    ];

    protected $parentMenu = '';
}
