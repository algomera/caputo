<?php

namespace App\Livewire\Services\Commons;

use App\Livewire\Forms\CustomerForm;
use App\Models\Course;
use App\Models\Customer;
use App\Models\IdentificationDocument;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class StepRegister extends Component
{
    use WithFileUploads;

    public Course $course;
    public CustomerForm $customerForm;

    public $patent = null;
    public $customer = null;
    public $photo;
    public $signature;
    public $parentSignature;
    public $pathSignature;
    public $documents = [];
    public $documentUploaded = false;
    public $scans = [];
    public $parentScans = [];
    public $scanUploaded = false;
    public $parentScanUploaded = false;
    public $steps = [];
    public $typePatents = ['AM', 'A1', 'A2', 'A', 'B1','B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'DE'];

    public function mount($course) {
        $this->course = $course;

        if (session('patent')) {
            $this->patent = IdentificationDocument::where('n_document', session()->get('patent'))->first();

            if ($this->patent) {
                $this->customer = Customer::find($this->patent->customer_id);
            }
        }
        $this->setSteps();
    }

    public function back() {
        return redirect()->route('service');
    }

    public function setSteps() {
        if ($this->course->type == 'service') {
            $this->steps= [
                'dati',
                'recapiti',
                'documenti',
                'scansioni',
                'fototessera',
                'firma',
                'anamnestico'
            ];
        } else {
            $this->steps = [
                'dati',
                'recapiti',
                'documenti',
                'scansioni',
                'fototessera',
                'firma',
            ];
        }

        if (session()->get('course')['id'] == '10') {
            $this->steps[] = 'dati genitore/tutore';
        }
    }

    public function setCustomer($customer) {
        $this->customerForm->setCustomer($customer);
    }

    public function backStep() {
        $this->customerForm->currentStep -= 1;
    }

    public function nextStep() {
        $this->customerForm->setSchool(auth()->user()->schools()->first()->id);

        switch ($this->customerForm->currentStep) {
            case '1': //Dati
                $this->customerForm->store();
                $this->customerForm->currentStep += 1;
                break;
            case '2': //Recapiti
                $this->customerForm->store();
                $this->customerForm->currentStep += 1;
                break;
            case '3': //Documenti
                if ($this->documents) {
                    $this->customerForm->documents($this->documents);
                }
                $this->customerForm->currentStep += 1;
                break;
            case '4': //Scansioni
                if ($this->scans) {
                    $this->customerForm->scans($this->scans);
                }
                $this->customerForm->currentStep += 1;
                break;
            case '5': //Fototessera
                if ($this->photo) {
                    $this->customerForm->photo($this->photo);
                }
                $this->customerForm->currentStep += 1;
                break;
            case '6': //Firma
                if ($this->signature) {
                    $this->customerForm->signature($this->pathSignature);
                }
                $this->customerForm->currentStep += 1;
                if ($this->customerForm->currentStep > count($this->steps)) {
                    dd('registrazione completata', $this->customerForm->currentStep);
                    $this->dispatch('customer');
                }
                break;
            case '7': //Jolly
                if ($this->parentSignature) {
                    $this->customerForm->signature($this->pathSignature);
                }

                $this->customerForm->currentStep += 1;
                if ($this->customerForm->currentStep > count($this->steps)) {
                    dd('registrazione completata', $this->customerForm->currentStep);
                    $this->dispatch('customer');
                }
                break;
            case '8':
                # code...
                break;
        }
    }

    public function addDocument() {
        $this->documents[] = ['type' => ''];
    }

    public function updated($property) {

        if (str_contains($property,'documents')) {
            foreach ($this->documents as $key => $value) {
                if ($value['type'] != 'patente') {
                    unset($this->documents[$key]['qualification']);
                }

                if (count($this->documents[$key]) == 6 AND $value['type'] != '' AND $value['type'] == 'patente') {
                    $this->documentUploaded = true;
                } elseif (count($this->documents[$key]) == 5 AND $value['type'] != '' AND $value['type'] != 'patente') {
                    $this->documentUploaded = true;
                } else {
                    $this->documentUploaded = false;
                }
            }
        }

        if ($property == "scans") {
            $this->scanUploaded = true;
        }
        if ($property == "parentScan") {
            $this->parentScanUploaded = true;
        }
    }

    public function removeDocument($key) {
        unset($this->documents[$key]);

        if (count($this->documents) < 1) {
            $this->documentUploaded = false;
        }
    }

    public function removeScan($key) {
        unset($this->scans[$key]);

        if (count($this->scans) < 1) {
            $this->scanUploaded = false;
        }
    }

    public function removeParentScan($key) {
        unset($this->scans[$key]);

        if (count($this->parentScan) < 1) {
            $this->parentScanUploaded = false;
        }
    }

    public function getSignature() {
        $customer = $this->customerForm->newCustomer;
        if ($this->customerForm->currentStep == 6) {
            $this->pathSignature = Storage::putFileAs('customers/customer-'.$customer->id, $this->signature, 'firma.png');
        } elseif ($this->customerForm->currentStep == 7) {
            $this->pathSignature = Storage::putFileAs('customers/customer-'.$customer->id, $this->parentSignature, 'firma_genitore.png');
        }
        $this->dispatch('closeModal');
    }

    public function changeStep($index) {
        $this->customerForm->currentStep = $index;
    }

    public function render()
    {
        return view('livewire.services.commons.step-register');
    }
}
