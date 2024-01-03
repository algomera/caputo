<?php

namespace App\Livewire\Admin\Vehicle\Modals;

use App\Models\Vehicle;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public Vehicle $vehicle;

    public function mount($vehicle) {
        $this->vehicle = $vehicle;
    }

    public function delete() {
        $this->vehicle->delete();
        $this->dispatch('vehicle');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.admin.vehicle.modals.delete');
    }
}
