<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Flight;
use App\Models\Ticket\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureTime = fake()->dateTimeBetween('+1 days', '+10 days');

        return [
            'flight_number' => 'FL-' . fake()->unique()->numerify('###'),
            'airline' => 'Turkish Airlines',
            'departure_airport_id' => Airport::inRandomOrder()->first()?->id ?? Airport::factory(),
            'arrival_airport_id' => Airport::inRandomOrder()->first()?->id ?? Airport::factory(),
            'departure_time' => $departureTime,
            'arrival_time' => (clone $departureTime)->modify('+' . rand(2, 6) . ' hours'),
            'price' => fake()->randomFloat(2, 100, 1000),
            'available_seats' => fake()->numberBetween(20, 150),
            'status' => fake()->randomElement(['Scheduled', 'Delayed', 'Cancelled']),
        ];
    }
}
