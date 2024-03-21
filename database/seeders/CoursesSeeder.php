<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CoursePrice;
use App\Models\CourseRegistrationStep;
use App\Models\CourseVariant;
use App\Models\Lesson;
use App\Models\RegistrationType;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

    public function createPrice($course_id, $variant_id = null) {

        $courseRegistrations = CourseRegistrationStep::where('course_id', $course_id)->where('variant_id', $variant_id)->get();

        foreach ($courseRegistrations as $courseRegistration) {
            CoursePrice::create([
                'course_id' => $course_id,
                'variant_id' => $variant_id,
                'registration_type_id' => $courseRegistration->registration_type_id,
                'price' => fake()->numberBetween(200, 1800)
            ]);
        }
    }

    public function createCourseRegistrationStep($course_id, $variant_id = null, $registration_types = []) {

        if (count($registration_types)) {
            foreach ($registration_types as $registrationType) {
                CourseRegistrationStep::create([
                    'course_id' => $course_id,
                    'variant_id' => $variant_id,
                    'registration_type_id' => $registrationType,
                    'steps_id' => json_encode($this->getCourseStep($registrationType, $course_id))
                ]);
            }
        }
    }

    public function getCourseStep($type, $course_id) {
        $steps = [];
        switch ($type) {
            case 1: // prima patente
                $steps = [1,2,3,4,5];

                if (in_array($course_id, ['10','11','14','15'])) {
                    $steps[] = 6;
                }
                if ($course_id == 14) {
                    $steps[] = 7;
                }
                break;
            case 2: // possessore di patente
                $steps = [3,4,5];
                break;
            case 3: // possessore guida accomagnata
                $steps = [3,4,5];
                break;
            case 4: // cambio codice
                $steps = [3,4,5,8];
                break;
        }

        return $steps;
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
                'type_visit' => 'rilascio',
                'registration_types' => [1,4],
            ],
            [
                'name' => 'Patente A1',
                'type_visit' => 'rilascio',
                'registration_types' => [1,4],
            ],
            [
                'name' => 'Patente A2',
                'type_visit' => 'rilascio',
                'registration_types' => [1,2,4],
            ],
            [
                'name' => 'Patente A',
                'type_visit' => 'rilascio',
                'registration_types' => [1,2,4],
            ],
            [
                'name' => 'Guida accompagnata',
                'type_visit' => 'rilascio',
                'registration_types' => [2],
            ],
            [
                'name' => 'Patente B1',
                'type_visit' => 'rilascio',
                'registration_types' => [1,4],
            ],
            [
                'name' => 'Patente B',
                'type_visit' => 'rilascio',
                'registration_types' => [1,2,3,4],
            ],
            [
                'name' => 'Patente B codice 96',
                'type_visit' => 'rilascio',
                'registration_types' => [1,4],
            ],
            [
                'name' => 'Patente BE',
                'type_visit' => 'rilascio',
                'registration_types' => [1,4],
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
                            'absences' => 3,
                            'guides' => $value['name'] == 'Guida accompagnata' ? 10 : 0
                        ]);

                        $this->createLessons($course->id, null);
                        $this->createCourseRegistrationStep($course->id, null, $value['registration_types'] ?? []);
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
                            'absences' => 3,
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
                            'absences' => 3,
                            'guides' => 0
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
