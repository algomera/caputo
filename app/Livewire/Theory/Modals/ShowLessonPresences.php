<?php

namespace App\Livewire\Theory\Modals;

use App\Models\LessonPlanning;
use App\Livewire\Theory\Trainings\Calendar;
use App\Models\Presence;
use LivewireUI\Modal\ModalComponent;

class ShowLessonPresences extends ModalComponent
{
    public $lessonPlanning;
    public $selected = [];

    public function mount($lessonPlanning) {
        $this->lessonPlanning = LessonPlanning::find($lessonPlanning);
    }

    public function add($customerId) {
        $this->selected[$customerId] = $customerId;
    }

    public function remove($customerId) {
        unset($this->selected[$customerId]);
    }

    public function save() {
        foreach ($this->selected as $customerId) {
            Presence::create([
                'lesson_planning_id' => $this->lessonPlanning->id,
                'customer_id' => $customerId,
                'followed' => true
            ]);
        }

        $this->closeModalWithEvents([
            Calendar::class => 'planningUpdate',
        ]);

        return redirect()->route('theory.trainings.calendar', ['training' => $this->lessonPlanning->training_id]);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.show-lesson-presences');
    }
}
