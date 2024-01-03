<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Course;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CourseForm extends Form
{
    public $course;
    public $name;
    public $label;
    public $description;
    public $absences;

    public function rules() {
        return [
            'name' => 'required',
            'label' => 'nullable',
            'description' => 'nullable',
            'absences' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Campo richiesto',
            'absences.required' => 'Campo richiesto',
        ];
    }

    public function setCourse($id) {
        $this->course = Course::find($id);
        $this->name = $this->course->name;
        $this->label = $this->course->label;
        $this->description = $this->course->description;
        $this->absences = $this->course->absences;
    }

    public function update() {
        $this->validate();
        $this->course->update($this->validate());
        $this->reset();
    }

}
