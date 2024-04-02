<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Lesson;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LessonForm extends Form
{
    public $lesson;
    public $course_id;
    public $variant_id;
    public $type;
    public $subject;
    public $description;
    public $duration;

    public function rules() {
        return [
            'course_id' => 'nullable',
            'variant_id' => 'nullable',
            'type' => 'required',
            'subject' => 'required',
            'description' => 'nullable',
            'duration' => 'required',
        ];
    }

    public function messages() {
        return [
            'type.required' => 'Campo richiesto',
            'subject.required' => 'Campo richiesto',
            'duration.required' => 'Campo richiesto',
        ];
    }

    public function setLesson($lesson) {
        $this->lesson = Lesson::find($lesson);
        $this->fill(
            $this->lesson->only(
                'course_id',
                'variant_id',
                'type',
                'subject',
                'description',
                'duration',
            )
        );
    }

    public function store($courseId, $variantId = null) {
        $this->validate();
        $this->course_id = $courseId;
        $this->variant_id = $variantId;

        Lesson::create($this->validate());
    }

    public function update() {
        $this->validate();
        $this->lesson->update($this->validate());
    }
}
