<?php

namespace App\Livewire\Theory\Trainings;

use App\Models\LessonPlanning;
use App\Models\Training;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $training;
    public $variant;
    public $lessons = [];
    public $trainingStart = '';
    public $trainingEnd = '';

    public function mount($training) {
        $user = auth()->user();
        $this->training = Training::find($training);
        $this->trainingStart = $this->training->begins;
        $this->trainingEnd = $this->training->ends;

        if ($user->role == 'insegnante') {
            $allTrainings = Training::where('user_id', $user->id)->get();
        } else {
            $allTrainings = Training::all();
        }


        if ($this->training->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }


        foreach ($allTrainings as $training) {
            $color = '#e6f1ff';
            $borderColor = '#17489f';

            foreach ($training->plannings as $lessonPlanning) {
                if ($training->id == $this->training->id) {
                    $color = '#e8ffde';
                    $borderColor = '#01a53a';
                }

                $this->lessons[] = [
                    'id' => $lessonPlanning->id,
                    'training' => $lessonPlanning->training_id,
                    'teacher' => $lessonPlanning->training->user->full_name,
                    'lesson' => $lessonPlanning->lesson_id,
                    'title' => $this->training->variant_id ? $lessonPlanning->training->courseVariant->name : $lessonPlanning->training->course->name,
                    'argument' => $lessonPlanning->lesson->subject,
                    'start' => $lessonPlanning->begin ?? null,
                    'end' => Carbon::parse($lessonPlanning->begin)->addMinutes($lessonPlanning->lesson->duration),
                    'color' => $color,
                    'customBorderColor' => $borderColor
                ];
            }
        }
    }

    public function back() {
        return redirect()->route('theory.trainings.index');
    }

    public function show($lesson) {
        $this->dispatch('openModal', 'theory.modals.show-lesson-planning', [
            'training' => $this->training->id,
            'lessonPlanningId' => $lesson,
        ]);
    }

    public function new($data) {
        $this->dispatch('openModal', 'theory.modals.plan-lesson', [
            'dateTime' => $data,
            'training' => $this->training->id
        ]);
    }

    public function update($id, $start) {
        $lessonPlanning = LessonPlanning::find($id);

        $lessonPlanning->update([
            'begin' => Carbon::parse($start)
        ]);
    }

    public function render()
    {
        return view('livewire.theory.trainings.calendar');
    }
}
