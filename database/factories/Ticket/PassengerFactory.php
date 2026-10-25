<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'passport_number' => 'B' . fake()->unique()->numerify('#######'),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
