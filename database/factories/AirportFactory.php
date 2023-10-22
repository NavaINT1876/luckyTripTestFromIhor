<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AirportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'iata_code' => strtoupper(Str::random(3)),
            'latitude' => fake()->latitude,
            'longitude' => fake()->longitude,
            'description' => substr(fake()->text, 0, 150),
            'terms_and_conditions' => substr(fake()->text, 0, 150),
        ];
    }
}
