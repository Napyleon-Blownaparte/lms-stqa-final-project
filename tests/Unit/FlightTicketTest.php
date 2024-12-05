<?php

namespace Tests\Unit;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightTicketTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;

    public function flight_to_ticket()
    {
        $flight = Flight::factory()->create();
        $tickets = Ticket::factory(5)->create(['flight_id' => $flight->id]);

        $this->assertEquals(5, $flight->tickets()->count());
    }

    public function ticket_to_flight(): void
    {
        $flight = Flight::factory()->create();
        $ticket = Ticket::factory(5)->create(['flight_id' => $flight->id]);

        $this->assertEquals($flight->id, $ticket->flight->id);
    }
}
