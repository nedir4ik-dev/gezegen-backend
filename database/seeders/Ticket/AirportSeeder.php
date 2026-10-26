<?php

namespace Database\Seeders\Ticket;

use App\Models\Ticket\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $airports = [
            [
                'name' => 'Ashgabat International Airport',
                'code' => 'ASB',
                'city' => 'Ashgabat',
                'country' => 'Turkmenistan',
                'timezone' => 'Asia/Ashgabat',
            ],
            [
                'name' => 'Dubai International Airport',
                'code' => 'DXB',
                'city' => 'Dubai',
                'country' => 'United Arab Emirates',
                'timezone' => 'Asia/Dubai',
            ],
            [
                'name' => 'Istanbul Airport',
                'code' => 'IST',
                'city' => 'Istanbul',
                'country' => 'Turkey',
                'timezone' => 'Europe/Istanbul',
            ],
            [
                'name' => 'Heathrow Airport',
                'code' => 'LHR',
                'city' => 'London',
                'country' => 'United Kingdom',
                'timezone' => 'Europe/London',
            ],
            [
                'name' => 'John F. Kennedy International Airport',
                'code' => 'JFK',
                'city' => 'New York',
                'country' => 'United States',
                'timezone' => 'America/New_York',
            ],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
