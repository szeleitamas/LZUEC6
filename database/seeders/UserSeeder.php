<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Phone;
use App\Models\Birthyear;
use Illuminate\Database\Seeder;
use App\Models\Registrationdata;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::find(4);

        User::factory()
        ->has(Phone::factory())
        ->has(Registrationdata::factory())
        ->hasAttached($role)
        ->create();
    }
}
