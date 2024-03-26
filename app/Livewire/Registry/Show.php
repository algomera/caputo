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
    public $alertRegistrations = [];
    public $modify = false;
    public $photo = null;
    public $signature;

    #[On('updateDocument')]
    public function mount($customer) {
        $this->customerForm->setCustomer($customer);
        $this->identificationDocumentForm->setPatent($customer);
        $this->identificationDocumentForm->getDocuments($customer);
        $this->registrations = $this->customerForm->customer->registrations()->where('state', 'aperta')->with('medicalPlanning', 'course', 'pinkSheet')->get();


        foreach ($this->registrations as $registration) {
            if (count(json_decode($registration->step_skipped))) {
                $this->alertRegistrations[] = $registration->id;
            }
        }
    }

    public function updated($property) {
        if ($property == 'modify') {
            $this->dispatch('modifyData', $this->modify);
        }
        if ($property == 'signature') {
            $this->dispatch('uploadSignature', signature: $this->signature);
        }
    }

    public function showMissingData() {
        if (count($this->alertRegistrations)) {
            $this->dispatch('openModal', 'registry.modals.alert-missing-data', ['registrations' => $this->alertRegistrations]);
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
                $arrayStepSkippedId = json_decode($registration->step_skipped);
                $key = array_search(4, $arrayStepSkippedId);

                if ($key !== false) {
                    unset($arrayStepSkippedId[$key]);
                }

                $registration->update([
                    'step_skipped' => json_encode(array_values($arrayStepSkippedId))
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
