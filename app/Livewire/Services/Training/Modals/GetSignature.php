<?php

namespace App\Livewire\Services\Training\Modals;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;


class GetSignature extends ModalComponent
{
    public $signature = false;

    public function next() {
        dd('si continua con i pagamenti');
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    #[On('uploadedSignature')]
    public function uploadedSignature() {
        $this->signature = true;
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.get-signature');
    }
}
