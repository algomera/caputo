<?php

namespace App\Livewire\Services\Commons\Modals;

use App\Models\Course;
use App\Models\LessonPlanning;
use App\Models\Training;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Registration extends ModalComponent
{
    public $selectedOption = null;
    public $course;
    public $trainings;
    public $trainingCourseVariant = null;
    public $trainingBegins;
    public $trainingEnds;
    public $trainingUser;

    public function mount() {
        $this->course = Course::find(session()->get('course')['id']);
        $loopTrainings = Training::where('school_id', auth()->user()->schools()->first()->id)->where('course_id', $this->course->id)->where('ends', null)->get();
        $trainings = Training::where('school_id', auth()->user()->schools()->first()->id)->where('course_id', $this->course->id)->where('ends', '>', now()->format('Y-m-d'))->get();
        $this->trainings = $loopTrainings->merge($trainings);
    }

    public function rules() {
        return [
            'trainingBegins' => 'required',
            'trainingUser' => 'required'
        ];
    }

    public function messages() {
        return [
            'trainingBegins.required' => 'Campo richiesto',
            'trainingUser.required' => 'Selezione richiesta'
        ];
    }

    public function createTraining() {
        $this->validate();
        $training = Training::create([
            'school_id' => auth()->user()->schools()->first()->id,
            'course_id' => session()->get('course')['id'],
            'variant_id' => $this->trainingCourseVariant,
            'user_id' => $this->trainingUser,
            'begins' => $this->trainingBegins,
            'ends' => $this->trainingEnds
        ]);

        if ($training->variant_id != null) {
            $lessons = $training->courseVariant->lessons()->get();
        } else {
            $lessons = $training->course->lessons()->get();
        }

        foreach ($lessons as $lesson) {
            LessonPlanning::create([
                'training_id' => $training->id,
                'lesson_id' => $lesson->id,
            ]);
        }

        $this->mount();
        $this->selectedOption = 'esistente';
    }

    public function setOption($option) {
        $this->selectedOption = $option;
    }

    public function resetOption() {
        $this->selectedOption = null;
    }

    public function putRegistration($trainingId, $type, $variant = null) {
        $this->dispatch('newRegistration', $trainingId, $type, $variant);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-lg 2xl:max-w-screen-xl';
    }


    public function render()
    {
        $users = User::role('insegnante')->get();

        return view('livewire.services.commons.modals.registration', [
            'users' => $users
        ]);
    }
}
