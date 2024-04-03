<?php

namespace App\Livewire\Admin\Courses\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\Admin\LessonForm;


class Lesson extends ModalComponent
{
    public LessonForm $lessonForm;

    public function mount($lesson) {
        $this->lessonForm->setLesson($lesson);
    }

    public function update() {
        $this->lessonForm->update();
        $this->closeModal();
        $this->dispatch('newLesson', $this->lessonForm->course_id, $this->lessonForm->variant_id);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public static function closeModalOnClickAway(): bool
    {
    return false;
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.lesson');
    }
}
