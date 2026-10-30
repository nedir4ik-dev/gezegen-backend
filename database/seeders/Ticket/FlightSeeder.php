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
                'departure_airport_id' => 1, // Ashgabat (ASB)
                'arrival_airport_id' => 2,   // Dubai (DXB)
                'departure_time' => '2026-11-01 08:00:00',
                'arrival_time' => '2026-11-01 11:30:00',
                'price' => 350.00,
                'available_seats' => 120,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'TK-325',
                'airline' => 'Turkish Airlines',
                'departure_airport_id' => 1, // Ashgabat (ASB)
                'arrival_airport_id' => 3,   // Istanbul (IST)
                'departure_time' => '2026-11-02 14:00:00',
                'arrival_time' => '2026-11-02 17:15:00',
                'price' => 450.50,
                'available_seats' => 150,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'BA-681',
                'airline' => 'British Airways',
                'departure_airport_id' => 3, // Istanbul (IST)
                'arrival_airport_id' => 4,   // London (LHR)
                'departure_time' => '2026-11-03 10:30:00',
                'arrival_time' => '2026-11-03 12:45:00',
                'price' => 600.00,
                'available_seats' => 90,
                'status' => 'Delayed',
            ],
            [
                'flight_number' => 'QR-288',
                'airline' => 'Qatar Airways',
                'departure_airport_id' => 1, // Ashgabat (ASB)
                'arrival_airport_id' => 8,   // Doha (DOH)
                'departure_time' => '2026-11-04 05:00:00',
                'arrival_time' => '2026-11-04 06:30:00',
                'price' => 420.00,
                'available_seats' => 130,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'LH-420',
                'airline' => 'Lufthansa',
                'departure_airport_id' => 6, // Frankfurt (FRA)
                'arrival_airport_id' => 5,   // New York (JFK)
                'departure_time' => '2026-11-05 11:00:00',
                'arrival_time' => '2026-11-05 14:00:00',
                'price' => 850.00,
                'available_seats' => 200,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'AF-104',
                'airline' => 'Air France',
                'departure_airport_id' => 7, // Paris (CDG)
                'arrival_airport_id' => 4,   // London (LHR)
                'departure_time' => '2026-11-06 09:15:00',
                'arrival_time' => '2026-11-06 09:45:00',
                'price' => 220.00,
                'available_seats' => 110,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'SQ-180',
                'airline' => 'Singapore Airlines',
                'departure_airport_id' => 9, // Singapore (SIN)
                'arrival_airport_id' => 10,  // Tokyo (HND)
                'departure_time' => '2026-11-07 23:00:00',
                'arrival_time' => '2026-11-08 07:00:00',
                'price' => 700.00,
                'available_seats' => 180,
                'status' => 'Scheduled',
            ],
            [
                'flight_number' => 'CA-920',
                'airline' => 'Air China',
                'departure_airport_id' => 11, // Beijing (PEK)
                'arrival_airport_id' => 1,    // Ashgabat (ASB)
                'departure_time' => '2026-11-09 16:30:00',
                'arrival_time' => '2026-11-09 21:00:00',
                'price' => 650.00,
                'available_seats' => 140,
                'status' => 'Scheduled',
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
