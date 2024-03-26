<?php

namespace App\Livewire\Theory\Modals;

use App\Models\LessonPlanning;
use App\Livewire\Theory\Trainings\Calendar;
use App\Models\Presence;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ShowLessonPresences extends ModalComponent
{
    public $lessonPlanning;
    public $presences = [];
    public $endLesson;

    public function mount($lessonPlanning) {
        $this->lessonPlanning = LessonPlanning::find($lessonPlanning);
        $this->endLesson = Carbon::parse($this->lessonPlanning->begin)->addMinutes($this->lessonPlanning->lesson->duration);

        if (count($this->lessonPlanning->presences()->get()) > 0) {
            foreach ($this->lessonPlanning->presences()->get() as $presence) {
                $this->presences[$presence->customer_id] = [
                    'customer' => $presence->customer_id,
                    'followed' => $presence->followed
                ];
            }
        } else {
            foreach ($this->lessonPlanning->training->customers()->get() as $customer) {
                $this->presences[$customer->id] = [
                    'customer' => $customer->id,
                    'followed' => null
                ];
            }
        }
    }

    public function add($customerId) {
        $this->presences[$customerId]['followed'] = 1;
    }

    public function remove($customerId) {
        $this->presences[$customerId]['followed'] = 0;
    }

    public function save() {
        foreach ($this->presences as $presence) {
            Presence::updateOrCreate([
                'lesson_planning_id' => $this->lessonPlanning->id,
                'customer_id' => $presence['customer']
            ],
            [
                'lesson_planning_id' => $this->lessonPlanning->id,
                'customer_id' => $presence['customer'],
                'followed' => $presence['followed'] === null ? false : $presence['followed']
            ]);
        }

        $this->forceClose()->closeModal();
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-lg';
    }

    public function render()
    {
        return view('livewire.theory.modals.show-lesson-presences');
    }
}
