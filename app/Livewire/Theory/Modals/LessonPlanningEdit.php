<?php

namespace App\Livewire\Theory\Modals;

use App\Livewire\Theory\Lessons\Index as LessonIndex;
use App\Models\LessonPlanning;
use LivewireUI\Modal\ModalComponent;

class LessonPlanningEdit extends ModalComponent
{
    public $lessonPlanning;
    public $dateTime;

    public function mount($planningId) {
        $this->lessonPlanning = LessonPlanning::find($planningId);
        $this->dateTime = date("Y-m-d H:i", strtotime($this->lessonPlanning->begin));
    }

    public function edit() {
        $this->lessonPlanning->update([
            'begin' => $this->dateTime
        ]);

        $this->closeModalWithEvents([
            LessonIndex::class => ['updateLesson', ['training' => $this->lessonPlanning->training->id]],
        ]);
}

    public function render()
    {
        return view('livewire.theory.modals.lesson-planning-edit');
    }
}
