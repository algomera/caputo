<?php

namespace App\Livewire\Services\Training\Modals;

use LivewireUI\Modal\ModalComponent;

class AudioSupport extends ModalComponent
{
    public $pdfModel;

    public function cancel() {
        $this->dispatch('removeSupport');
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.audio-support');
    }
}
