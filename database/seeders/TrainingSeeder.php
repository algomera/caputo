<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\registration;
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

                if ($training->id <= 10) {
                    foreach ($customers as $customer) {
                        $costs = $course->getOptions()->where('type', 'fisso')->get();
                        $optionals = $course->getOptions()->where('type', 'opzionale')->get()->random(3);
                        $priceCourse = $course->prices()->where('licenses', null)->first();
                        $total = $priceCourse->price;

                        foreach ($costs as $cost) {
                            $total += $cost->price;
                        }
                        foreach ($optionals as $optional) {
                            $total += $optional->price;
                        }

                        Registration::create([
                            'training_id' => $training->id,
                            'customer_id' => $customer->id,
                            'type' => fake()->randomElement(['teoria', 'pratica', 'pratica/s.esame']),
                            'transmission' => fake()->randomElement(['manuale', 'automatica']),
                            'optionals' => $optionals->pluck('id')->toJson(),
                            'price' => $total
                        ]);
                    }
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

                if ($training->id <= 10) {
                    foreach ($customers as $customer) {
                        $costs = $variant->getOptions()->where('type', 'fisso')->get();
                        $optionals = $variant->getOptions()->where('type', 'opzionale')->get()->random(3);
                        $total = $variant->prices()->where('licenses', null)->first()->pluck('price');

                        foreach ($costs as $cost) {
                            $total += $cost->price;
                        }
                        foreach ($optionals as $optional) {
                            $total += $optional->price;
                        }

                        Registration::create([
                            'training_id' => $training->id,
                            'customer_id' => $customer->id,
                            'type' => fake()->randomElement(['teoria', 'pratica', 'pratica/s.esame']),
                            'transmission' => fake()->randomElement(['manuale', 'automatica']),
                            'optionals' => $optionals->pluck('id')->toJson(),
                            'price' => $total
                        ]);
                    }
                }
            }
        }
    }
}
