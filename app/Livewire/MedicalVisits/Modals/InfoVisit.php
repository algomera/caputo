<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Models\MedicalPlanning;
use App\Livewire\MedicalVisits\Calendar;
use LivewireUI\Modal\ModalComponent;

class InfoVisit extends ModalComponent
{
    public $visit;

    public function mount($visit) {
        $this->visit = MedicalPlanning::find($visit);
    }

    public function delete() {
        $this->visit->update([
            'booked' => null
        ]);

        $this->closeModalWithEvents([
            Calendar::class => 'visitUpdate',
        ]);
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.info-visit');
    }
}
