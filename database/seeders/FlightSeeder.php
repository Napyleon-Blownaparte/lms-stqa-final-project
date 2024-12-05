<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate = now();

        $flightData = [
            [
                'created_at' => now(),
                'updated_at' => now(),
                'flight_code' => 'JT610',
                'origin' => 'SUB',
                'destination' => 'CGK',
                'departure_time' => $currentDate,
                'arrival_time' => $currentDate->addDay(2),
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'flight_code' => 'MK195',
                'origin' => 'SUB',
                'destination' => 'AOJ',
                'departure_time' => $currentDate,
                'arrival_time' => $currentDate->addDay(4),
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'flight_code' => 'AO198',
                'origin' => 'CGK',
                'destination' => 'SUB',
                'departure_time' => $currentDate,
                'arrival_time' => $currentDate->addDay(3),
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'flight_code' => 'OQ107',
                'origin' => 'CGK',
                'destination' => 'SUB',
                'departure_time' => $currentDate,
                'arrival_time' => $currentDate->addDay(7),
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
                'flight_code' => 'NK197',
                'origin' => 'BAL',
                'destination' => 'JGJ',
                'departure_time' => $currentDate,
                'arrival_time' => $currentDate->addDay(2),
            ],
        ];

        Flight::insert($flightData);

    }
}
