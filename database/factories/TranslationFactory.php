<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TranslationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'language' => substr(fake()->unique->locale(), 0, 2),
            'text' => fake()->name,
        ];
    }
}
