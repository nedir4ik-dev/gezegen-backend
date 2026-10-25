<?php

namespace Database\Seeders\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ticket::factory(15)->create();

        $tickets = [
            [
                'flight_id' => 1,
                'passenger_id' => 1,
                'ticket_code' => 'TCK-99182',
                'seat_number' => '12A',
                'price' => 350.00,
                'status' => 'confirmed',
            ],
            [
                'flight_id' => 1,
                'passenger_id' => 2,
                'ticket_code' => 'TCK-99265',
                'seat_number' => '12B',
                'price' => 350.00,
                'status' => 'booked',
            ],
            [
                'flight_id' => 2,
                'passenger_id' => 3,
                'ticket_code' => 'TCK-99201',
                'seat_number' => '15F',
                'price' => 450.50,
                'status' => 'confirmed',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
