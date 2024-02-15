<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Training;
use LivewireUI\Modal\ModalComponent;

class ShowCustomers extends ModalComponent
{
    public $training;
    public $variant;
    public $currentCustomers;
    public $oldCustomers;
    public $allCustomers;
    public $customers;
    public $name = '';
    public $lastName = '';
    public $customersShow;

    public function mount($training) {
        $this->training = Training::find($training);

        if ($this->training->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }

        $this->allCustomers = $this->training->customers()->get();
        $this->currentCustomers = $this->training->customers()->where('state', 'aperta')->get();
        $this->oldCustomers = $this->training->customers()->where('state', 'chiusa')->get();
        $this->customers = $this->currentCustomers;
        $this->customersShow = 'currentCustomers';
    }

    public function changeCustomers($customers) {
        $this->customers = $this->$customers;
        $this->customersShow = $customers;
    }

    public function show($customerId) {
        return redirect()->route('registry.show', ['customer' => $customerId]);
    }

    public function presences($customerId) {
        $this->dispatch('openModal', 'theory.modals.show-customer-presences',
        [
            'training' => $this->training->id,
            'customer' => $customerId,
        ]);

    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        $customerFilter = $this->customers->filter(function ($customer) { return
            (stripos($customer->name, $this->name) !== false) &&
            (stripos($customer->lastName, $this->lastName) !== false) ;
        });

        return view('livewire.theory.modals.show-customers', [
            'customerFilter' => $customerFilter
        ]);
    }
}
