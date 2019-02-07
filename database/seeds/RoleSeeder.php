<?php

use Illuminate\Database\Seeder;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\PermissionManager\app\Models\Permission;

class RoleSeeder extends Seeder
{
    private const Roles = [
        ['menu_id' => 1, 'name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Administrator role. Full featured.'],
        ['menu_id' => 1, 'name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor role.'],
        ['menu_id' => 1, 'name' => 'developer', 'display_name' => 'Developer', 'description' => 'Developer role. Full featured.'],
        // ['menu_id' => 1, 'name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Administrator role. Full featured.'],
        ['menu_id' => 1, 'name' => 'schooladmin', 'display_name' => 'School Admin', 'description' => 'School admin role.'],
        ['menu_id' => 1, 'name' => 'teacher', 'display_name' => 'Teacher', 'description' => 'Teacher role.'],
        ['menu_id' => 1, 'name' => 'student', 'display_name' => 'Student', 'description' => 'Student role.'],
    ];

    public function run()
    {
        $roles = collect(self::Roles)->map(function ($role) {
            return factory(Role::class)->create($role);
        });

        $admin = Role::whereName('admin')->first();

        $admin->permissions()
                ->sync(Permission::pluck('id'));

        $supervisor = Role::whereName('supervisor')->first();

        $supervisor->permissions()
                ->sync(Permission::implicit()->pluck('id'));
    }
}
