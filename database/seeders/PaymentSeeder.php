<?php

namespace Database\Seeders;

use App\Models\DrivingPlanning;
use App\Models\Payment;
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
        $registrations = registration::all();
        $drivings = DrivingPlanning::all();

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
    }
}
