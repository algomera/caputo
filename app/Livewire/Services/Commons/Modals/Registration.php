<?php

namespace App\Livewire\Services\Commons\Modals;

use App\Models\BranchCourse;
use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\LessonPlanning;
use App\Models\School;
use App\Models\Training;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Registration extends ModalComponent
{
    public $selectedOption = null;
    public $course;
    public $trainings;
    public $trainingUser;
    public $trainingBegins;
    public $trainingEnds;
    public $trainingTimeStart;
    public $branchCourse;
    public $loopTraining = false;
    public $schools = null;
    public $schoolId = null;

    public function mount() {
        if (auth()->user()->role->name == 'admin') {
            $this->schools = School::all();
        } else {
            $this->schoolId = auth()->user()->schools()->first()->id;
        }

        $this->getCourse();
    }

    public function rules() {
        if ($this->loopTraining) {
            return [
                'trainingUser' => 'required',
                'trainingBegins' => 'required',
                'trainingTimeStart' => 'required',
            ];
        } else {
            return [
                'trainingUser' => 'required',
                'trainingBegins' => 'required',
                'trainingEnds' => 'required'
            ];
        }
    }

    public function messages() {
        if ($this->loopTraining) {
            return [
                'trainingUser.required' => 'Selezione richiesta',
                'trainingBegins.required' => 'Campo richiesto',
                'trainingTimeStart.required' => 'Campo richiesto',
            ];
        } else {
            return [
                'trainingUser.required' => 'Selezione richiesta',
                'trainingBegins.required' => 'Campo richiesto',
                'trainingEnds.required' => 'Campo richiesto'
            ];
        }
    }

    public function getCourse() {
        if (session()->get('course')['course_variant']) {
            $this->course = CourseVariant::find(session()->get('course')['course_variant']);
            $loopTrainings = Training::where('school_id', $this->schoolId)->where('variant_id', $this->course->id)->where('ends', null)->get();
            $trainings = Training::where('school_id', $this->schoolId)->where('variant_id', $this->course->id)->where('ends', '>', now()->format('Y-m-d'))->get();
            $this->trainings = $loopTrainings->merge($trainings);
        } else {
            $this->course = Course::find(session()->get('course')['id']);
            $loopTrainings = Training::where('school_id', $this->schoolId)->where('course_id', $this->course->id)->where('ends', null)->get();
            $trainings = Training::where('school_id', $this->schoolId)->where('course_id', $this->course->id)->where('ends', '>', now()->format('Y-m-d'))->get();
            $this->trainings = $loopTrainings->merge($trainings);
        }

        $this->branchCourse = BranchCourse::find(session('course')['branch']);
    }

    public function setSchool($schoolId) {
        $this->schoolId = $schoolId;
        $this->getCourse();
    }

    public function setLoop() {
        $this->loopTraining = !$this->loopTraining;

        if ($this->loopTraining) {
            $this->trainingEnds = null;
        } else {
            $this->trainingTimeStart = null;
        }
    }

    public function createTraining() {
        $this->validate();

        $training = Training::create([
            'school_id' => auth()->user()->schools()->first()->id,
            'course_id' => session()->get('course')['id'],
            'variant_id' => session()->get('course')['course_variant'],
            'user_id' => $this->trainingUser,
            'begins' => $this->trainingBegins,
            'ends' => $this->trainingEnds,
            'time_start' => $this->trainingTimeStart
        ]);

        if ($training->variant_id != null) {
            $lessons = $training->courseVariant->lessons()->get();
        } else {
            $lessons = $training->course->lessons()->get();
        }

        if (!$this->loopTraining) {
            foreach ($lessons as $lesson) {
                LessonPlanning::create([
                    'training_id' => $training->id,
                    'lesson_id' => $lesson->id,
                ]);
            }
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

    public function resetSchool() {
        $this->schoolId = null;
    }

    public function putRegistration($trainingId, $type) {
        $this->dispatch('newRegistration',$this->schoolId, $trainingId, $type);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-lg 2xl:max-w-screen-2xl';
    }


    public function render()
    {
        $users = User::role('insegnante')->get();

        return view('livewire.services.commons.modals.registration', [
            'users' => $users
        ]);
    }
}
