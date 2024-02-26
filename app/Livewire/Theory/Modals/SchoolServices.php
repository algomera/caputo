<?php

namespace App\Livewire\Theory\Modals;

use App\Models\School;
use LivewireUI\Modal\ModalComponent;

class SchoolServices extends ModalComponent
{
    public $selectedSchool = null;
    public $schoolId;
    public $school;
    public $services;

    public function mount() {
        if (auth()->user()->role->name != 'admin') {
            $this->school = auth()->user()->schools()->first();
            $this->selectedSchool = $this->school->id;
            $this->services = $this->school->services()->get();
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
