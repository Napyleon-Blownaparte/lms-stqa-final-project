<?php

namespace Tests\Unit;

use App\Models\Flight;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_store_creates_ticket()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $response = $this->actingAs($user)->post(route('tickets.store'), [
            'passenger_name' => 'John Doe',
            'passenger_phone' => '081234567890',
            'seat_number' => 'A1',
        ]);

        $this->assertDatabaseHas('tickets', [
            'passenger_name' => 'John Doe',
            'seat_number' => 'A1',
        ]);

        $response->assertRedirect(route('flights.show', ['flight' => $flight->id]));
    }
}
