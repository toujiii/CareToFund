<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Charity_Request;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charity>
 */
class CharityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // charity_id is auto-incremented by the migration, do not set it here
            'request_id' => Charity_Request::factory(), // will create a related charity_request if none exists
            'raised' => $this->faker->numberBetween(0, 50000),
            'charity_status' => $this->faker->randomElement(['Ongoing', 'Finished', 'Cancelled']),
        ];
    }
}
