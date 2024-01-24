<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Document;
use LivewireUI\Modal\ModalComponent;

class ShowScan extends ModalComponent
{
    public Document $scan;

    public function mount($scan) {
        $this->scan = $scan;
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.show-scan');
    }
}
