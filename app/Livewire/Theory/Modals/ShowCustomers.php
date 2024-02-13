<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Training;
use LivewireUI\Modal\ModalComponent;

class ShowCustomers extends ModalComponent
{
    public $training;
    public $variant;
    public $customers;

    public function mount($training) {
        $this->training = Training::find($training);

        if ($this->training->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }

        $this->customers = $this->training->customers()->get();
    }

    public function show($customerId) {
        return redirect()->route('registry.show', ['customer' => $customerId]);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.show-customers');
    }
}
