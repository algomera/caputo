<?php

namespace App\Livewire\Driving\Modals;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class PlanDriving extends ModalComponent
{
    public $type;
    public $note;
    public $welded;

    //search
    public $name = '';
    public $lastName = '';
    public $course = '';

    public function mount($data) {
        session()->put('dateTimeSelected', $data);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        $registrations = Registration::where('state', 'aperta')->with('customer', 'course', 'drivingPlanning')
        ->whereHas('customer', function($q) {
            $q->filter('name', $this->name);
        })
        ->whereHas('customer', function($q) {
            $q->filter('lastName', $this->lastName);
        })
        ->whereHas('course', function($q) {
            $q->filter('name', $this->course);
        })->get();

        return view('livewire.driving.modals.plan-driving', [
            'registrations' => $registrations,
        ]);
    }
}
