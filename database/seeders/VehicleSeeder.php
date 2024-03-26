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
        $vehicles = [
            [
                'type' => 'Automobile',
                'patent_id' => 6
            ],
            [
                'type' => 'Ciclomotore 50cc',
                'patent_id' => 1
            ],
            [
                'type' => 'Ciclomotore 125cc',
                'patent_id' => 2
            ],
            [
                'type' => 'Ciclomotore Min. 35kW',
                'patent_id' => 3
            ],
            [
                'type' => 'Ciclomotore Mag. 35kW',
                'patent_id' => 4
            ],
        ];

        $transmissions = [
            'Manuale',
            'Automatica'
        ];

        foreach ($transmissions as $transmission) {
            foreach ($vehicles as $vehicle) {
                Vehicle::create([
                    'type' => $vehicle['type'],
                    'patent_id' => $vehicle['patent_id'],
                    'model' => fake()->word(),
                    'transmission' => $transmission,
                    'plate' => fake()->regexify('[A-Z]{2}[0-9]{3}[A-Z]{2}')
                ]);
            }
        }
    }
}
