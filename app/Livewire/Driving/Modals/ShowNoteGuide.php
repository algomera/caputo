<?php

namespace App\Livewire\Driving\Modals;

use App\Models\DrivingPlanning;
use LivewireUI\Modal\ModalComponent;

class ShowNoteGuide extends ModalComponent
{
    public $guide;

    public function mount($guide) {
        $this->guide = DrivingPlanning::find($guide);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.driving.modals.show-note-guide');
    }
}
