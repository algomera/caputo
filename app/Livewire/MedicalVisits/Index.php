<?php

namespace App\Livewire\MedicalVisits;

use App\Models\Registration;
use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $name = '';
    public $lastName = '';
    public $phone = '';
    public $course = '';
    public $code = '';

    public function calendar() {
        return redirect()->route('visits.calendar');
    }

    #[On('visitModified')]
    public function render()
    {
        $user = auth()->user();
        if ($user->role->name == 'admin') {
            $medicalVisits = Registration::whereJsonContains('optionals', 15)->with('customer', 'course', 'medicalPlanning', 'school')
            ->whereHas('customer', function($q) {
                $q->filter('name', $this->name);
            })
            ->whereHas('customer', function($q) {
                $q->filter('lastName', $this->lastName);
            })
            ->whereHas('customer', function($q) {
                $q->filter('phone_1', $this->phone);
            })
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->whereHas('school', function($q) {
                $q->filter('code', $this->code);
            })
            ->get()->sortByDesc('id');
        } elseif ($user->role->name == 'medico') {
            $medicalVisits = Registration::whereJsonContains('optionals', 15)->with('customer', 'course', 'medicalPlanning', 'school')
            ->whereHas('medicalPlanning', function($q) {
                $user = auth()->user();
                $q->filter('user_id', $user->id);
            })
            ->whereHas('customer', function($q) {
                $q->filter('name', $this->name);
            })
            ->whereHas('customer', function($q) {
                $q->filter('lastName', $this->lastName);
            })
            ->whereHas('customer', function($q) {
                $q->filter('phone_1', $this->phone);
            })
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->whereHas('school', function($q) {
                $q->filter('code', $this->code);
            })
            ->get()->sortByDesc('id');
        } else {
            $school = School::find($user->schools()->first()->id);
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
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->get()->sortByDesc('id');
        }

        return view('livewire.medical-visits.index', [
            'medicalVisits' => $medicalVisits
        ]);
    }
}
