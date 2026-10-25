<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Ticket;
use App\Models\Ticket\Passenger;
use App\Models\Ticket\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => Flight::inRandomOrder()->first()?->id ?? Flight::factory(),
            'passenger_id' => Passenger::inRandomOrder()->first()?->id ?? Passenger::factory(),
            'ticket_code' => 'TCK-' . fake()->unique()->numerify('########'),
            'seat_number' => rand(1, 30) . fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'price' => fake()->randomFloat(2, 100, 1500),
            'status' => fake()->randomElement(['booked', 'confirmed', 'cancelled']),
        ];
    }
}
