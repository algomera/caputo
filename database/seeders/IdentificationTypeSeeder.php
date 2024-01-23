<?php

namespace Database\Seeders;

use App\Models\IdentificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'carta di identita',
            'patente',
            'passaporto',
            'permesso di soggiorno',
            'porto di armi',
            'patente nautica'
        ];

        foreach ($types as $type) {
            IdentificationType::create([
                'name' => $type
            ]);
        }
    }
}
