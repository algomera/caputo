<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class ShowVariants extends ModalComponent
{
    public $courses;

    public function mount($courseId) {
        $course = Course::find($courseId);

        $this->courses = $course->variants()->get();
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
