<?php

namespace App\Livewire\Theory\Modals;

use App\Livewire\Theory\Trainings\Calendar;
use App\Models\LessonPlanning;
use App\Models\Training;
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
        $lessonPlanning = LessonPlanning::find($lessonId);

        $lessonPlanning->update([
            'begin' => $this->dateTime['data']
        ]);

        $this->closeModalWithEvents([
            Calendar::class => 'planningUpdate',
        ]);

        return redirect()->route('theory.trainings.calendar', ['training' => $this->training->id]);
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
