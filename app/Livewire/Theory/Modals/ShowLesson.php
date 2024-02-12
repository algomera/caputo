<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;

class ShowLesson extends ModalComponent
{
    public $lesson;
    public $variant;

    public function mount($lessonId) {
        $this->lesson = Lesson::find($lessonId);

        if ($this->lesson->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }
    }

    public function render()
    {
        return view('livewire.theory.modals.show-lesson');
    }
}
