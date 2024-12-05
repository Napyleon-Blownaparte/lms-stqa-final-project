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
            'flight_code' => strtoupper($this->faker->lexify('?????')),
            'origin' => $this->faker->regexify('[A-Z]{3}'),
            'destination' => $this->faker->regexify('[A-Z]{3}'),
            'departure_time' => $this->faker->dateTime(),
            'arrival_time' => $this->faker->dateTime(),
        ];
    }
}
