<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Livewire\MedicalVisits\Calendar;
use App\Models\MedicalPlanning;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AddVisit extends ModalComponent
{
    public $data;
    public $name = '';
    public $lastName = '';

    #[Validate('required', message: 'Selezionare medico')]
    public $doctor = null;

    #[Validate('required', message: 'Selezionare almeno un cliente')]
    public $selected = [];

    public function mount($data) {
        $this->data = $data;
    }

    public function add($visitId) {
        $this->selected[$visitId] = $visitId;
    }

    public function remove($visitId) {
        unset($this->selected[$visitId]);
    }

    public function save() {
        $this->validate();

        foreach ($this->selected as $visitId) {
            $visit = MedicalPlanning::find($visitId);

            $visit->update([
                'user_id' => $this->doctor,
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
        return '6xl';
    }

    public function render()
    {
        $doctors = User::role('medico')->get();

        $visits = MedicalPlanning::where('booked', null)->with('customer')
        ->whereHas('customer', function($q) {
            $q->filter('name', $this->name);
        })
        ->whereHas('customer', function($q) {
            $q->filter('lastName', $this->lastName);
        })->get();

        return view('livewire.medical-visits.modals.add-visit', [
            'visits' => $visits,
            'doctors' => $doctors
        ]);
    }
}
