<?php

namespace App\Livewire\Service\Course\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class RegistrationType extends ModalComponent
{
    public Course $course;
    public $selectedOption = null;

    public function mount($course) {
        $this->course = $course;
    }

    public function setOption($option) {
        $this->selectedOption = $option;
    }

    public function resetOption() {
        $this->selectedOption = null;
    }

    public function setType($type) {
        $this->dispatch('setCourse',
            course: $this->course->id,
            option: $this->selectedOption,
            type  : $type
        );
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.service.course.modals.registration-type');
    }
}
