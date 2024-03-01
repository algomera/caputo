<?php

namespace App\Livewire\Driving\Modals;

use App\Livewire\Driving\Index as DrivingIndex;
use App\Models\DrivingPlanning;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class ShowDrivingPlanning extends ModalComponent
{
    public $driving;
    public $registration;
    public $deletable = false;

    public function mount($driving) {
        $this->driving = DrivingPlanning::find($driving);
        $this->registration = Registration::find($this->driving->registration_id);

        if (count($this->driving->payments()->get()) == 0) {
            $this->deletable = true;
        }
    }

    public function delete() {
        $this->driving->delete();

        $this->registration->chronologies()->create([
            'title' => 'Cancellazione guida del '. date("d/m/Y - H:i", strtotime($this->driving->begins))
        ]);

        $this->closeModalWithEvents([DrivingIndex::class => ['drivingRemove',
            ['driving' => $this->driving->id]
        ]]);
    }

    public function showCustomer() {
        return redirect()->route('registry.show', ['customer' => $this->driving->customer->id]);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-lg !align-top';
    }

    public function render()
    {
        return view('livewire.driving.modals.show-driving-planning');
    }
}
