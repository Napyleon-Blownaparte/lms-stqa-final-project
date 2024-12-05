<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => Flight::factory(),
            'passenger_name' => $this->faker->name,
            'passenger_phone' => $this->faker->phoneNumber,
            'seat_number' => $this->faker->randomLetter . $this->faker->numberBetween(1, 30), // Seat example: A1, B2
            'is_boarding' => 0,
            'boarding_time' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
