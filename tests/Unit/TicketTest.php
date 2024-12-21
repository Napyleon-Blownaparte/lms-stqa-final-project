<?php

namespace Tests\Unit;

use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\URL;
use Mockery;

class TicketTest extends TestCase
{
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

    //Masih error
    public function test_it_accepts_valid_request_data()
    {
        // Arrange: Menyiapkan data yang valid
        $validData = [
            'passenger_name' => 'John Doe',
            'passenger_phone' => '081234567890',
            'seat_number' => 'A12',
        ];

        // Simulasi login pengguna
        $user = User::factory()->create(); // Buat pengguna untuk autentikasi
        $this->actingAs($user);

        // Act: Kirim data valid
        $response = $this->postJson('/ticket/submit/', $validData);

        // Assert: Periksa apakah status berhasil dan tiket berhasil ditambahkan
        $response->assertStatus(201); // Mengharapkan status 201 untuk berhasil membuat
        $response->assertJson([
            'success' => 'Tambah tiket berhasil', // Pesan sukses
        ]);

        // Verifikasi apakah data benar-benar disimpan
        $this->assertDatabaseHas('tickets', [
            'passenger_name' => 'John Doe',
            'passenger_phone' => '081234567890',
            'seat_number' => 'A12',
        ]);
    }
}
