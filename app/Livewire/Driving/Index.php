<?php

namespace App\Livewire\Driving;

use App\Models\DrivingPlanning;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $drivings = [];

    public function mount() {
        $drivingPlanning = DrivingPlanning::all();

        foreach ($drivingPlanning as $driving) {
            $this->drivings[] = [
                'id' => $driving->id,
                'customer' => $driving->customer->full_name,
                'instructor' => $driving->instructor->full_name,
                'vehicle_type' => $driving->vehicle->type,
                'plate' => $driving->vehicle->plate,
                'start' => $driving->begins
            ];
        }
    }

    public function show($driving) {
        $this->dispatch('openModal', 'driving.modals.show-driving-planning', $driving);
    }

    public function new($data) {
        $this->dispatch('openModal', 'driving.modals.plan-driving', $data);
    }

    #[On('drivingRemove')]
    public function drivingRemove($driving) {
        $this->dispatch('drivingRemove', $driving);
    }

    public function render()
    {
        return view('livewire.driving.index');
    }
}
