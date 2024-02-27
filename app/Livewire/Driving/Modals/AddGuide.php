<?php

namespace App\Livewire\Driving\Modals;

use App\Models\Registration;
use App\Models\User;
use App\Models\Vehicle;
use LivewireUI\Modal\ModalComponent;

class AddGuide extends ModalComponent
{
    public $registration;

    public $instructor;
    public $vehicle;
    public $type;
    public $note;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public function create() {

    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        $instructors = User::role('istruttore')->get();
        $vehicles = Vehicle::all();

        return view('livewire.driving.modals.add-guide', [
            'instructors' => $instructors,
            'vehicles' => $vehicles
        ]);
    }
}
