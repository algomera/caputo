<?php

namespace App\Livewire\Services\Commons\Modals;

use LivewireUI\Modal\ModalComponent;

class Signature extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.services.commons.modals.signature');
    }
}
