<?php

namespace App\Livewire\Driving;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\DrivingPlanning;
use App\Models\Registration;
use App\Models\School;

class Index extends Component
{
    public $schoolCode = '';

    public function show($driving) {
        $this->dispatch('openModal', 'driving.modals.show-driving-planning', $driving);
    }

    public function openRegistration($data) {
        session()->put('dateTimeSelected', $data['data']);

        $this->dispatch('openModal', 'driving.modals.plan-driving');
    }

    #[On('newDriving')]
    public function newDriving($driving) {
        $this->dispatch('addDriving', $driving);
    }

    public function drivingUpdate($id, $start) {
        $drivingPlanning = DrivingPlanning::find($id);
        $registration = Registration::find($drivingPlanning->registration_id);

        $oldDate = date("d/m/Y-H:i", strtotime($drivingPlanning->begins));
        $newDate =  date("d/m/Y-H:i", strtotime($start));

        $registration->chronologies()->create([
            'title' => 'Prenotazione guida spostata dal '. $oldDate . ' Al ' . $newDate
        ]);

        $drivingPlanning->update([
            'begins' => Carbon::parse($start)->addHour()
        ]);
    }

    #[On('drivingRemove')]
    public function drivingRemove($driving) {
        $this->dispatch('drivingRemove', $driving);
    }

    public function render()
    {
        $drivings = [];
        $user = auth()->user();
        $schools = School::all();

        if ($user->role->name == 'admin') {
            if ($this->schoolCode != '') {
                $selectedSchool = School::find($this->schoolCode);
                $drivingPlanning = $selectedSchool->drivingPlannings()->get();
            } else {
                $drivingPlanning = DrivingPlanning::all();
            }
        } elseif ($user->role->name == 'istruttore') {
            $drivingPlanning = $user->drivingPlannings()->get();
        } else {
            $school = $user->schools()->first();
            $drivingPlanning = $school->drivingPlannings()->get();
        }

        foreach ($drivingPlanning as $driving) {
            $drivings[] = [
                'id' => $driving->id,
                'school' => $driving->school()->first()->code,
                'customer' => $driving->customer->full_name,
                'instructor' => $driving->instructor->full_name,
                'vehicle_type' => $driving->vehicle->type,
                'plate' => $driving->vehicle->plate,
                'start' => $driving->begins
            ];
        }

        $this->dispatch('changeSchool', $drivings);

        return view('livewire.driving.index', [
            'drivings' => $drivings,
            'schools' => $schools
        ]);
    }
}
