<?php

namespace Database\Seeders;

use App\Models\LessonPlanning;
use App\Models\Training;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
