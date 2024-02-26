<?php

namespace App\Livewire\Theory\Modals;

use App\Livewire\Theory\Trainings\Index as TrainingIndex;
use App\Models\Course;
use App\Models\LessonPlanning;
use App\Models\School;
use App\Models\Training;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class TrainingCreate extends ModalComponent
{
    public $school;
    public $schoolId;
    public $course;
    public $trainingCourseVariant = null;
    public $loopTraining = false;
    public $trainingUser;
    public $trainingBegins;
    public $trainingEnds;
    public $trainingTimeStart;

    public function mount($school, $course) {
        $this->schoolId = $school;
        $this->school = School::find($school);
        $this->course = Course::find($course);
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

    public function createTraining() {
        $this->validate();

        $training = Training::create([
            'school_id' => $this->school->id,
            'course_id' => $this->course->id,
            'variant_id' => $this->trainingCourseVariant,
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

        $this->forceClose()->closeModalWithEvents([
            TrainingIndex::class => 'UpdateTrainingIndex',
        ]);
    }

    public function setLoop() {
        $this->loopTraining = !$this->loopTraining;

        if ($this->loopTraining) {
            $this->trainingEnds = null;
        } else {
            $this->trainingTimeStart = null;
        }
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        $users = User::role('insegnante')->get();

        return view('livewire.theory.modals.training-create', [
            'users' => $users
        ]);
    }
}
