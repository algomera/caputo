<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\DrivingPlanning;
use App\Models\LessonPlanning;
use App\Models\MedicalPlanning;
use App\Models\Registration;
use App\Models\School;
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
        $registrations = Registration::all();
        $schools = School::all();

        // Lessons
        $trainings = Training::whereNotNull('ends')->get();
        foreach ($trainings as $training) {
            if ($training->variant_id != null) {
                $lessons = $training->courseVariant->lessons()->get();
            } else {
                $lessons = $training->course->lessons()->get();
            }

            foreach ($lessons as $key => $lesson) {
                if ($key < 2) {
                    $start = strtotime($training->begins);
                    $end = $training->ends ? strtotime($training->ends) : strtotime(date("Y-m-d", strtotime("+3 months")));
                    $randomDate = rand($start,$end);
                    $hour = rand(8, 17);
                    $minute = rand(0, 3) * 15;
                    $begin = date('Y-m-d', $randomDate). " " . sprintf("%02d:%02d:00", $hour, $minute);
                } else {
                    $begin = null;
                }
                LessonPlanning::create([
                    'training_id' => $training->id,
                    'lesson_id' => $lesson->id,
                    'begin' => $begin
                ]);
            }
        }

        // Driving
        $instructors = User::role('istruttore')->get();
        $vehicle = Vehicle::all();
        foreach ($registrations as $registration) {
            DrivingPlanning::create([
                'registration_id' => $registration->id,
                'user_id' => $instructors->random()->id,
                'vehicle_id' => $vehicle->random()->id,
                'type' => fake()->randomElement(['notturna', 'extraurbana', 'autostrada']),
                'begins' => fake()->dateTimeBetween(now(), '+4 week'),
                'welded' => fake()->boolean(),
            ]);
        }

        // Medical
        $doctor = User::role('medico')->get();
        foreach ($schools as $school) {
            foreach ($school->medicalVisits()->get() as $key => $visit) {
                MedicalPlanning::create([
                    'registration_id' => $visit->id,
                    'user_id' => $doctor->random()->id,
                    'booked' => $key % 2 != 0 ? fake()->dateTimeBetween(now(), '+4 week') : null,
                    'protocol' => $key % 2 != 0 ? fake()->regexify('[A-Z]{2}[0-9]{7}[A-Z]{2}') : null,
                    'protocol_release' => $key % 2 != 0 ? now() : null,
                    'protocol_expiration' => $key % 2 != 0 ? now()->addMonth(3) : null,
                    'welded' => $key % 2 != 0 ? true : false,
                ]);
            }
        }
    }
}
