<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class AlertMissingData extends ModalComponent
{
    public $alertRegistrations;

    public function mount($registrations) {
        $this->alertRegistrations = Registration::whereIn('id', array_values($registrations))->get();
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.alert-missing-data');
    }
}
