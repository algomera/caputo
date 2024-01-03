<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Vehicle;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VehicleForm extends Form
{
    public $vehicle;
    public $type;
    public $model;
    public $transmission;
    public $plate;

    public function rules() {
        return [
            'type' => 'required',
            'model' => 'nullable',
            'transmission' => 'required',
            'plate' => 'required'
        ];
    }

    public function messages() {
        return [
            'type.required' => 'Campo richiesto',
            'transmission.required' => 'Campo richiesto',
            'plate.required' => 'Campo richiesto',
        ];
    }

    public function setVehicle($id) {
        $this->vehicle = Vehicle::find($id);
        $this->type = $this->vehicle->type;
        $this->model = $this->vehicle->model;
        $this->transmission = $this->vehicle->transmission;
        $this->plate = $this->vehicle->plate;
    }

    public function store() {
        $this->validate();
        Vehicle::create($this->validate());
    }

    public function update() {
        $this->validate();
        $this->vehicle->update($this->validate());
        $this->reset();
    }
}
