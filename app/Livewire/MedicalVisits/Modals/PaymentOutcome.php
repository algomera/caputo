<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Livewire\MedicalVisits\Index as MedicalVisitIndex;
use LivewireUI\Modal\ModalComponent;

class PaymentOutcome extends ModalComponent
{
    public function next() {
        $this->dispatch('updateVisit');
        
        $this->forceClose()->closeModalWithEvents([
            MedicalVisitIndex::class => 'visitModified',
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.payment-outcome');
    }
}
