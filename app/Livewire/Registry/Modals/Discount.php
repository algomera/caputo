<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use App\Livewire\Registry\Modals\Payments;
use LivewireUI\Modal\ModalComponent;

class Discount extends ModalComponent
{
    public $registration;
    public $discount = 0;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function save() {
        $this->registration->update([
            'discount' => $this->discount
        ]);

        $this->closeModalWithEvents([
            Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
        ]);
    }

    public function render()
    {
        return view('livewire.registry.modals.discount');
    }
}
