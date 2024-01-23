<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\IdentificationDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DocumentForm extends Form
{
    //Patente
    public $patent;
    public $qualification;

    public $document;
    public $identification_type_id;
    public $n_document;
    public $document_release;
    public $document_from;
    public $document_expiration;

    //Documenti
    public $documents;

    public function rules() {
        return [
            'identification_type_id' => 'required',
            'n_document' => 'required',
            'document_release' => 'required',
            'document_from' => 'required',
            'document_expiration' => 'required',
        ];
    }
    public function messages() {
        return [
            'identification_type_id.required' => 'Campo richiesto',
            'n_document.required' => 'Campo richiesto',
            'document_release.required' => 'Campo richiesto',
            'document_from.required' => 'Campo richiesto',
            'document_expiration.required' => 'Campo richiesto',
        ];
    }

    public function setPatent($customer) {
        $this->patent = IdentificationDocument::where('customer_id', $customer)->where('identification_type_id', 2)->first();

        if ($this->patent) {
            $this->fill(
                $this->patent->only(
                    'n_document',
                    'document_release',
                    'document_from',
                    'document_expiration',
                    'qualification',
                )
            );
        }
    }

    public function setDocument($documentId) {
        $this->document = IdentificationDocument::find($documentId);
        if ($this->document) {
            $this->fill(
                $this->document->only(
                    'identification_type_id',
                    'n_document',
                    'document_release',
                    'document_from',
                    'document_expiration'
                )
            );
        }
    }

    public function getDocuments($customer) {
        $this->documents = IdentificationDocument::where('customer_id', $customer)->whereNot('identification_type_id', 2)->get();
    }

    public function store($customerId) {
        $this->validate();
        $customer = Customer::find($customerId);

        $customer->identificationDocuments()->create([
            'identification_type_id' => $this->identification_type_id,
            'n_document' => $this->n_document,
            'document_release' => $this->document_release,
            'document_from' => $this->document_from,
            'document_expiration' => $this->document_expiration,
        ]);
    }

    public function update() {
        $this->validate();

        $this->document->update([
            'n_document' => $this->n_document,
            'document_release' => $this->document_release,
            'document_from' => $this->document_from,
            'document_expiration' => $this->document_expiration,
        ]);
    }

    public function delete() {
        $this->document->delete();
    }

}
