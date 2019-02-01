<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForRoles extends StructureMigration
{
    protected $permissions = [
        ['name' => 'system.roles.tableData', 'description' => 'Get table data for roles', 'type' => 0, 'is_default' => false],
        ['name' => 'system.roles.exportExcel', 'description' => 'Export excel for roles', 'type' => 0, 'is_default' => false],
        ['name' => 'system.roles.initTable', 'description' => 'Init table for roles menu', 'type' => 0, 'is_default' => false],
        ['name' => 'system.roles.create', 'description' => 'Create role', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.edit', 'description' => 'Edit role', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.configure', 'description' => 'Configure role permissions', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.index', 'description' => 'Show roles index', 'type' => 0, 'is_default' => false],
        ['name' => 'system.roles.store', 'description' => 'Store newly created role', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.update', 'description' => 'Update role', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.destroy', 'description' => 'Delete role', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => true],
        ['name' => 'system.roles.getPermissions', 'description' => 'Get role permissions for role configurator', 'type' => 0, 'is_default' => false],
        ['name' => 'system.roles.setPermissions', 'description' => 'Set role permissions for role configurator', 'type' => 1, 'is_default' => false],
        ['name' => 'system.roles.writeConfig', 'description' => 'Write role configuration file', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Roles', 'icon' => 'universal-access', 'route' => 'system.roles.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
