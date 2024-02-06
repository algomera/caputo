<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Document;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\DocumentForm;
use Livewire\WithFileUploads;

class ShowScan extends ModalComponent
{
    use WithFileUploads;

    public DocumentForm $documentForm;
    public $scan;

    public $newScan;

    public function mount($scan) {
        $this->scan = Document::find($scan);
    }

    public function updated($property) {
        if ($property == 'newScan') {
            $this->documentForm->updateScan($this->scan->id, $this->newScan);
            $this->mount($this->scan->id);
        }
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.registry.modals.show-scan');
    }
}
