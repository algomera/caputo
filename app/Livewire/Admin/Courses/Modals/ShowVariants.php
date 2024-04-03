<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class ShowVariants extends ModalComponent
{
    public $course;
    public $variants;

    public function mount($courseId) {
        $this->course = Course::find($courseId);
        $this->variants = $this->course->variants()->get();
    }

    public function setVariant($variant) {
        $this->dispatch('setCourseVariant', $this->course->id, $variant);
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.show-variants');
    }
}
