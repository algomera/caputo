<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Show as RegistryShow;
use App\Livewire\Forms\IdentificationDocumentForm;
use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;

class Document extends ModalComponent
{
    public IdentificationDocumentForm $identificationDocumentForm;
    public $customer;
    public $documentTypes;
    public $action;

    public function mount($customer = null, $document = null, $action = null) {
        $this->customer = Customer::find($customer);
        $this->documentTypes = $this->customer->otherIdentificationDocuments();
        $this->action = $action;

        if ($document) {
            $this->identificationDocumentForm->setDocument($document);
        }
    }

    public function save() {
        $this->identificationDocumentForm->store($this->customer->id);

        $registrations = $this->customer->registrations()->get();
        if (count($registrations)) {
            foreach ($registrations as $registration) {
                $stepSkipped = json_decode($registration->step_skipped);
                $step = array_search('fototessera', $stepSkipped);
                unset($stepSkipped[$step]);

                $registration->update([
                    'step_skipped' => json_encode(array_values($stepSkipped))
                ]);
            }
        }

        $this->closeModalWithEvents([
            RegistryShow::class => ['updateDocument', [$this->customer->id]]
        ]);
    }

    public function update() {
        $this->identificationDocumentForm->update();

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
