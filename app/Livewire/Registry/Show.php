<?php

namespace App\Livewire\Registry;

use Livewire\Component;
use App\Livewire\Forms\CustomerForm;

class Show extends Component
{
    public CustomerForm $customerForm;

    public function mount($customer) {
        $this->customerForm->setCustomer($customer);
    }

    public function back() {
        return redirect()->route('registry.index');
    }

    public function render()
    {
        return view('livewire.registry.show');
    }
}
