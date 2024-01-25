<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Show as RegistryShow;
use App\Livewire\Forms\DocumentForm;
use LivewireUI\Modal\ModalComponent;

class DeleteDocument extends ModalComponent
{
    public DocumentForm $documentForm;

    public function mount($document) {
        $this->documentForm->setDocument($document);
    }

    public function delete() {
        $customer = $this->documentForm->identificationDocument->customer_id;
        $this->documentForm->delete();

        $this->closeModalWithEvents([
            RegistryShow::class => ['updateDocument', [$customer]]
        ]);
    }

    public function render()
    {
        return view('livewire.registry.modals.delete-document');
    }
}
