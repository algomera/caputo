<?php

namespace App\Livewire\Services\Training\Modals;

use App\Models\Course;
use App\Models\RegistrationType as ModelsRegistrationType;
use LivewireUI\Modal\ModalComponent;

class RegistrationType extends ModalComponent
{
    public Course $course;
    public $courseRegistrationTypes;
    public $selectedRegistrationType = null;

    public function mount($course) {
        $this->course = $course;
        $this->courseRegistrationTypes = $this->course->courseRegistrationSteps()->get();

        session()->put('course', [
            'id' => $this->course->id,
        ]);
    }

    public function setRegistrationType($id) {
        switch ($id) {
            case 1:
                $this->addSession($id, 'teoria');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 2:
                $this->addSession($id, 'guide');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 3:
                $this->addSession($id, 'guide');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 4:
                $this->addSession($id, 'guide');
                $this->selectedRegistrationType = 'guide';
                break;
        }
    }

    public function resetOption() {
        $this->selectedRegistrationType = null;
    }

    public function setBranch($branch) {
        $this->addSession(session('course')['registration_type'], $branch);

        $this->dispatch('setCourse');
        $this->closeModal();
    }

    public function addSession($registration_type, $branch) {
        $session = session()->get('course', []);
        $session['registration_type'] = $registration_type;
        $session['branch'] = $branch;

        session()->put('course', $session);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.registration-type');
    }
}
