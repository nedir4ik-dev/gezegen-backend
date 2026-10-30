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
            [
                'name' => 'Frankfurt Airport',
                'code' => 'FRA',
                'city' => 'Frankfurt',
                'country' => 'Germany',
                'timezone' => 'Europe/Berlin',
            ],
            [
                'name' => 'Charles de Gaulle Airport',
                'code' => 'CDG',
                'city' => 'Paris',
                'country' => 'France',
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Hamad International Airport',
                'code' => 'DOH',
                'city' => 'Doha',
                'country' => 'Qatar',
                'timezone' => 'Asia/Qatar',
            ],
            [
                'name' => 'Singapore Changi Airport',
                'code' => 'SIN',
                'city' => 'Singapore',
                'country' => 'Singapore',
                'timezone' => 'Asia/Singapore',
            ],
            [
                'name' => 'Tokyo Haneda Airport',
                'code' => 'HND',
                'city' => 'Tokyo',
                'country' => 'Japan',
                'timezone' => 'Asia/Tokyo',
            ],
            [
                'name' => 'Beijing Capital International Airport',
                'code' => 'PEK',
                'city' => 'Beijing',
                'country' => 'China',
                'timezone' => 'Asia/Shanghai',
            ],
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
