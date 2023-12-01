<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::factory()->count(4)->sequence(
            ['name' => 'A. osztály'],
            ['name' => 'B. osztály'],
            ['name' => 'C. osztály'],
            ['name' => 'D. osztály'],
        )->create();
    }
}
