<?php

namespace App\Console\Commands;

use App\Models\LessonPlanning as ModelsLessonPlanning;
use App\Models\School;
use DateTime;
use Illuminate\Console\Command;

class LessonPlanning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lesson-planning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pianificazione lezioni';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = new DateTime();

        foreach (School::all() as $school) {
            // Prendo tutti i corsi in loop delle autoscuole
           $trainings = $school->trainings()->whereNull('ends')->get();

            foreach ($trainings as $training) {
                // Verifico la data di inizio corso
                if ($now->format('Y-m-d') >= $training->begins) {
                    // Prendo le lezioni previste per il corso
                    $lessons = $training->course->lessons()->get();

                    // Prendo tutte le lezioni gia programmate per il corso
                    $plannings = $training->plannings()->get();

                    // Verifico in base a precedenti lezioni programmate se e un corso nuovo
                    if (count($plannings)) {
                        // Verifico se le lezioni del corso sono state tutte programmate
                        if (!(count($plannings) % count($lessons))) {
                            $currentDate = new DateTime();

                            // Prendo la data dell'ultima lezione programmata
                            $lastLessonDate = $plannings->last()->begin;
                            $now = new DateTime($lastLessonDate);

                            // Verifico se la data odierna e uguale all'ultima lezione programmata
                            if ($currentDate->format('Y-m-d') === $now->format('Y-m-d')) {

                                // Programmo nuovamente tutte le lezioni previste nel corso
                                foreach ($lessons as $lesson) {
                                    $now = $now->modify('+1 day');
                                    $day = $now->format('N');

                                    // Verifico se e domenica
                                    if ($day != 7) {
                                        ModelsLessonPlanning::create([
                                            'training_id' => $training->id,
                                            'lesson_id' => $lesson->id,
                                            'begin' => $now->format('Y-m-d H:i:s')
                                        ]);
                                    } else {
                                        $now = $now->modify('+1 day');

                                        ModelsLessonPlanning::create([
                                            'training_id' => $training->id,
                                            'lesson_id' => $lesson->id,
                                            'begin' => $now->format('Y-m-d H:i:s')
                                        ]);
                                    }
                                }
                            }
                        }
                    } else {
                        $now = new DateTime($training->begins.' '.$training->time_start);

                        // Programmo tutte le lezioni previste nel corso
                        foreach ($lessons as $lesson) {
                            $now = $now->modify('+1 day');
                            $day = $now->format('N');

                            // Verifico se e domenica
                            if ($day != 7) {
                                ModelsLessonPlanning::create([
                                    'training_id' => $training->id,
                                    'lesson_id' => $lesson->id,
                                    'begin' => $now->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $now = $now->modify('+1 day');

                                ModelsLessonPlanning::create([
                                    'training_id' => $training->id,
                                    'lesson_id' => $lesson->id,
                                    'begin' => $now->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                }
            }
        }

    }
}
