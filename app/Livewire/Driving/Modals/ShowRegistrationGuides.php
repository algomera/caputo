<?php

namespace App\Livewire\Driving\Modals;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class ShowRegistrationGuides extends ModalComponent
{
    public $registration;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        $guides = $this->registration->drivingPlanning;

        return view('livewire.driving.modals.show-registration-guides', [
            'guides' => $guides
        ]);
    }
}
