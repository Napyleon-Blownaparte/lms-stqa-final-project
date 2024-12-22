<?php

namespace Tests\Unit;

use App\Http\Controllers\TicketController;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\URL;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\WithoutMiddleware;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_ticket_with_null_passenger_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'passenger_name' => '',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['passenger_name']);
    }

    public function test_store_ticket_with_256_letter_passenger_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'passenger_name' => 'AelionthropixQuintessoraZephyronixMandrigalSpectramorphiaZenithalCordithyneLuminarqueSolastrelliumVeridithorusAstrovalkinarHelioscendralChronovatrixVelorithyraStellaphyricIgnisomnisEquilibrosyneNyxaltherionOmnivorathisEcliptorathulChrononixorionBriternatue',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['passenger_name']);
    }

    public function test_store_ticket_with_15_characters_passenger_phone()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'passenger_phone' => '081234567890123',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['passenger_phone']);
    }

    public function test_store_ticket_with_2_letters_and_1_digit_of_seat_number()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'passenger_name' => 'John Doe',
            'passenger_phone' => '1234567890',
            'seat_number' => 'AA1',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['seat_number']);
    }

    public function test_store_ticket_with_1_letters_and_3_digit_of_seat_number()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'passenger_name' => 'John Doe',
            'passenger_phone' => '1234567890',
            'seat_number' => 'A123',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['seat_number']);
    }

    public function test_store_ticket_with_null_is_boarding()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $invalidData = [
            'is_boarding' => '',
        ];

        $response = $this->postJson('/ticket/submit/', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['seat_number']);
    }

    public function test_update_ticket_with_null_request_of_is_boarding()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ticket = Ticket::factory()->create();

        $invalidData = [
            'is_boarding' => '',
        ];

        $response = $this->patchJson(route('tickets.update', $ticket->id), $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['is_boarding']);
    }

    // public function test_store_valid_data()
    // {
    //     // Create a user and log in
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     // Create a flight for the ticket to be associated with
    //     $flight = Flight::create([
    //         'flight_code' => 'FL123',
    //         'origin' => 'SUB',
    //         'destination' => 'CGK',
    //         'departure_time' => now(),
    //         'arrival_time' => now()->addHours(2),
    //     ]);

    //     // Simulate a valid request
    //     $response = $this->post(route('tickets.store'), [
    //         'passenger_name' => 'John Doe',
    //         'passenger_phone' => '081234567890',
    //         'seat_number' => 'A1',
    //     ], [
    //         'Referer' => route('flights.show', $flight->id), // Set the previous URL
    //     ]);

    //     // Assertions
    //     $response->assertRedirect(route('flights.show', $flight->id));
    //     $response->assertSessionHas('success', 'Tambah tiket berhasil');

    //     $this->assertDatabaseHas('tickets', [
    //         'passenger_name' => 'John Doe',
    //         'passenger_phone' => '081234567890',
    //         'seat_number' => 'A1',
    //         'flight_id' => $flight->id,
    //     ]);
    // }

    public function test_store_ticket_with_1_letter_passenger_name()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $flight = Flight::create([
            'flight_code' => 'FL123',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $response = $this->post(
            route('tickets.store'),
            [
                'passenger_name' => 'A', //1 letter
                'passenger_phone' => '081234567890',
                'seat_number' => 'A1',
            ],
            [
                'Referer' => route('flights.show', $flight->id),
            ],
        );

        $response->assertRedirect(route('flights.show', $flight->id));

        $response->assertSessionHas('success', 'Tambah tiket berhasil');

        $response->assertStatus(302);
    }

    public function test_store_ticket_with_255_letter_passenger_name()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $flight = Flight::create([
            'flight_code' => 'FL123',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $response = $this->post(
            route('tickets.store'),
            [
                //255 letter
                'passenger_name' => 'elionthropix QuintessoraZephyronixMandrigalSpectramorphiaZenithalCordithyneLuminarqueSolastrelliumVeridithorusAstrovalkinarHelioscendralChronovatrixVelorithyraStellaphyricIgnisomnisEquilibrosyneNyxaltherionOmnivorathisEcliptorathulChrononixorionBriternatu',
                'passenger_phone' => '081234567890',
                'seat_number' => 'A1',
            ],
            [
                'Referer' => route('flights.show', $flight->id),
            ],
        );

        $response->assertRedirect(route('flights.show', $flight->id));

        $response->assertSessionHas('success', 'Tambah tiket berhasil');

        $response->assertStatus(302);
    }

    public function test_store_ticket_with_13_characters_passenger_phone()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $flight = Flight::create([
            'flight_code' => 'FL123',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $response = $this->post(
            route('tickets.store'),
            [
                'passenger_name' => 'John',
                'passenger_phone' => '0812345678901', //13 char phone
                'seat_number' => 'A1',
            ],
            [
                'Referer' => route('flights.show', $flight->id),
            ],
        );

        $response->assertRedirect(route('flights.show', $flight->id));

        $response->assertSessionHas('success', 'Tambah tiket berhasil');

        $response->assertStatus(302);
    }

    public function test_store_ticket_with_14_characters_passenger_phone()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $flight = Flight::create([
            'flight_code' => 'FL123',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $response = $this->post(
            route('tickets.store'),
            [
                'passenger_name' => 'John',
                'passenger_phone' => '08123456789012', //14 char phone
                'seat_number' => 'A1',
            ],
            [
                'Referer' => route('flights.show', $flight->id),
            ],
        );

        $response->assertRedirect(route('flights.show', $flight->id));

        $response->assertSessionHas('success', 'Tambah tiket berhasil');

        $response->assertStatus(302);
    }

    public function test_store_ticket_with_1_letter_and_2_digits_of_seat_number()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $flight = Flight::create([
            'flight_code' => 'FL123',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $response = $this->post(
            route('tickets.store'),
            [
                'passenger_name' => 'John',
                'passenger_phone' => '081234567890',
                'seat_number' => 'B12', //1 letter 2 digit
            ],
            [
                'Referer' => route('flights.show', $flight->id),
            ],
        );

        $response->assertRedirect(route('flights.show', $flight->id));

        $response->assertSessionHas('success', 'Tambah tiket berhasil');

        $response->assertStatus(302);
    }
}
