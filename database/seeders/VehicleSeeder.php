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
            'Automobile',
            'Ciclomotore 50cc',
            'Ciclomotore 125cc',
            'Ciclomotore Min. 35kW',
            'Ciclomotore Mag. 35kW',
        ];

        $transmissions = [
            'Manuale',
            'Automatico'
        ];

        foreach ($transmissions as $transmission) {
            foreach ($types as $type) {
                Vehicle::create([
                    'type' => $type,
                    'model' => fake()->word(),
                    'transmission' => $transmission,
                    'plate' => fake()->regexify('[A-Z]{2}[0-9]{3}[A-Z]{2}')
                ]);
            }
        }
    }
}
