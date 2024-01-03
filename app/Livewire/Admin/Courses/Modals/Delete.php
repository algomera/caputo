<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public Course $course;

    public function mount($course) {
        $this->course = $course;
    }

    public function delete() {
        $this->course->delete();
        $this->dispatch('service');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.delete');
    }
}
