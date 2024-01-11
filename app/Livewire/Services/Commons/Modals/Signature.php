<?php

namespace App\Livewire\Services\Commons\Modals;

use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class Signature extends ModalComponent
{
    public $signature;

    public function mount($signature = null) {
        $this->signature = $signature;
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
