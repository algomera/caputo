<?php

namespace App\Livewire\MedicalVisits;

use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $name = '';
    public $lastName = '';
    public $phone = '';
    public $course = '';


    public function updating() {

    }

    #[On('visitModified')]
    public function render()
    {
        $school = School::find(auth()->user()->schools()->first()->id);
        $medicalVisits = $school->medicalVisits()
        ->whereHas('customer', function($q) {
            $q->filter('name', $this->name);
        })
        ->whereHas('customer', function($q) {
            $q->filter('lastName', $this->lastName);
        })
        ->whereHas('customer', function($q) {
            $q->filter('phone_1', $this->phone);
        })
        ->whereHas('customer', function($q) {
            $q->filter('phone_1', $this->phone);
        })
        ->whereHas('course', function($q) {
            $q->filter('name', $this->course);
        })
        ->get();

        return view('livewire.medical-visits.index', [
            'medicalVisits' => $medicalVisits
        ]);
    }
}
