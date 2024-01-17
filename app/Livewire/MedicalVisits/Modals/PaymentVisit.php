<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class PaymentVisit extends ModalComponent
{
    public Registration $registration;

    public function mount($registration) {
        $this->registration = $registration;
    }

    public function pay() {
        $this->registration->medicalPlanning->update([
            'welded' => true
        ]);

        $this->dispatch('openModal', 'medical-visits.modals.payment-outcome');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.payment-visit');
    }
}
