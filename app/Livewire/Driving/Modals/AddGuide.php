<?php

namespace App\Livewire\Driving\Modals;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Registration;
use App\Models\DrivingPlanning;
use Livewire\Attributes\Validate;
use App\Livewire\Driving\Modals\ShowRegistrationGuides;
use App\Livewire\Driving\Modals\PlanDriving;
use App\Livewire\Driving\Index as DrivingIndex;
use LivewireUI\Modal\ModalComponent;

class AddGuide extends ModalComponent
{
    public $registration;

    #[Validate('required', message: 'Seleziona Istruttore')]
    public $instructor;

    #[Validate('required', message: 'Seleziona Veicolo')]
    public $vehicle;

    #[Validate('required', message: 'Seleziona tipologia')]
    public $type;
    public $note;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $user = auth()->user();

        if ($user->role->name == 'istruttore') {
            $this->instructor = $user->id;
        }
    }

    public function create() {
        $this->validate();

        $newDriving = DrivingPlanning::create([
            'registration_id' => $this->registration->id,
            'user_id' => $this->instructor,
            'vehicle_id' => $this->vehicle,
            'type' => $this->type,
            'begins' => session()->get('dateTimeSelected'),
            'note' => $this->note
        ]);

        $scheduleDriving = [
            'id' => $newDriving->id,
            'school' => $newDriving->school()->first()->code,
            'customer' => $newDriving->customer->full_name,
            'instructor' => $newDriving->instructor->full_name,
            'vehicle_type' => $newDriving->vehicle->type,
            'plate' => $newDriving->vehicle->plate,
            'start' => $newDriving->begins
        ];

        $this->registration->chronologies()->create([
            'title' => 'Prenotazione guida in '. date("d/m/Y - H:i", strtotime(session()->get('dateTimeSelected')))
        ]);

        $this->closeModalWithEvents([
            ShowRegistrationGuides::class => ['updateGuide', ['registration' => $this->registration->id]],
            PlanDriving::class => 'updatePlan',
            DrivingIndex::class => ['newDriving', ['driving' => $scheduleDriving]],
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
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
