<?php

namespace App\Livewire\Theory\Modals;

use App\Livewire\Theory\Trainings\Calendar;
use App\Models\LessonPlanning;
use App\Models\Training;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class PlanLesson extends ModalComponent
{
    public $training;
    public $dateTime;
    public $lessonPlannings;

    public function mount($dateTime, $training) {
        $this->training = Training::find($training);
        $this->lessonPlannings = LessonPlanning::where('training_id', $training)->get();
        $this->dateTime = $dateTime;
    }

    public function schedule($lessonId) {
        $lessonPlanning = LessonPlanning::where('id', $lessonId)->with('training', 'lesson', 'user', 'course')->first();

        $lessonPlanning->update([
            'begin' => $this->dateTime['data']
        ]);

        $scheduleLesson = [
            'id' => $lessonPlanning->id,
            'training' => $lessonPlanning->training_id,
            'teacher' => $lessonPlanning->user->full_name,
            'lesson' => $lessonPlanning->lesson_id,
            'title' => $lessonPlanning->training->variant_id ? $lessonPlanning->training->courseVariant->name : $lessonPlanning->course->name,
            'argument' => $lessonPlanning->lesson->subject,
            'start' => $lessonPlanning->begin,
            'end' => Carbon::parse($lessonPlanning->begin)->addMinutes($lessonPlanning->lesson->duration),
            'color' => '#e8ffde',
            'customBorderColor' => '#01a53a'
        ];

        $this->closeModalWithEvents([Calendar::class => ['planningUpdate', ['lesson' => $scheduleLesson]]]);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.plan-lesson');
    }
}
