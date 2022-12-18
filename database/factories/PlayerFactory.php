<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
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
            'height' => $this->faker->numberBetween(0, 100),
            'weight' => $this->faker->numberBetween(0, 100),
            'speed' => $this->faker->numberBetween(0, 100),
            'strength' => $this->faker->numberBetween(0, 100),
            'reaction_time' => $this->faker->numberBetween(0, 100),
            'ability' => $this->faker->numberBetween(0, 100),
            'lucky' => $this->faker->boolean(),
            'gender' => $this->faker->randomElement(['female', 'male']),
        ];
    }
}
