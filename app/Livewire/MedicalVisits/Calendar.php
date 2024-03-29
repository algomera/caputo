<?php

namespace App\Livewire\MedicalVisits;

use App\Models\MedicalPlanning;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $user;

    public function mount() {
        $this->user = auth()->user();
    }

    #[On('visitUpdate')]
    public function updateCalendar($visits) {
        $this->dispatch('updateCalendar', $visits);
    }

    #[On('visitRemove')]
    public function visitRemove($visit) {
        $this->dispatch('eventRemove', $visit);
    }

    public function show($visit) {
        $this->dispatch('openModal', 'medical-visits.modals.info-visit', $visit);
    }

    public function new($data) {
        $this->dispatch('openModal', 'medical-visits.modals.add-visit', $data);
    }

    public function update($id, $start) {
        $visit = MedicalPlanning::find($id);

        $visit->update([
            'booked' => Carbon::parse($start)
        ]);
    }

    public function render()
    {
        $visits = [];
        if ($this->user->role->name == 'medico') {
            $medicalPlannings = MedicalPlanning::where('user_id', $this->user->id)->with('school', 'training', 'user', 'customer')->get();
        } elseif ($this->user->role->name == 'admin') {
            $medicalPlannings = MedicalPlanning::where('booked', '!=', null)->with('school', 'training', 'user', 'customer')->get();
        } else {
            $medicalPlannings = MedicalPlanning::where('booked', '!=', null)->with('school', 'training', 'user', 'customer')
            ->whereHas('training', function($q) {
                return $q->where('school_id', $this->user->schools()->first()->id);
            })->get();
        }

        foreach ($medicalPlannings as $planning) {
            $visits[] = [
                'school' => $planning->school->code,
                'doctor' => $planning->user->full_name,
                'id' => $planning->id,
                'title' => $planning->customer->full_name,
                'start' => $planning->booked,
            ];
        }

        return view('livewire.medical-visits.calendar', [
            'visits' => $visits
        ]);
    }
}
