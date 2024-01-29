<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class Payments extends ModalComponent
{
    public $registration;
    public $registrationPayments;
    public $drivings;
    public $type = null;
    public $drivingPrice;
    public $selectedDriving = null;

    #[On('updatePayment')]
    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $this->registrationPayments = $this->registration->payments()->get();
        $this->drivings = $this->registration->drivingPlanning()->get();
        $this->drivingPrice = $this->registration->course->getOptions()->where('type', 'guide')->first()->price;

        if (!count($this->drivings)) {
            $this->type = 'iscrizione';
        }
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.payments');
    }
}
