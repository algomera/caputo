<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class Payments extends ModalComponent
{
    use WithFileUploads;

    public $registration;
    public $registrationPayments;
    public $drivings;
    public $type = null;
    public $drivingPrice;
    public $selectedDriving = null;
    public $newScan;

    #[On('updatePayment')]
    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $this->registrationPayments = $this->registration->payments()->get();
        $this->drivings = $this->registration->drivingPlanning()->get();
        $this->drivingPrice = $this->registration->course->getOptions()->where('type', 'guide')->first()->price;
    }

    public function updated($property) {
        if ($property == 'newScan') {
            dd($property);
            $this->customerForm->updateScan($this->scan->id, $this->newScan);
            $this->mount($this->scan->id);
        }
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.payments');
    }
}
