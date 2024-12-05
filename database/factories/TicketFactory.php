<?php

namespace Database\Factories;

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
            'flight_id' => \App\Models\Flight::factory(),
            'passenger_name' => $this->faker->name(),
            'passenger_phone' => $this->faker->phoneNumber(),
            'seat_number' => $this->faker->regexify('[A-Z][0-9]{2}'),
            'is_boarding' => false,
            'boarding_time' => null,
        ];
    }
}
