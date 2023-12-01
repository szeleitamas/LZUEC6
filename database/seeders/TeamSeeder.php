<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Phone;
use App\Models\Birthyear;
use Illuminate\Database\Seeder;
use App\Models\Registrationdata;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_teamCaptain = Role::find(2);
        $role_player = Role::find(4);

        Team::factory()->count(36)
            ->has(User::factory()
                ->has(Phone::factory())
                ->has(Registrationdata::factory())
                ->hasAttached($role_teamCaptain))
            ->has(User::factory()->count(3)
                ->has(Phone::factory())
                ->has(Registrationdata::factory())
                ->hasAttached($role_player))
            ->create();
    }
}
