<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\Admin\CourseForm;
use Livewire\Attributes\On;

class Edit extends ModalComponent
{
    public CourseForm $courseForm;
    public $courseVariants = false;
    public $showVariants = false;
    public $lessons;

    public $tabs = ['Lezioni','Registrazioni','Opzioni/Costi'];
    public $currentTab;

    #[On('newLesson')]
    public function mount($course) {
        $this->courseForm->setCourse($course);

        if (count($this->courseForm->course->variants()->get())) {
            $this->courseVariants = $this->courseForm->course->variants()->get();
        }

        $this->lessons = $this->courseForm->course->lessons;
    }

    public function update() {
        $this->courseForm->update();
        $this->dispatch('service');
        $this->closeModal();
    }

    public function deleteLesson($lesson) {
        Lesson::find($lesson)->delete();
        $this->mount( $this->courseForm->course->id);
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
