<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\Admin\LessonForm;

class LessonCreate extends ModalComponent
{
    public LessonForm $lessonForm;
    public $course;

    public function mount($course) {
        $this->course = Course::find($course);
        $this->lessonForm->type = 'teoria';
    }

    public function store() {
        $this->lessonForm->store($this->course->id);
        $this->closeModal();
        $this->dispatch('newLesson', $this->course->id);
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
