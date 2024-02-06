<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Modals\Scans;
use App\Livewire\Forms\DocumentForm;
use App\Models\Document;
use ReflectionClass;
use LivewireUI\Modal\ModalComponent;

class DeleteScan extends ModalComponent
{
    public DocumentForm $documentForm;
    public $scan;

    public function mount($scan) {
        $this->scan = Document::find($scan);
    }

    public function delete() {
        $this->documentForm->deleteScan($this->scan->id);

        $type = $this->scan->documentable_type;
        $documentClass = new ReflectionClass($type);
        $className = $documentClass->getShortName();

        if ($className == 'Customer') {
            $this->closeModalWithEvents([
                Scans::class => ['updateScan', ['customer' => $this->scan->documentable_id]]
            ]);
        } else {
            $this->closeModalWithEvents([
                Scans::class => ['updateScan', ['registration' => $this->scan->documentable_id]]
            ]);
        }
    }

    public function render()
    {
        return view('livewire.registry.modals.delete-scan');
    }
}
