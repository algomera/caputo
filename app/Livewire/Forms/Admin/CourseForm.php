<?php

namespace App\Livewire\Forms\Admin;

use App\Models\BranchCourse;
use Livewire\Form;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\CourseVariant;
use Livewire\Attributes\Validate;
use App\Models\CourseRegistrationStep;

class CourseForm extends Form
{
    public $course;
    public $name;
    public $slug;
    public $label;
    public $description;
    public $type_visit;
    public $typeCourseRegistrationStep;

    public function rules() {
        return [
            'name' => 'required',
            'slug' => 'nullable',
            'label' => 'nullable',
            'description' => 'nullable',
            'type_visit' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Campo richiesto',
            'type_visit.required' => 'Campo richiesto',
        ];
    }

    public function setCourse($courseId, $variantId = null) {
        if ($variantId) {
            $this->course = CourseVariant::find($variantId);
        } else {
            $this->course = Course::find($courseId);
        }
        $this->name = $this->course->name;
        $this->label = $this->course->label;
        $this->description = $this->course->description;
        $this->type_visit = $this->course->type_visit;
    }

    public function setCourseRegistrationType($courseRegistrationStep_id) {
        $this->typeCourseRegistrationStep = CourseRegistrationStep::find($courseRegistrationStep_id);
    }

    public function updateCourseRegistrationType($selectedSteps, $condition = null) {
        $this->typeCourseRegistrationStep->update([
            'steps_id' => json_encode(array_values($selectedSteps)),
            'condition' => $condition
        ]);
    }

    public function updateBranchCourse($branches) {
        foreach ($branches as $key => $branch) {
            BranchCourse::updateOrCreate(
                ['course_registration_step_id' => $this->typeCourseRegistrationStep->id, 'branch_id' => $key],
                [
                    'condition' => $branch['condition'],
                    'absences' => $branch['absences'],
                    'guides' => $branch['guides'],
                    'price' => $branch['price'],
                ]
            );
        }
    }

    public function updateOptionCourse($options) {
        $course = get_course($this->typeCourseRegistrationStep->course_id, $this->typeCourseRegistrationStep->variant_id);
        dd($course);
    }

    public function update() {
        $validateData = $this->validate();
        $validateData['slug'] = Str::slug($validateData['name']);

        $this->course->update($validateData);
    }

}
