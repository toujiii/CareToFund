<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charity_Request>
 */
class Charity_RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Charity_Request::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(),
            'datetime' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'approved_datetime' => $this->faker->optional(0.4)->dateTimeBetween('-6 months', 'now'),
            'fund_limit' => $this->faker->numberBetween(1000, 200000),
            'duration' => $this->faker->numberBetween(1, 365),
            'id_type_used' => $this->faker->randomElement(['Passport', "Driver's License", 'National ID']),
            'id_number' => $this->faker->bothify('??######'),
            'id_att_link' => $this->faker->optional()->imageUrl(),
            'front_face_link' => $this->faker->optional()->imageUrl(),
            'side_face_link' => $this->faker->optional()->imageUrl(),
            'request_status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected', 'Cancelled']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
