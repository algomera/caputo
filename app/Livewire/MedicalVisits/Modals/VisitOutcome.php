<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Models\MedicalPlanning;
use LivewireUI\Modal\ModalComponent;

class VisitOutcome extends ModalComponent
{
    public $visit;

    public function mount($visitId) {
        $this->visit = MedicalPlanning::find($visitId);
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.visit-outcome');
    }
}
