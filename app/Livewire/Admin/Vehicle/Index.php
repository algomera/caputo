<?php

namespace App\Livewire\Admin\Vehicle;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    #[On('vehicle')]
    public function render()
    {
        $vehicles = Vehicle::all()->sortByDesc('id');

        return view('livewire.admin.vehicle.index', [
            'vehicles' => $vehicles
        ]);
    }
}
