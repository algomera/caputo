<?php

namespace Database\Seeders;

use App\Models\PinkSheet;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PinkSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = Registration::all();

        foreach ($registrations as $registration) {
            PinkSheet::create([
                'registration_id' => $registration->id,
                'release' => now(),
                'expiration' => now()->addMonth(12),
            ]);
        }
    }
}
