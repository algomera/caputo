<?php

namespace App\Livewire\Services\Commons\Modals;

use LivewireUI\Modal\ModalComponent;

class Signature extends ModalComponent
{
    public $signature;
    public $key;

    public function mount($signature = null, $key = null) {
        $this->signature = $signature;
        $this->$key = $key;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.services.commons.modals.signature');
    }
}
