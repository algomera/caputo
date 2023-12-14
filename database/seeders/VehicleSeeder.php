<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Auto',
            'Ciclo motore 50cc',
            'Ciclo motore 125cc',
            'Ciclo motore 500cc',
            'Ciclo motore 650cc',
        ];

        $transmissions = [
            'Manuale',
            'Automatico'
        ];

        for ($i=0; $i < 10; $i++) {
            Vehicle::create([
                'type' => fake()->randomElement($types),
                'model' => fake()->word(),
                'transmission' => fake()->randomElement($transmissions),
                'plate' => fake()->regexify('[A-Z]{5}[0-9]{3}')
            ]);
        }
    }
}
