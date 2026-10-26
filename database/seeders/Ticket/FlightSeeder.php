<?php

namespace Database\Seeders\Ticket;

use App\Models\Ticket\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Flight::factory(15)->create();

        $flights = [
            [
                'flight_number' => 'T5-875',
                'airline' => 'Türkmenhowaýollary',
                'departure_airport_id' => 1, // Ashgabat
                'arrival_airport_id' => 2,   // Dubai
                'departure_time' => '2026-11-01 08:00:00',
                'arrival_time' => '2026-11-01 11:30:00',
                'price' => 350.00,
                'available_seats' => 120,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'TK-325',
                'airline' => 'Turkish Airlines',
                'departure_airport_id' => 1, // Ashgabat
                'arrival_airport_id' => 3,   // Istanbul
                'departure_time' => '2026-11-02 14:00:00',
                'arrival_time' => '2026-11-02 17:15:00',
                'price' => 450.50,
                'available_seats' => 150,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'BA-681',
                'airline' => 'British Airways',
                'departure_airport_id' => 3, // Istanbul
                'arrival_airport_id' => 4,   // London
                'departure_time' => '2026-11-03 10:30:00',
                'arrival_time' => '2026-11-03 12:45:00',
                'price' => 600.00,
                'available_seats' => 90,
                'status' => 'Delayed',
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
