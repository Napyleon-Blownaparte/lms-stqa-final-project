<?php

namespace Tests\Feature;

use App\Models\Flight;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_booking_process()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $response = $this->actingAs($user)->get(route('tickets.create', ['flight' => $flight->id]));
        $response->assertStatus(200);

        $response = $this->post(route('tickets.store'), [
            'passenger_name' => 'Jane Doe',
            'passenger_phone' => '089876543210',
            'seat_number' => 'B2',
        ]);

        $this->assertDatabaseHas('tickets', [
            'passenger_name' => 'Jane Doe',
            'seat_number' => 'B2',
        ]);

        $response->assertRedirect(route('flights.show', ['flight' => $flight->id]));
    }
}
