<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Customer;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Livewire\Forms\CustomerForm;
use Livewire\Attributes\On;

class Scans extends ModalComponent
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public $customer;

    public $registration;
    public $scans;
    public $newScan;

    #[On('updateScan')]
    public function mount($customer = null, $registration = null) {
        if ($customer) {
            $this->customer = Customer::find($customer);
            $this->scans = $this->customer->documents()->whereNotIn('type', ['fototessera', 'firma'])->get();
        } elseif ($registration) {
            $this->registration = Registration::find($registration)->course->name;
            $this->scans = Registration::find($registration)->documents()->get();
            $this->dispatch('selectedRegistration', $registration);
        }
    }

    public function updated($property) {
        if ($property == 'newScan') {
            $this->customerForm->newScan($this->customer->id, $this->newScan);
            $this->mount($this->customer->id);
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
