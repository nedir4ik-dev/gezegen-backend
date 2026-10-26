<?php

namespace Database\Seeders\Ticket;

use App\Models\Ticket\Passenger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Passenger::factory(10)->create();


        $passengers = [
            [
                'first_name' => 'Aman',
                'last_name' => 'Myradow',
                'email' => 'aman@example.com',
                'passport_number' => 'I-AG1234562',
                'phone' => '+99365112233'
            ],
            [
                'first_name' => 'Jeren',
                'last_name' => 'Myradowa',
                'email' => 'jeren@example.com',
                'passport_number' => 'I-AG6543210',
                'phone' => '+99364445566'
            ],
            [
                'first_name' => 'Myrat',
                'last_name' => 'Amanow',
                'email' => 'myrat@example.com',
                'passport_number' => 'I-AG7890121',
                'phone' => '+99361778899'
            ],
            [
                'first_name' => 'Selbi',
                'last_name' => 'Orazowa',
                'email' => 'selbiorazowa@example.com',
                'passport_number' => 'I-AG3456783',
                'phone' => '+99362334455'
            ],
            [
                'first_name' => 'Dowran',
                'last_name' => 'Begenjow',
                'email' => 'dovran@example.com',
                'passport_number' => 'I-AG9012342',
                'phone' => '+99363990011'
            ],
        ];

        foreach ($passengers as $passenger) {
            Passenger::create($passenger);
        }
    }
}
