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
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per declassamento',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per deterioramento',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Duplicato per smarrimento',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Conversione militare',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Conversione patente estera',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Permesso internazionale',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Carta del conducente',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Esperimento guida',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $patents = [
            [
                'name' => 'Patente AM',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A1',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A2',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente A',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guida accompagnata',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B1',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente B codice 96',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente BE',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guide di perfezionamento',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente speciali',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti patente',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione patente',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $prof_patents = [
            [
                'name' => 'Patente C1',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente C1E',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente C',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente CE',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D1',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D1E',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente D',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patente DE',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Guide di perfezionamento',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Patenti speciali',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione patente',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $trainings = [
            [
                'name' => 'Rilascio CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Estensione CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Corsi CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'scaduta da più di 3 anni',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'per azzeramento punti',
                 'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rilascio ADR',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo ADR',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rilascio KB',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Rinnovo KB',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];
        $courses = [
            [
                'name' => 'Attestati di formazione',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'merci',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'persone',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Insegnanti scuola guida',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Istruttore scuola guida',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Buon uso del cronotachigrafo',
                'label' =>  'scaduta da più di 3 anni',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Ispettori della revisione',
                'label' =>  'per azzeramento punti',
                 'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Corsi CQC',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
            [
                'name' => 'Recupero punti',
                'duration' => fake()->numberBetween(20, 80),
                'price' => fake()->numberBetween(300, 1800)
            ],
        ];

        foreach ($services as $service) {
            switch ($service->name) {
                case 'Servizi al conducente':
                    foreach ($service_cond as $value) {
                        Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'duration' => $value['duration'],
                            'price' => $value['price']
                        ]);
                    }
                    break;
                case 'Patenti':
                    foreach ($patents as $value) {
                        Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'duration' => $value['duration'],
                            'price' => $value['price']
                        ]);
                    }
                    break;
                case 'Formazione professionale':
                    foreach ($trainings as $value) {
                        Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'duration' => $value['duration'],
                            'price' => $value['price']
                        ]);
                    }
                    break;
                case 'Patenti professionali':
                    foreach ($prof_patents as $value) {
                        Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'duration' => $value['duration'],
                            'price' => $value['price']
                        ]);
                    }
                    break;
                case 'Corsi':
                    foreach ($courses as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'duration' => $value['duration'],
                            'price' => $value['price']
                        ]);
                        $this->createLessons($course->id, null);

                        for ($i=0; $i < 3; $i++) {
                            $variant = CourseVariant::create([
                                'course_id' => $course->id,
                                'name' => $value['name'] .' '. $i,
                                'duration' => fake()->numberBetween(10, 60),
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
