<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($s=1; $s < 4 ; $s++) {
            School::create([
                'code' => fake()->regexify('[A-Z]{1}[0-9]{5}'),
                'address' => fake()->address(),
                'postcode' => fake()->postcode(),
                'city' => fake()->city(),
            ]);
        }
    }
}
