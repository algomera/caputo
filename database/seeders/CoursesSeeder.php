<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CoursePrice;
use App\Models\CourseVariant;
use App\Models\Lesson;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stringable;

class CoursesSeeder extends Seeder
{

    public function createLessons($course_id, $variant_id) {
        for ($i=0; $i < 5; $i++) {
            Lesson::create([
                'course_id' => $course_id,
                'variant_id' => $variant_id,
                'type' => fake()->randomElement(['teoria', 'pratica']) ,
                'subject' => fake()->name(),
                'description' => fake()->paragraph(),
                'duration' => fake()->randomElement([30, 60, 90, 120]),
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
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Duplicato per declassamento',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Duplicato per deterioramento',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Duplicato per smarrimento',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Conversione militare',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Conversione patente estera',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Permesso internazionale',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Carta del conducente',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Esperimento guida',
                'type_visit' => 'rinnovo'
            ],
        ];
        $patents = [
            [
                'name' => 'Patente AM',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente A1',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente A2',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente A',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Guida accompagnata',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente B1',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente B',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente B codice 96',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente BE',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Guide di perfezionamento',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente speciali',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Recupero punti patente',
                'type' => 'service',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Revisione patente',
                'type' => 'service',
                'type_visit' => 'rinnovo'
            ],
        ];
        $prof_patents = [
            [
                'name' => 'Patente C1',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente C1E',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente C',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente CE',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente D1',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente D1E',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente D',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patente DE',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Guide di perfezionamento',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Patenti speciali',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Revisione patente',
                'type' => 'service',
                'type_visit' => 'rinnovo'
            ],
        ];
        $trainings = [
            [
                'name' => 'Rilascio CQC',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Estensione CQC',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Rinnovo CQC',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Recupero punti CQC',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Corsi CQC',
                'type' => 'training',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'scaduta da più di 3 anni',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Revisione CQC',
                'label' =>  'per azzeramento punti',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Rilascio ADR',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Rinnovo ADR',
                'type_visit' => 'rinnovo'
            ],
            [
                'name' => 'Rilascio KB',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Rinnovo KB',
                'type_visit' => 'rinnovo'
            ],
        ];
        $courses = [
            [
                'name' => 'Attestati di formazione',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'merci',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Accesso alla professione',
                'label' => 'persone',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Insegnanti scuola guida',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Istruttore scuola guida',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Buon uso del cronotachigrafo',
                'label' =>  'scaduta da più di 3 anni',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Ispettori della revisione',
                'label' =>  'per azzeramento punti',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Corsi CQC',
                'type_visit' => 'rilascio'
            ],
            [
                'name' => 'Recupero punti',
                'type' => 'service',
                'type_visit' => 'rinnovo'
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
                            'slug' => Str::slug($value['name']),
                            'description' => fake()->paragraph(),
                            'type_visit' => $value['type_visit'],
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
                            'slug' => Str::slug($value['name']),
                            'description' => fake()->paragraph(),
                            'type_visit' => $value['type_visit'],
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
                            'slug' => Str::slug($value['name']),
                            'label' => $value['label'] ?? null,
                            'description' => fake()->paragraph(),
                            'type_visit' => $value['type_visit'],
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
                            'slug' => Str::slug($value['name']),
                            'description' => fake()->paragraph(),
                            'type_visit' => $value['type_visit'],
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
                            'slug' => Str::slug($value['name']),
                            'label' => $value['label'] ?? null,
                            'description' => fake()->paragraph(),
                            'type_visit' => $value['type_visit'],
                            'absences' => 3
                        ]);
                        $this->createLessons($course->id, null);
                        $this->createPrice($course->id, null);

                        for ($i=0; $i < 3; $i++) {
                            $variant = CourseVariant::create([
                                'course_id' => $course->id,
                                'type' => $value['type'] ?? 'training',
                                'name' => $value['name'] .' '. $i,
                                'slug' => Str::slug($value['name'] .' '. $i),
                                'description' => fake()->paragraph(),
                                'type_visit' => $value['type_visit'],
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
