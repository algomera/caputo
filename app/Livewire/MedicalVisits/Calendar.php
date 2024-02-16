<?php

namespace App\Livewire\MedicalVisits;

use App\Models\MedicalPlanning;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    #[On('visitUpdate')]
    public function updateCalendar() {
        $this->dispatch('updateCalendar');
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
        $user = auth()->user();
        $visits = [];

        if ($user->role == 'medico') {
            $plannings = MedicalPlanning::where('user_id', $user->id)->get();
        } elseif ($user->role == 'admin') {
            $plannings = MedicalPlanning::where('booked', '!=', null)->get();
        } else {
            $plannings = MedicalPlanning::where('booked', '!=', null)->with('training')
            ->whereHas('training', function($q) {
                $user = auth()->user();
                return $q->where('school_id', $user->schools()->first()->id);
            })->get();
        }

        foreach ($plannings as $planning) {
            $visits[] = [
                'school' => $planning->training->school->code,
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
