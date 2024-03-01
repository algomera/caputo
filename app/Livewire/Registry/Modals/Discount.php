<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use App\Livewire\Registry\Modals\Payments;
use LivewireUI\Modal\ModalComponent;

class Discount extends ModalComponent
{
    public $registration;

    public $discount;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public function rules() {
        return [
            'discount' => 'required|numeric|max:'.$this->registration->remainToPay
        ];
    }

    public function messages() {
        return [
            'discount.required' => 'Inserire Cifra da scontare',
            'discount.max' => 'La cifra supera il rimanente importo da pagare',
        ];
    }

    public function updated($property) {
        if ($property == 'discount') {
            $this->discount = str_replace(" ", '', $this->discount);
        }
    }

    public function save() {
        $this->validate();

        if ($this->discount == 0) {
            $this->registration->update([
                'discount' => null
            ]);
        } else {
            $this->registration->update([
                'discount' => $this->discount
            ]);
        }

        $this->closeModalWithEvents([
            Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.registry.modals.discount');
    }
}
