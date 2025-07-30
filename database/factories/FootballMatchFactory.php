<?php

namespace Database\Factories;

use App\FootballMatchStatus;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FootballMatch>
 */
class FootballMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $homeTeam = Team::factory()->create();
        $awayTeam = Team::factory()->create();

        while ($homeTeam->id === $awayTeam->id) {
            $awayTeam = Team::factory()->create();
        }
        return [
            'home_team_id' => $homeTeam->id,
            'away_team_id' => $awayTeam->id,
            'home_score' => $this->faker->optional(0.8)->numberBetween(0, 10),
            'away_score' => $this->faker->optional(0.8)->numberBetween(0, 10),
            'status' => 'finished',
        ];
    }
}
