<?php

namespace App\Livewire\Driving\Modals;

use App\Models\School;
use App\Models\Registration;
use Livewire\Attributes\On;
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
    public $schoolCode = '';

    public function showCustomer($customerId) {
        return redirect()->route('registry.show', ['customer' => $customerId]);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    #[On('updatePlan')]
    public function render()
    {
        $user = auth()->user();
        $schools = School::all();

        if ($user->role->name == 'admin' || $user->role->name == 'istruttore') {
            $registrations = Registration::where('state', 'aperta')->with('customer', 'course', 'drivingPlanning', 'school')
            ->whereHas('customer', function($q) {
                $q->filter('name', $this->name);
            })
            ->whereHas('customer', function($q) {
                $q->filter('lastName', $this->lastName);
            })
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->whereHas('school', function($q) {
                $q->filter('code', $this->schoolCode);
            })->get();

        } else {
            $school = $user->schools()->first();

            $registrations = $school->registrations()->where('state', 'aperta')->with('customer', 'course', 'drivingPlanning')
            ->whereHas('customer', function($q) {
                $q->filter('name', $this->name);
            })
            ->whereHas('customer', function($q) {
                $q->filter('lastName', $this->lastName);
            })
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })->get();
        }

        return view('livewire.driving.modals.plan-driving', [
            'registrations' => $registrations,
            'schools' => $schools
        ]);
    }
}
