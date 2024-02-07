<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Livewire\MedicalVisits\Calendar;
use App\Models\MedicalPlanning;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class AddVisit extends ModalComponent
{
    public $data;
    public $visits;
    public $selected = [];

    public function mount($data) {
        $this->data = $data;
        $this->visits = MedicalPlanning::where('booked', null)->get();
    }

    public function add($visitId) {
        $this->selected[$visitId] = $visitId;
    }

    public function remove($visitId) {
        unset($this->selected[$visitId]);
    }

    public function save() {
        foreach ($this->selected as $visitId) {
            $visit = MedicalPlanning::find($visitId);

            $visit->update([
                'booked' => Carbon::parse($this->data)
            ]);
        }

        $this->closeModalWithEvents([
            Calendar::class => 'visitUpdate',
        ]);
        return redirect()->route('visits.calendar');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.add-visit');
    }
}
