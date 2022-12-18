<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['pending', 'ongoing', 'finished']),
            'type' => $this->faker->randomElement(['single', 'double']),
            'winner_id' => $this->faker->numberBetween(1, 100),
            'second_place_id' => $this->faker->numberBetween(1, 100),
            'third_place_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
