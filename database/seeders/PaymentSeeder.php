<?php

namespace Database\Seeders;

use App\Models\DrivingPlanning;
use App\Models\MedicalPlanning;
use App\Models\registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = Registration::all();
        $drivings = DrivingPlanning::all();
        $medicals = MedicalPlanning::all();

        foreach ($registrations as $registration) {
            for ($i=0; $i < 2; $i++) {
                $registration->payments()->create([
                    'amount' => fake()->randomFloat(2, 20, 600)
                ]);
            }
        }

        foreach ($drivings as $driving) {
            if ($driving->welded) {
                $driving->payments()->create([
                    'amount' => 20
                ]);
            }
        }

        foreach ($medicals as $medical) {
            if ($medical->welded) {
                $medical->payments()->create([
                    'amount' => 64.40
                ]);
            }
        }
    }
}
