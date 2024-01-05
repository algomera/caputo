<?php

namespace App\Livewire\Services\Commons;

use App\Models\Course;
use App\Models\Customer;
use App\Models\IdentificationDocument;
use Livewire\WithFileUploads;
use Livewire\Component;

class StepRegister extends Component
{
    use WithFileUploads;

    public Course $course;
    public $patent = null;
    public $customer = null;
    public $currentStep = 1;
    public $photo;
    public $signature;
    public $phone;
    public $email;
    public $documents = [];
    public $steps = [
        'fototessera',
        'firma',
        'cellulare',
        'email',
        'documenti'
    ];

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
            $this->steps[] = 'anamnestico';
        }
    }

    public function backStep() {
        $this->currentStep -= 1;
    }

    public function nextStep() {
        $this->currentStep += 1;
    }

    public function saveData() {
        dd($this->phone, $this->email);
    }

    public function changeStep($index) {
        $this->currentStep = $index;
    }

    public function render()
    {
        return view('livewire.services.commons.step-register');
    }
}
