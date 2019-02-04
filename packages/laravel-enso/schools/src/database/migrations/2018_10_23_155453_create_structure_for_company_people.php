<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForCompanyPeople extends StructureMigration
{
    protected $permissions = [
        ['name' => 'administration.schools.people.create', 'description' => 'Add person to school', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.people.edit', 'description' => 'Edit existing school person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.people.index', 'description' => 'Show school people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.schools.people.store', 'description' => 'Save newly added school person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.people.update', 'description' => 'Update edited school person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.schools.people.destroy', 'description' => 'Delete school person', 'type' => 1, 'is_default' => false],
    ];
}
