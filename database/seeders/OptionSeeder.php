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
                'type' => 'fisso',
                'registration_type_id' => 1,
                'price' => 100.00
            ],
            [
                'name' => '3 sedute di esame (1 possibilità di bocciatura)',
                'type' => 'fisso',
                'registration_type_id' => 1,
                'price' => 20.00
            ],
            [
                'name' => 'Stampa foglio rosa a superamento della prova a quiz',
                'type' => 'fisso',
                'registration_type_id' => 1,
                'price' => 60.00
            ],
            [
                'name' => 'Presentazione della richiesta di cambio codice',
                'type' => 'fisso',
                'registration_type_id' => 4,
                'price' => 50.00
            ],
            [
                'name' => 'Sedute di esame',
                'type' => 'fisso',
                'registration_type_id' => 4,
                'price' => 20.00
            ],
            [
                'name' => 'Stampa foglio rosa',
                'type' => 'fisso',
                'registration_type_id' => 4,
                'price' => 30.00
            ],
            [
                'name' => 'bollettino per la richiesta di cambio codice',
                'type' => 'fisso',
                'registration_type_id' => 4,
                'price' => 20.00
            ],
            [
                'name' => 'Cambio trasmissione',
                'type' => 'opzionale',
                'registration_type_id' => 4,
                'price' => 10.20
            ],
            [
                'name' => 'Presentazione domanda in motorizzazione',
                'type' => 'fisso',
                'registration_type_id' => 2,
                'price' => 100.0
            ],
            [
                'name' => '3 sedute di esame (1 possibilità di bocciatura)',
                'type' => 'fisso',
                'registration_type_id' => 2,
                'price' => 20.0
            ],
            [
                'name' => 'Stampa foglio rosa',
                'type' => 'fisso',
                'registration_type_id' => 2,
                'price' => 20.0
            ],
            [
                'name' => 'Presentazione domanda in motorizzazione',
                'type' => 'fisso',
                'registration_type_id' => 3,
                'price' => 100.0
            ],
            [
                'name' => 'Tutti i bollettini postali',
                'type' => 'fisso',
                'registration_type_id' => 3,
                'price' => 20.0
            ],
            [
                'name' => 'Rilascio attestato',
                'type' => 'fisso',
                'registration_type_id' => 3,
                'price' => 60.0
            ],
            [
                'name' => 'Tutti i bollettini postali',
                'type' => 'opzionale',
                'registration_type_id' => 1,
                'price' => 20.00
            ],
            [
                'name' => 'Certificato medico con marca da bollo',
                'type' => 'opzionale',
                'registration_type_id' => 1,
                'price' => 64.40
            ],
            [
                'name' => 'Accompagnamento in motorizzazione a Foggia all’esame teorico',
                'type' => 'opzionale',
                'registration_type_id' => 1,
                'price' => 50.00
            ],
            [
                'name' => 'Supporto audio',
                'type' => 'opzionale',
                'registration_type_id' => 1,
                'price' => 00.00
            ],
            [
                'name' => 'Tutti i bollettini cambio codice',
                'type' => 'opzionale',
                'registration_type_id' => 4,
                'price' => 10.20
            ],
            [
                'name' => 'Tutti i bollettini postali',
                'type' => 'opzionale',
                'registration_type_id' => 2,
                'price' => 20.0
            ],
            [
                'name' => 'Certificato medico con marca da bollo',
                'type' => 'opzionale',
                'registration_type_id' => 2,
                'price' => 20.0
            ],
            [
                'name' => 'Guide standard',
                'type' => 'guide',
                'registration_type_id' => 1,
                'price' => 20.00
            ],
            [
                'name' => 'Guide professionali',
                'type' => 'guide',
                'registration_type_id' => 1,
                'price' => 35.00
            ],
            [
                'name' => 'Certificato medico con marca da bollo',
                'type' => 'opzionale',
                'registration_type_id' => 3,
                'price' => 64.40
            ],
        ];

        foreach ($options as $value) {
            $option = Option::create([
                'name' => $value['name'],
                'type' => $value['type'],
                'registration_type_id' => $value['registration_type_id'],
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
