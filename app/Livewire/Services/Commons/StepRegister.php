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
    public $pathSignature;
    public $documents = [];
    public $steps = [];

    public function mount($course) {
        $this->course = $course;

        if (session('patent')) {
            $this->patent = IdentificationDocument::where('n_patent', session()->get('patent'))->first();

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
                'fototessera',
                'scansioni',
                'firma',
                'anamnestico'
            ];
        } else {
            $this->steps = [
                'dati',
                'recapiti',
                'fototessera',
                'scansioni',
                'firma',
            ];
        }
    }

    public function setNewCustomer($customer) {

    }

    public function backStep() {
        $this->customerForm->currentStep -= 1;
    }

    public function nextStep() {
        $this->customerForm->setSchool(auth()->user()->schools()->first()->id);

        if ($this->customerForm->currentStep == 1) {
            $this->customerForm->store();
            $this->customerForm->currentStep += 1;
        } elseif ($this->customerForm->currentStep == 2) {
            $this->customerForm->store();
            $this->customerForm->currentStep += 1;
        } elseif ($this->customerForm->currentStep == 3) {
            if ($this->photo) {
                $this->customerForm->photo($this->photo);
            }
            $this->customerForm->currentStep += 1;
        } elseif ($this->customerForm->currentStep == 4) {
            if ($this->documents) {
                $this->customerForm->documents($this->documents);
            }
            $this->customerForm->currentStep += 1;
        } elseif ($this->customerForm->currentStep == 5) {
            if ($this->signature) {
                $this->customerForm->signature($this->pathSignature);
            }
            $this->customerForm->currentStep += 1;
        } elseif (count($this->steps) <= $this->customerForm->currentStep) {
            dd('registrazione completata');
            $this->dispatch('customer');
        } else {
            $this->customerForm->currentStep += 1;
        }
    }

    public function getSignature() {
        $customer = $this->customerForm->newCustomer;
        $this->pathSignature = Storage::putFileAs('customers/customer-'.$customer->id, $this->signature, 'firma.png');
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
