<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\DrivingPlanning;
use App\Models\LessonPlanning;
use App\Models\MedicalPlanning;
use App\Models\Training;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        // Lessons
        $trainings = Training::all()->take(10);
        foreach ($trainings as $training) {
            if ($training->variant_id != null) {
                $lessons = $training->courseVariant->lessons()->get();
            } else {
                $lessons = $training->course->lessons()->get();
            }

            foreach ($lessons as $lesson) {
                LessonPlanning::create([
                    'training_id' => $training->id,
                    'lesson_id' => $lesson->id,
                    'begin' => fake()->dateTimeBetween(now(), '+4 week')
                ]);
            }
        }

        // Driving
        $vehicle = Vehicle::all();
        foreach ($customers as $customer) {
            $instructors = $customer->school()->first()->instructors()->random()->id;
            DrivingPlanning::create([
                'customer_id' => $customer->id,
                'user_id' => $instructors,
                'vehicle_id' => $vehicle->random()->id,
                'type' => fake()->randomElement(['notturna', 'extraurbana', 'autostrada']),
                'begins' => fake()->dateTimeBetween(now(), '+4 week'),
                'welded' => fake()->boolean(),
            ]);
        }

        // Medical
        foreach ($customers as $customer) {
            $doctor = User::role('doctor')->get()->random()->id;

            MedicalPlanning::create([
                'customer_id' => $customer->id,
                'user_id' => $doctor,
                'booked' => fake()->dateTimeBetween(now(), '+4 week'),
                'protocol' => fake()->regexify('[A-Z]{2}[0-9]{7}[A-Z]{2}'),
                'welded' => fake()->boolean(),
            ]);
        }
    }
}
