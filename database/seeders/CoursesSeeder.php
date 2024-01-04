<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CoursePrice;
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

    public function createPrice($course_id, $variant_id) {
        $licenses = [
            ['AM'],
            ['A1'],
            ['A2'],
            ['B', 'A2'],
            ['B']
        ];

        CoursePrice::create([
            'course_id' => $course_id,
            'variant_id' => $variant_id,
            'price' => fake()->numberBetween(200, 1800)
        ]);

        foreach ($licenses as $license) {
            CoursePrice::create([
                'course_id' => $course_id,
                'variant_id' => $variant_id,
                'licenses' => json_encode($license),
                'price' => fake()->numberBetween(200, 1800)
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
            ],
            [
                'name' => 'Duplicato per declassamento',
            ],
            [
                'name' => 'Duplicato per deterioramento',
            ],
            [
                'name' => 'Duplicato per smarrimento',
            ],
            [
                'name' => 'Conversione militare',
            ],
            [
                'name' => 'Conversione patente estera',
            ],
            [
                'name' => 'Permesso internazionale',
            ],
            [
                'name' => 'Carta del conducente',
            ],
            [
                'name' => 'Esperimento guida',
            ],
        ];
        $patents = [
            [
                'name' => 'Patente AM',
            ],
            [
                'name' => 'Patente A1',
            ],
            [
                'name' => 'Patente A2',
            ],
            [
                'name' => 'Patente A',
            ],
            [
                'name' => 'Guida accompagnata',
                'type' => 'service'
            ],
            [
                'name' => 'Patente B1',
            ],
            [
                'name' => 'Patente B',
            ],
            [
                'name' => 'Patente B codice 96',
            ],
            [
                'name' => 'Patente BE',
            ],
            [
                'name' => 'Guide di perfezionamento',
            ],
            [
                'name' => 'Patente speciali',
            ],
            [
                'name' => 'Recupero punti patente',
                'type' => 'service'
            ],
            [
                'name' => 'Revisione patente',
                'type' => 'service'
            ],
        ];
        $prof_patents = [
            [
                'name' => 'Patente C1',
            ],
            [
                'name' => 'Patente C1E',
            ],
            [
                'name' => 'Patente C',
            ],
            [
                'name' => 'Patente CE',
            ],
            [
                'name' => 'Patente D1',
            ],
            [
                'name' => 'Patente D1E',
            ],
            [
                'name' => 'Patente D',
            ],
            [
                'name' => 'Patente DE',
            ],
            [
                'name' => 'Guide di perfezionamento',
            ],
            [
                'name' => 'Patenti speciali',
            ],
            [
                'name' => 'Revisione patente',
                'type' => 'service'
            ],
        ];
        $trainings = [
            [
                'name' => 'Rilascio CQC',
            ],
            [
                'name' => 'Estensione CQC',
            ],
            [
                'name' => 'Rinnovo CQC',
            ],
            [
                'name' => 'Recupero punti CQC',
            ],
            [
                'name' => 'Corsi CQC',
                'type' => 'training'
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'scaduta da più di 3 anni',
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'per azzeramento punti',

            ],
            [
                'name' => 'Rilascio ADR',
            ],
            [
                'name' => 'Rinnovo ADR',
            ],
            [
                'name' => 'Rilascio KB',
            ],
            [
                'name' => 'Rinnovo KB',
            ],
        ];
        $courses = [
            [
                'name' => 'Attestati di formazione',
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'merci',
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'persone',
            ],
            [
                'name' => 'Insegnanti scuola guida',
            ],
            [
                'name' => 'Istruttore scuola guida',
            ],
            [
                'name' => 'Buon uso del cronotachigrafo',
                'label' =>  'scaduta da più di 3 anni',
            ],
            [
                'name' => 'Ispettori della revisione',
                'label' =>  'per azzeramento punti',

            ],
            [
                'name' => 'Corsi CQC',
            ],
            [
                'name' => 'Recupero punti',
                'type' => 'service'
            ],
        ];

        foreach ($services as $service) {
            switch ($service->name) {
                case 'Servizi al conducente':
                    foreach ($service_cond as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'type' => 'service',
                            'name' => $value['name'],
                            'description' => fake()->paragraph(),
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);
                    }
                    break;
                case 'Patenti':
                    foreach ($patents as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'type' => $value['type'] ?? 'training',
                            'name' => $value['name'],
                            'description' => fake()->paragraph(),
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);
                    }
                    break;
                case 'Formazione professionale':
                    foreach ($trainings as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'type' => $value['type'] ?? 'service',
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'description' => fake()->paragraph(),
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);
                    }
                    break;
                case 'Patenti professionali':
                    foreach ($prof_patents as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'type' => $value['type'] ?? 'training',
                            'name' => $value['name'],
                            'description' => fake()->paragraph(),
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);
                    }
                    break;
                case 'Corsi':
                    foreach ($courses as $value) {
                        $course = Course::create([
                            'service_id' => $service->id,
                            'type' => $value['type'] ?? 'training',
                            'name' => $value['name'],
                            'label' => $value['label'] ?? null,
                            'description' => fake()->paragraph(),
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);

                        for ($i=0; $i < 3; $i++) {
                            $variant = CourseVariant::create([
                                'course_id' => $course->id,
                                'name' => $value['name'] .' '. $i,
                                'description' => fake()->paragraph(),
                                'absences' => 3
                            ]);
                            $this->createLessons($course->id, $variant->id);
                            $this->createPrice($course->id, $variant->id);
                        }
                    }
                    break;

            }
        }
    }
}
