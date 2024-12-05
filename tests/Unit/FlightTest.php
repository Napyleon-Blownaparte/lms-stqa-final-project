<?php

namespace Tests\Unit;

use App\Models\Flight;
use PHPUnit\Framework\TestCase;

class FlightTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testFlightConstructor()
    {
        $currentDate = now();

        // $flight = Flight::factory()->create([
        //     'flight_code' => 'JT610',
        //     'origin' => 'SUB',
        //     'destination' => 'CGK',
        //     'departure_time' => $currentDate,
        //     'arrival_time' => $currentDate->addHour(2),
        // ]);

        $flight = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => $currentDate,
            'arrival_time' => $currentDate->addHour(2),
        ];

        // Flight::insert($flight);

        $this->assertEquals('flights',[
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => $currentDate,
            'arrival_time' => $currentDate->addHour(2),
        ]);
    }
}
