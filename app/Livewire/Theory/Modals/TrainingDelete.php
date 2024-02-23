<?php

namespace App\Livewire\Theory\Modals;

use App\Livewire\Theory\Trainings\Index as TrainingIndex;
use App\Models\Training;
use LivewireUI\Modal\ModalComponent;

class TrainingDelete extends ModalComponent
{
    public $training;

    public function mount($training) {
        $this->training = Training::find($training);
    }

    public function delete() {
        $this->training->delete();

        $this->closeModalWithEvents([
            TrainingIndex::class => 'UpdateTrainingIndex',
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.training-delete');
    }
}
