<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Kreira novog korisnika
            'letters' => $this->faker->randomElement(['applebanana', 'orangetree', 'grapefruit']),
            'active' => true,
            'score' => $this->faker->numberBetween(0, 100)
        ];
    }
}
