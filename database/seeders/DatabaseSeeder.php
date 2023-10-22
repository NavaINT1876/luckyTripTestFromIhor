<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         \App\Models\Airport::factory(20)
             ->has(Translation::factory()->count(3))->create();
    }
}
