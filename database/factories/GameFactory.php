<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_one_id' => User::factory(),
            'cols' => 3,
            'rows' => 3,
            'board_state' => '[0,0,0,0,0,0,0,0,0]',
            'player_two_id' => null,
        ];
    }
}
