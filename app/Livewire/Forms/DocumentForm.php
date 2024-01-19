<?php

namespace App\Livewire\Forms;

use App\Models\IdentificationDocument;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DocumentForm extends Form
{
    //Patente
    public $patent;
    public $n_document;
    public $document_release;
    public $document_from;
    public $document_expiration;
    public $qualification;

    //Documenti
    public $documents;

    public function setPatent($customer) {
        $this->patent = IdentificationDocument::where('customer_id', $customer)->where('type', 'patente di guida')->first();
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

    public function getDocuments($customer) {
        $this->documents = IdentificationDocument::where('customer_id', $customer)->whereNot('type', 'patente di guida')->get();
    }

    public function updateDocument($data) {

    }

}
