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
    public $existingVariant;
    public $variant = false;

    public function mount($course) {
        $this->course = $course;
        $this->registrationCondition = CourseRegistrationStep::where('course_id', $this->course->id)->where('registration_type_id', 2)->first();
        $this->existingVariant = count($this->course->courseRegistrationSteps()->where('variant_id', '!=', null)->get());

        session()->put('course', [
            'id' => $this->course->id,
        ]);
    }

    public function setRegistrationType($type_id, $variant_id = null) {
        switch ($type_id) {
            case 1:
                $this->addSession($type_id, $variant_id, 'teoria');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 2:
                $this->addSession($type_id, $variant_id, 'guide');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 3:
                $this->addSession($type_id, $variant_id, 'guide');
                $this->dispatch('setCourse');
                return $this->closeModal();
                break;
            case 4:
                $this->addSession($type_id, $variant_id);
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
        $this->addSession(session('course')['registration_type'], session('course')['course_variant'], $branch);

        $this->dispatch('setCourse');
        $this->closeModal();
    }

    public function addSession($registration_type_id, $courseVariant_id = null, $branch = null) {
        $session = session()->get('course', []);
        $session['course_variant'] = $courseVariant_id;
        $session['registration_type'] = $registration_type_id;
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
