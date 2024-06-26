<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\Registration;
use App\Models\School;
use App\Models\Training;
use App\Models\User;
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
        $courses = Course::where('type', 'training')->get();
        $courseVariant = CourseVariant::where('type', 'training')->get();
        $teachers = User::role('insegnante')->get();

        foreach ($schools as $school) {
            $customers = $school->customers()->get();

            //Creazione Training per ogni corso in tutte le autoscuole
            foreach ($courses as $course) {
                if ($course->id > 9 && $course->id < 19) {
                    $training = Training::create([
                        'school_id' => $school->id,
                        'course_id' => $course->id,
                        'user_id' => $teachers->random()->id,
                        'begins' => now(),
                        'ends' => fake()->dateTimeBetween('+4 week', '+8 week'),
                    ]);

                    $hour = rand(8, 17);
                    $minute = rand(0, 3) * 15;

                    $trainingLoop = Training::create([
                        'school_id' => $school->id,
                        'course_id' => $course->id,
                        'user_id' => $teachers->random()->id,
                        'begins' => now(),
                        'time_start' => sprintf("%02d:%02d:00", $hour, $minute)
                    ]);

                    $costs = $course->getOptions()->where('type', 'fisso')->where('registration_type_id', 1)->get();
                    $optionals = $course->getOptions()->where('type', 'opzionale')->where('registration_type_id', 1)->get()->random(3);
                    $priceCourse = $course->courseRegistrationSteps()->first()->branchCourses()->first()->price;
                    $total = $priceCourse->price ?? 0;

                    foreach ($costs as $cost) {
                        $total += $cost->price;
                    }
                    foreach ($optionals as $optional) {
                        $total += $optional->price;
                    }

                    $branchCourse = $course->courseRegistrationSteps()->first()->branchCourses()->get();

                    Registration::create([
                        'training_id' => $training->id,
                        'customer_id' => $customers->random()->id,
                        'registration_type_id' => fake()->numberBetween(1,4),
                        'branch_course_id' => $branchCourse->random()->id,
                        'transmission' => fake()->randomElement(['manuale', 'automatica']),
                        'optionals' => $optionals->pluck('id')->toJson(),
                        'step_skipped' => json_encode([]),
                        'price' => $total
                    ]);

                    Registration::create([
                        'training_id' => $trainingLoop->id,
                        'customer_id' => $customers->random()->id,
                        'registration_type_id' => fake()->numberBetween(1,4),
                        'branch_course_id' => $branchCourse->random()->id,
                        'transmission' => fake()->randomElement(['manuale', 'automatica']),
                        'optionals' => $optionals->pluck('id')->toJson(),
                        'step_skipped' => json_encode([]),
                        'price' => $total
                    ]);
                }
            }

            //Creazione Training per ogni variante corso in tutte le autoscuole
            // foreach ($courseVariant as $variant) {
            //     $customers = $school->customers()->get()->random(3);
            //     $training = Training::create([
            //         'school_id' => $school->id,
            //         'course_id' => $variant->course->id,
            //         'variant_id' => $variant->id,
            //         'user_id' => $teachers->random()->id,
            //         'begins' => now(),
            //         'ends' => fake()->dateTimeBetween('+4 week', '+8 week'),
            //     ]);

            //     $trainingLoop = Training::create([
            //         'school_id' => $school->id,
            //         'course_id' => $variant->course->id,
            //         'variant_id' => $variant->id,
            //         'user_id' => $teachers->random()->id,
            //         'begins' => now(),
            //         'ends' => fake()->dateTimeBetween('+4 week', '+8 week'),
            //     ]);

            //     foreach ($customers as $customer) {
            //         $costs = $variant->getOptions()->where('type', 'fisso')->where('registration_type_id', 1)->get();
            //         $optionals = $variant->getOptions()->where('type', 'opzionale')->where('registration_type_id', 1)->get()->random(3);
            //         $priceCourseVariant = $variant->prices()->where('registration_type_id', 1)->first();
            //         $total = $priceCourseVariant->price;

            //         foreach ($costs as $cost) {
            //             $total += $cost->price;
            //         }
            //         foreach ($optionals as $optional) {
            //             $total += $optional->price;
            //         }

            //         Registration::create([
            //             'training_id' => $training->id,
            //             'customer_id' => $customer->id,
            //             'registration_type_id' => fake()->numberBetween(1,4),
            //             'branch_id' => random_int(1,3),
            //             'transmission' => fake()->randomElement(['manuale', 'automatica']),
            //             'optionals' => $optionals->pluck('id')->toJson(),
            //             'step_skipped' => json_encode([]),
            //             'price' => $total
            //         ]);

            //         Registration::create([
            //             'training_id' => $trainingLoop->id,
            //             'customer_id' => $customer->id,
            //             'registration_type_id' => fake()->numberBetween(1,4),
            //             'branch_id' => random_int(1,3),
            //             'transmission' => fake()->randomElement(['manuale', 'automatica']),
            //             'optionals' => $optionals->pluck('id')->toJson(),
            //             'step_skipped' => json_encode([]),
            //             'price' => $total
            //         ]);
            //     }
            // }
        }
    }
}
