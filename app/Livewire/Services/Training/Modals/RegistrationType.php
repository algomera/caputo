<?php

namespace App\Livewire\Services\Training\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class RegistrationType extends ModalComponent
{
    public Course $course;
    public $selectedRegistrationType = false;
    public $existingVariant;
    public $variant = false;

    public function mount($course) {
        $this->course = $course;
        $this->existingVariant = count($this->course->courseRegistrationSteps()->where('variant_id', '!=', null)->get());

        session()->put('course', ['id' => $this->course->id]);
    }

    public function setRegistrationType($type_id, $variant_id = null) {
        $branches = $this->course->courseRegistrationSteps()->where('registration_type_id', $type_id)->first()->branchCourses()->get();

        if (count($branches) > 1) {
            $this->addSession($type_id, $variant_id);
            $this->selectedRegistrationType = $this->course->courseRegistrationSteps()->where('registration_type_id', $type_id)->first();

        } else {
            $this->addSession($type_id, $variant_id, $branches->first()->id);
            $this->dispatch('setCourse');
            return $this->closeModal();
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

    public function addSession($registration_type_id, $courseVariant_id = null, $branch_id = null) {
        $session = session()->get('course', []);
        $session['course_variant'] = $courseVariant_id;
        $session['registration_type'] = $registration_type_id;
        $session['branch'] = $branch_id;

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
