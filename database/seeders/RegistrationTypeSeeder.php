<?php

namespace Database\Seeders;

use App\Models\RegistrationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'prima patente',
            'possessore di patente',
            'possessore di guida accompagnata',
            'cambio codice'
        ];

        foreach ($types as $type) {
            RegistrationType::create([
                'name' => $type,
            ]);
        }
    }
}
