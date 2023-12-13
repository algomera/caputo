<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\Lesson;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{

    public function createLessons($course_id, $variant_id) {
        for ($i=0; $i < 20; $i++) {
            Lesson::create([
                'course_id' => $course_id,
                'variant_id' => $variant_id,
                'type' => fake()->randomElement(['teoria', 'pratica']) ,
                'subject' => fake()->name(),
                'description' => fake()->paragraph(),
                'duration' => fake()->numberBetween(30, 240),
            ]);
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();
        $service_cond = [
            [
                'name' => 'Conferma patente',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per declassamento',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per deterioramento',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per smarrimento',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Conversione militare',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Conversione patente estera',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Permesso internazionale',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Carta del conducente',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Esperimento guida',
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $patents = [
            [
                'name' => 'Patente AM',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A1',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A2',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guida accompagnata',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B1',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B codice 96',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente BE',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guide di perfezionamento',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente speciali',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti patente',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione patente',
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $prof_patents = [
            [
                'name' => 'Patente C1',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente C1E',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente C',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente CE',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D1',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D1E',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente DE',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guide di perfezionamento',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patenti speciali',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione patente',
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $trainings = [
            [
                'name' => 'Rilascio CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Estensione CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Corsi CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'scaduta da più di 3 anni',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'per azzeramento punti',

                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rilascio ADR',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo ADR',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rilascio KB',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo KB',
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $courses = [
            [
                'name' => 'Attestati di formazione',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'merci',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'persone',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Insegnanti scuola guida',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Istruttore scuola guida',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Buon uso del cronotachigrafo',
                'label' =>  'scaduta da più di 3 anni',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Ispettori della revisione',
                'label' =>  'per azzeramento punti',

                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Corsi CQC',
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti',
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];

        foreach ($services as $service) {
            switch ($service->name) {
                case 'Servizi al conducente':
                    foreach ($service_cond as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);
                    }
                    break;
                case 'Patenti':
                    foreach ($patents as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);
                    }
                    break;
                case 'Formazione professionale':
                    foreach ($trainings as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);
                    }
                    break;
                case 'Patenti professionali':
                    foreach ($prof_patents as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);
                    }
                    break;
                case 'Corsi':
                    foreach ($courses as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);

                        for ($i=0; $i < 3; $i++) {
                            $variant = CourseVariant::create([
                                'course_id' => $course->id,
                                'name' => $value['name'] .' '. $i,
                                'price' => fake()->numberBetween(300, 1800)
                            ]);
                            $this->createLessons($course->id, $variant->id);
                        }
                    }
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
}
