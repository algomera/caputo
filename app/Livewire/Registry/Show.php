<?php

namespace App\Livewire\Registry;

use Livewire\Component;
use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\IdentificationDocumentForm;
use App\Models\Registration;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public IdentificationDocumentForm $identificationDocumentForm;
    public $registrations;
    public $registration;
    public $modify = false;
    public $photo = null;
    public $signature;

    #[On('updateDocument')]
    public function mount($customer) {
        $this->customerForm->setCustomer($customer);
        $this->identificationDocumentForm->setPatent($customer);
        $this->identificationDocumentForm->getDocuments($customer);
        $this->registrations = $this->customerForm->customer->registrations()->where('state', 'aperta')->with('medicalPlanning', 'course', 'pinkSheet')->get();
    }

    public function updated($property) {
        if ($property == 'modify') {
            $this->dispatch('modifyData', $this->modify);
        }
        if ($property == 'signature') {
            $this->dispatch('uploadSignature', signature: $this->signature);
        }
    }

    #[On('selectedRegistration')]
    public function setRegistration($id) {
        $this->registration = Registration::find($id);
    }

    public function save() {
        $this->customerForm->update();

        if ($this->photo) {
            $this->customerForm->photo($this->photo);

            foreach ($this->registrations as $registration) {
                $stepSkipped = json_decode($registration->step_skipped);
                $step = array_search('fototessera', $stepSkipped);
                unset($stepSkipped[$step]);

                $registration->update([
                    'step_skipped' => json_encode(array_values($stepSkipped))
                ]);
            }
        }

        $this->mount($this->customerForm->customer->id);
        $this->modify = false;
    }

    public function back() {
        return redirect()->route('registry.index');
    }

    public function disabledModify() {
        $this->modify = false;
        $this->photo = null;
        $this->mount($this->customerForm->customer->id);
    }

    public function showCourse($training) {
        return redirect()->route('theory.lessons.index', ['training' => $training]);
    }

    public function render()
    {
        return view('livewire.registry.show');
    }
}
