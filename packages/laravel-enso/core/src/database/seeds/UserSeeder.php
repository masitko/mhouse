<?php

use Illuminate\Database\Seeder;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Core\app\Models\UserGroup;
use LaravelEnso\RoleManager\app\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $person = $this->person();

        factory(User::class)->create([
            // 'person_id' => $person->id,
            'title' => Titles::Mr,
            'first_name' => 'Admin',
            'last_name' => 'User',
            'birthday' => '1980-01-19',
            'phone' => '0793232522',
            'email' => 'admin@ttp6.com',
            // 'group_id' => UserGroup::whereName('Administrators')->first()->id,
            // 'email' => $person->email,
            'password' => '$2y$10$06TrEefmqWBO7xghm2PUzeF/O0wcawFUv8TKYq.NF6Dsa0Pnmd/F2',
            'role_id' => Role::whereName('admin')->first()->id,
            'is_active' => true,
        ])->generateAvatar();
    }

    private function person()
    {
        return factory(Person::class)->create([
            'title' => Titles::Mr,
            'name' => 'Test Person',
            'appellative' => 'Admin',
            'email' => 'admin@test.com',
            'birthday' => '1980-01-19',
            'phone' => '0793232522',
        ]);
    }
}
