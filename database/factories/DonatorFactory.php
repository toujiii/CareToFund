<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donator>
 */
class DonatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'charity_id' => \App\Models\Charity::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 50000),
            'message' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_at' => now(),
        ];
    }
}
