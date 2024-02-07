<?php

namespace App\Livewire\MedicalVisits;

use App\Models\MedicalPlanning;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $visits = [];

    public function mount() {
        $this->visits = [];
        $user = auth()->user();

        if ($user->role == 'medico') {
            $plannings = MedicalPlanning::where('user_id', $user->id)->get();
        } else {
            $plannings = MedicalPlanning::where('booked', '!=', null)->get();
        }

        foreach ($plannings as $planning) {
            $this->visits[] = [
                'id' => $planning->id,
                'title' => $planning->registration->full_name_customer,
                'start' => $planning->booked,
            ];
        }
    }

    #[On('visitUpdate')]
    public function updateCalendar() {
        $this->mount();
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
        return view('livewire.medical-visits.calendar');
    }
}
