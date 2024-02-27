<?php

namespace App\Livewire\Driving\Modals;

use App\Livewire\Driving\Index as DrivingIndex;
use App\Models\DrivingPlanning;
use LivewireUI\Modal\ModalComponent;

class ShowDrivingPlanning extends ModalComponent
{
    public $driving;

    public function mount($driving) {
        $this->driving = DrivingPlanning::find($driving);
    }

    public function delete() {
        $this->driving->delete();

        $this->closeModalWithEvents([DrivingIndex::class => ['drivingRemove',
            ['driving' => $this->driving->id]
        ]]);
    }


    public function showCustomer() {
        return redirect()->route('registry.show', ['customer' => $this->driving->customer->id]);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-md !align-top';
    }

    public function render()
    {
        return view('livewire.driving.modals.show-driving-planning');
    }
}
