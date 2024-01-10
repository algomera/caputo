<?php

namespace App\Livewire\Services\Training\Modals;

use LivewireUI\Modal\ModalComponent;

class RemindTT2112 extends ModalComponent
{

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.remind-t-t2112');
    }
}
