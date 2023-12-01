<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Group;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->team,
            'day_id' => Day::inRandomOrder()->first()->id,
            'track_id' => Track::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
        ];
    }
}
