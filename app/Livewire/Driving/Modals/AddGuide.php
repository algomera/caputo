<?php

namespace App\Livewire\Driving\Modals;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Registration;
use App\Models\DrivingPlanning;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Driving\Modals\PlanDriving;
use App\Livewire\Driving\Index as DrivingIndex;
use App\Livewire\Driving\Modals\ShowRegistrationGuides;

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
            'end' => Carbon::parse(session()->get('dateTimeSelected'))->addMinutes($this->registration->course->getOptions()->where('type', 'guide')->first()->duration),
            'note' => $this->note
        ]);


        $scheduleDriving = [
            'id' => $newDriving->id,
            'school' => $newDriving->school()->first()->code,
            'customer' => $newDriving->customer->full_name,
            'instructor' => $newDriving->instructor->full_name,
            'vehicle_type' => $newDriving->vehicle->type,
            'plate' => $newDriving->vehicle->plate,
            'start' => $newDriving->begins,
            'end' => Carbon::parse($newDriving->begins)->addMinutes($this->registration->course->getOptions()->where('type', 'guide')->first()->duration),
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
        $vehicles = Vehicle::where('patent_id', $this->registration->course->patent_id)->where('transmission', $this->registration->transmission)->get();

        return view('livewire.driving.modals.add-guide', [
            'instructors' => $instructors,
            'vehicles' => $vehicles
        ]);
    }
}
