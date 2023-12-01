<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->count(4)->sequence(
            ['name' => 'Adminisztrátor'],
            ['name' => 'Csapatkapitány'],
            ['name' => 'Adatrögzítő'],
            ['name' => 'Játékos'],
        )->create();
    }
}
