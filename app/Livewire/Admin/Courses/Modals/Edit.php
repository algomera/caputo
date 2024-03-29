<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Livewire\Forms\Admin\CourseForm;
use App\Models\Course;
use App\Models\Service;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public CourseForm $courseForm;
    public Service $service;

    public function mount($service, $course) {
        $this->service = $service;
        $this->courseForm->setCourse($course);
    }

    public function update() {
        $this->courseForm->update();
        $this->dispatch('service');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.edit');
    }
}
