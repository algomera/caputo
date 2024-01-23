<?php

namespace App\Livewire\Registry;

use Livewire\Component;
use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\DocumentForm;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;


class Show extends Component
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public DocumentForm $documentForm;
    public $registrations;
    public $documents;
    public $modify = false;
    public $photo;

    #[On('updateDocument')]
    public function mount($customer) {
        $this->customerForm->setCustomer($customer);
        $this->documentForm->setPatent($customer);
        $this->documentForm->getDocuments($customer);
        $this->registrations = $this->customerForm->customer->registrations()->where('state', 'aperta')->with('medicalPlanning', 'course', 'pinkSheet')->get();
    }

    public function updated($property) {
        if ($property == 'document') {
            $this->setDocument();
        }
        if ($property == 'modify') {
            $this->dispatch('modifyData', $this->modify);
        }
    }

    public function save() {
        $this->customerForm->update();

        if ($this->photo) {
            $this->customerForm->photo($this->photo);
        }
        $this->modify = false;
    }

    public function back() {
        return redirect()->route('registry.index');
    }

    public function render()
    {
        return view('livewire.registry.show');
    }
}
