<?php

namespace App\Livewire\Services\Training\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;
use App\Models\CourseRegistrationStep;

class RegistrationType extends ModalComponent
{
    public Course $course;
    public $registrationCondition;
    public $selectedRegistrationType = false;
    public $variant = false;

    public function mount($course) {
        $this->course = $course;
        $this->registrationCondition = CourseRegistrationStep::where('course_id', session('course')['id'])->where('registration_type_id', 2)->first();

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
                $this->addSession($id);
                $this->selectedRegistrationType = true;
                break;
        }
    }

    public function showVariant() {
        $this->variant = !$this->variant;
    }

    public function resetOption() {
        $this->selectedRegistrationType = false;
    }

    public function setBranch($branch) {
        $this->addSession(session('course')['registration_type'], $branch);

        $this->dispatch('setCourse');
        $this->closeModal();
    }

    public function addSession($registration_type, $branch = null) {
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
        if ($this->variant) {
            $courseRegistrationTypes = $this->course->courseRegistrationSteps()->where('variant_id', '!=', null)->get();
        } else {
            $courseRegistrationTypes = $this->course->courseRegistrationSteps()->where('variant_id', null)->get();
        }

        return view('livewire.services.training.modals.registration-type', [
            'courseRegistrationTypes' => $courseRegistrationTypes
        ]);
    }
}
