<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $courseVariants = CourseVariant::all();

        $options = [
            [
                'name' => 'Presentazione domanda in motorizzazione',
                'price' => 100.00
            ],
            [
                'name' => '3 sedute di esame (1 possibilità di bocciatura)',
                'price' => 20.00
            ],
            [
                'name' => 'Stampa foglio rosa a superamento della prova a quiz',
                'price' => 60.00
            ],
            [
                'name' => 'Tutti i bollettini postali',
                'price' => 20.00
            ],
            [
                'name' => 'Certificato medico con marca da bollo',
                'price' => 64.40
            ],
            [
                'name' => 'Accompagnamento in motorizzazione a Foggia all’esame teorico',
                'price' => 50.00
            ],
            [
                'name' => 'Supporto audio',
                'price' => 00.00
            ],
            [
                'name' => 'Guide',
                'price' => 20.00
            ],
        ];

        foreach ($options as $key => $value) {
            $option = Option::create([
                'name' => $value['name'],
                'price' => $value['price']
            ]);

            foreach ($courses as $course) {
                $option->courses()->attach($course->id);
            }

            foreach ($courseVariants as $course) {
                $option->courseVariants()->attach($course->id);
            }
        }
    }
}
