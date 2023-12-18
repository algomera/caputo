<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\Customer;
use App\Models\InterestedCourses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $courses = Course::all();
        $courseVariant = CourseVariant::all();

        foreach ($customers as $customer) {
            foreach ($courses->random(3) as $course) {
                InterestedCourses::create([
                    'customer_id' => $customer->id,
                    'course_id' => $course->id,
                    'confirm' => fake()->randomElement(['in attesa', 'confermato'])
                ]);
            }
            foreach ($courseVariant->random(3) as $course) {
                InterestedCourses::create([
                    'customer_id' => $customer->id,
                    'course_id' => $course->id,
                    'confirm' => fake()->randomElement(['in attesa', 'confermato'])
                ]);
            }
        }

    }
}
