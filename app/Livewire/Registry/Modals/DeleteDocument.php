<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Show as RegistryShow;
use App\Livewire\Forms\IdentificationDocumentForm;
use LivewireUI\Modal\ModalComponent;

class DeleteDocument extends ModalComponent
{
    public IdentificationDocumentForm $identificationDocumentForm;

    public function mount($document) {
        $this->identificationDocumentForm->setDocument($document);
    }

    public function delete() {
        $customer = $this->identificationDocumentForm->identificationDocument->customer_id;
        $this->identificationDocumentForm->delete();

        $this->closeModalWithEvents([
            RegistryShow::class => ['updateDocument', [$customer]]
        ]);
    }

    public function render()
    {
        return view('livewire.registry.modals.delete-document');
    }
}
