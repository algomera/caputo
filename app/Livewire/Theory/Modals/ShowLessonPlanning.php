<?php

namespace App\Livewire\Theory\Modals;

use App\Models\LessonPlanning;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ShowLessonPlanning extends ModalComponent
{
    public $lessonPlanning;
    public $endLesson;

    public function mount($lessonPlanningId) {
        $this->lessonPlanning = LessonPlanning::find($lessonPlanningId)->first();
        $this->endLesson = Carbon::parse($this->lessonPlanning->begin)->addMinutes($this->lessonPlanning->lesson->duration);
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
