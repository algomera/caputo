<?php

namespace Database\Seeders;

use App\Models\LessonPlanning;
use App\Models\Presence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plannings = LessonPlanning::all();

        foreach ($plannings as $planning) {
            $customers = $planning->training->customers()->get();

            foreach ($customers as $customer) {
                Presence::create([
                    'lesson_planning_id' => $planning->id,
                    'customer_id' => $customer->id,
                    'followed' => fake()->boolean()
                ]);
            }
        }
    }
}
