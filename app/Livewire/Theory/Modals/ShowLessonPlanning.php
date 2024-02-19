<?php

namespace App\Livewire\Theory\Modals;

use App\Models\LessonPlanning;
use App\Livewire\Theory\Trainings\Calendar;
use App\Models\Training;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ShowLessonPlanning extends ModalComponent
{
    public $training;
    public $lessonPlanning;
    public $endLesson;

    public function mount($training, $lessonPlanningId) {
        $this->training = Training::find($training);
        $this->lessonPlanning = LessonPlanning::find($lessonPlanningId)->first();
        $this->endLesson = Carbon::parse($this->lessonPlanning->begin)->addMinutes($this->lessonPlanning->lesson->duration);
    }

    public function cancel() {
        $this->lessonPlanning->update([
            'begin' => null
        ]);

        $this->closeModalWithEvents([Calendar::class => ['lessonRemove',
            ['lesson' => $this->lessonPlanning->id]
        ]]);
    }

    public function presences() {
        $this->dispatch('openModal', 'theory.modals.show-lesson-presences',
        [
            'lessonPlanning' => $this->lessonPlanning->id,
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.show-lesson-planning');
    }
}
