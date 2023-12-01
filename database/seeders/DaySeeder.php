<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::factory()->count(5)->sequence(
            ['name' => 'Hétfő'],
            ['name' => 'Kedd'],
            ['name' => 'Szerda'],
            ['name' => 'Csütörtök'],
            ['name' => 'Péntek'],
        )->create();
    }
}
