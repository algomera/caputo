<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class ShowSkipped extends ModalComponent
{
    public Registration $registration;

    public function mount($registration) {
        $this->registration = $registration;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.show-skipped');
    }
}
