<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Customer;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class Scans extends ModalComponent
{
    public $scans;
    public $registration;

    public function mount($customer = null, $registration = null) {
        if ($customer) {
            $this->scans = Customer::find($customer)->documents()->whereNotIn('type', ['fototessera', 'firma'])->get();
        } elseif ($registration) {
            $this->scans = Registration::find($registration)->documents()->get();
            $this->registration = Registration::find($registration)->course->name;
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
