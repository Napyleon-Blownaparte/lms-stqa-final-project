<?php

namespace Tests\Unit;

use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;

    public function testFlightConstructor()
    {
        $currentDate = now();

        $flight = Flight::factory()->create([
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => $currentDate,
            'arrival_time' => $currentDate->copy()->addDay(2),
        ]);


        $this->assertDatabaseHas('flights',[
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => $currentDate->toDateTimeString(),
            'arrival_time' => $currentDate->addDay(2)->toDateTimeString(),
        ]);
    }
}
