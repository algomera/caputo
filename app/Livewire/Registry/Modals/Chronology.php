<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Customer;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class Chronology extends ModalComponent
{
    public $chronologies;
    public $registration;

    public function mount($customer = null, $registration = null) {
        if ($customer) {
            $this->chronologies = Customer::find($customer)->chronologies()->get();
        } elseif ($registration) {
            $this->chronologies = Registration::find($registration)->chronologies()->get();
            $this->registration = Registration::find($registration)->course->name;
        }
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.chronology');
    }
}
