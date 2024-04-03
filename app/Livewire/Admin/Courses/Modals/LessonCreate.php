<?php

namespace App\Livewire\Admin\Courses\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\Admin\LessonForm;

class LessonCreate extends ModalComponent
{
    public LessonForm $lessonForm;
    public $course;
    public $courseId;
    public $variantId = null;

    public function mount($course, $variant = null) {
        $this->course = get_course($course, $variant);
        $this->courseId = $course;
        $this->variantId = $variant;
        $this->lessonForm->type = 'teoria';
    }

    public function store() {
        $this->lessonForm->store($this->courseId, $this->variantId);
        $this->dispatch('newLesson', $this->courseId, $this->variantId);
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.lesson-create');
    }
}
