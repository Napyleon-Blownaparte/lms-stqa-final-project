<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_code' => $this->faker->unique()->bothify('?##'), // Contoh flight code seperti ABC12
            'origin' => $this->faker->countryCode, // Asal, seperti "ID" atau "US"
            'destination' => $this->faker->countryCode, // Tujuan, seperti "ID" atau "US"
            'departure_time' => $this->faker->dateTimeThisMonth(),
            'arrival_time' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
