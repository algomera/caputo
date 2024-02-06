<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Customer;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Livewire\Forms\DocumentForm;
use Livewire\Attributes\On;

class Scans extends ModalComponent
{
    use WithFileUploads;

    public DocumentForm $documentForm;
    public $customer;

    public $registration;
    public $courseName;
    public $scans;
    public $newScan = null;

    #[On('updateScan')]
    public function mount($customer = null, $registration = null) {
        if ($customer) {
            $this->customer = Customer::find($customer);
            $this->scans = $this->customer->documents()->whereNotIn('type', ['fototessera', 'firma'])->get();
        } elseif ($registration) {
            $this->registration = Registration::find($registration);
            $this->courseName = $this->registration->course->name;
            $this->customer = $this->registration->customer()->first();
            $this->scans = $this->registration->documents()->get();
            $this->dispatch('selectedRegistration', $registration);
        }
    }

    public function updated($property) {
        if ($property == 'newScan') {
            if ($this->registration) {
                $this->documentForm->newScan($this->customer->id, $this->newScan, $this->registration->id);
                return $this->mount(registration: $this->registration->id);
            } else {
                $this->documentForm->newScan($this->customer->id, $this->newScan);
                return $this->mount(customer: $this->customer->id);
            }
        }
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.scans');
    }
}
