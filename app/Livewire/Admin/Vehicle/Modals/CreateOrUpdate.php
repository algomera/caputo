<?php

namespace App\Livewire\Admin\Vehicle\Modals;

use App\Livewire\Forms\Admin\VehicleForm;
use LivewireUI\Modal\ModalComponent;

class CreateOrUpdate extends ModalComponent
{
    public VehicleForm $vehicleForm;
    public $action;

    public $vehicleTypes = [
        'Automobile',
        'Ciclomotore 50cc',
        'Ciclomotore 125cc',
        'Ciclomotore Min. 35kW',
        'Ciclomotore Mag. 35kW',
    ];

    public function mount($vehicle, $action) {
        $this->action = $action;

        if ($action == 'edit') {
            $this->vehicleForm->setVehicle($vehicle);
        }
    }

    public function next() {
        if ($this->action == 'edit') {
            $this->vehicleForm->update();
        } else {
            $this->vehicleForm->store();
        }
        $this->dispatch('vehicle');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.admin.vehicle.modals.create-or-update');
    }
}
