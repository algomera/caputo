<?php

namespace App\Livewire\Registry;

use Livewire\Component;
use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\DocumentForm;
use Livewire\WithFileUploads;


class Show extends Component
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public DocumentForm $documentForm;
    public $modify = false;
    public $photo;

    public $types;
    public $document = null;
    public $n_document;
    public $document_release;
    public $document_from;
    public $document_expiration;

    public function mount($customer) {
        $this->customerForm->setCustomer($customer);
        $this->documentForm->setPatent($customer);
        $this->documentForm->getDocuments($customer);
        $this->setDocument();
    }

    public function updated($property) {
        if ($property == 'document') {
            $this->setDocument();
        }
        if ($property == 'modify') {
            $this->dispatch('modifyData', $this->modify);
        }
    }

    public function setDocument() {
        $this->types = $this->documentForm->documents->pluck('type');

        if ($this->document) {
            $document = $this->documentForm->documents->where('type', $this->document)->first();
            $this->n_document = $document->n_document;
            $this->document_release = $document->document_release;
            $this->document_from = $document->document_from;
            $this->document_expiration = $document->document_expiration;
        } else {
            $this->n_document = $this->documentForm->documents->first()->n_document;
            $this->document_release = $this->documentForm->documents->first()->document_release;
            $this->document_from = $this->documentForm->documents->first()->document_from;
            $this->document_expiration = $this->documentForm->documents->first()->document_expiration;
        }
    }

    public function save() {
        if ($this->photo) {
            $this->customerForm->photo($this->photo);
        }
    }

    public function back() {
        return redirect()->route('registry.index');
    }

    public function render()
    {
        return view('livewire.registry.show');
    }
}
