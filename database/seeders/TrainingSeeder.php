<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\School;
use App\Models\Training;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();
        $courses = Course::all();
        $courseVariant = CourseVariant::all();

        foreach ($schools as $school) {
            $teachers = $school->teachers();
            foreach ($courses as $course) {
                $customers = $school->customers()->get()->random(3);
                $training = Training::create([
                    'school_id' => $school->id,
                    'course_id' => $course->id,
                    'user_id' => $teachers->random()->id,
                    'begins' => now(),
                    'ends' => fake()->dateTimeBetween('+4 week', '+8 week'),
                ]);
                foreach ($customers as $customer) {
                    $customer->trainings()->attach($training->id);
                }
            }

            foreach ($courseVariant as $variant) {
                $customers = $school->customers()->get()->random(3);
                $training = Training::create([
                    'school_id' => $school->id,
                    'course_id' => $variant->course->id,
                    'variant_id' => $variant->id,
                    'user_id' => $teachers->random()->id,
                    'begins' => now(),
                    'ends' => fake()->dateTimeBetween('+4 week', '+8 week'),
                ]);
                foreach ($customers as $customer) {
                    $customer->trainings()->attach($training->id);
                }
            }
        }
    }
}
