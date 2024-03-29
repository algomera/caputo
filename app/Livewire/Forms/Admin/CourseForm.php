<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Course;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Form;

class CourseForm extends Form
{
    public $course;
    public $name;
    public $slug;
    public $label;
    public $description;
    public $absences = 0;
    public $guides = 0;
    public $type_visit;

    public function rules() {
        return [
            'name' => 'required',
            'slug' => 'nullable',
            'label' => 'nullable',
            'description' => 'nullable',
            'absences' => 'required',
            'guides' => 'required',
            'type_visit' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Campo richiesto',
            'absences.required' => 'Campo richiesto',
            'guides.required' => 'Campo richiesto',
            'type_visit.required' => 'Campo richiesto',
        ];
    }

    public function setCourse($id) {
        $this->course = Course::find($id);
        $this->name = $this->course->name;
        $this->label = $this->course->label;
        $this->description = $this->course->description;
        $this->absences = $this->course->absences;
        $this->guides = $this->course->guides;
        $this->type_visit = $this->course->type_visit;
    }

    public function update() {
        $validateData = $this->validate();
        $validateData['slug'] = Str::slug($validateData['name']);

        $this->course->update($validateData);
        $this->reset();
    }

}
