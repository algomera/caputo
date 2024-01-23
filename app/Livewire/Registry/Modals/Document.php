<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Show as RegistryShow;
use App\Livewire\Forms\DocumentForm;
use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;

class Document extends ModalComponent
{
    public DocumentForm $documentForm;
    public $customer;
    public $documentTypes;
    public $action;

    public function mount($customer = null, $document = null, $action = null) {
        $this->customer = Customer::find($customer);
        $this->documentTypes = $this->customer->otherIdentificationDocuments();
        $this->action = $action;

        if ($document) {
            $this->documentForm->setDocument($document);
        }
    }

    public function save() {
        $this->documentForm->store($this->customer->id);

        $this->closeModalWithEvents([
            RegistryShow::class => ['updateDocument', [$this->customer->id]]
        ]);
    }

    public function update() {
        $this->documentForm->update();

        $this->closeModalWithEvents([
            RegistryShow::class => ['updateDocument', [$this->customer->id]]
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.document');
    }
}
