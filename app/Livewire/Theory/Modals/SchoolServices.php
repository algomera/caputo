<?php

namespace App\Livewire\Theory\Modals;

use App\Models\School;
use App\Models\Service;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class SchoolServices extends ModalComponent
{
    public $selectedSchool = null;
    public $school;
    public $services;

    public function mount() {
        if (auth()->user()->role->name != 'admin') {
            $this->school = auth()->user()->schools()->first();
        }
    }

    public function updated($property) {
        if ($property == 'selectedSchool') {
            if ($this->selectedSchool) {
                $this->school = School::find($this->selectedSchool);
                $this->services = $this->school->services()->get();
            }
        }
    }


    public function getService($school) {
        $this->services = $this->school->services()->get();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        $schools = School::all();

        return view('livewire.theory.modals.school-services', [
            'schools' => $schools,
        ]);
    }
}
