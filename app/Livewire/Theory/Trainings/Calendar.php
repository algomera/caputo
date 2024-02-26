<?php

namespace App\Livewire\Theory\Trainings;

use App\Models\LessonPlanning;
use App\Models\Training;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $training;
    public $trainingId;
    public $variant;
    public $lessons = [];
    public $trainingStart = '';
    public $trainingEnd = '';
    public $user;

    public function mount($training) {
        $this->trainingId = $training;
        $this->user = auth()->user();
        $this->training = Training::find($training);
        $this->trainingStart = $this->training->begins;
        $this->trainingEnd = $this->training->ends;

        $allTrainings = $this->getTrainingsBetweenDates($this->trainingStart, $this->trainingEnd);

        if ($this->training->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }

        foreach ($allTrainings as $training) {
            $plannings = $training->plannings()->with('lesson', 'user', 'course')->get();
            $color = '#e6f1ff';
            $borderColor = '#17489f';

            foreach ($plannings as $lessonPlanning) {
                if ($lessonPlanning->begin) {
                    $lesson = $lessonPlanning->lesson;

                    if ($training->id == $this->training->id) {
                        $color = '#e8ffde';
                        $borderColor = '#01a53a';
                    }

                    $this->lessons[] = [
                        'id' => $lessonPlanning->id,
                        'training' => $training->id,
                        'teacher' => $lessonPlanning->user->full_name,
                        'lesson' => $lessonPlanning->lesson_id,
                        'title' => $training->variant_id ? $training->courseVariant->name : $training->course->name,
                        'argument' => $lesson->subject,
                        'start' => $lessonPlanning->begin,
                        'lessonDuration' => $lesson->duration,
                        'end' => Carbon::parse($lessonPlanning->begin)->addMinutes($lesson->duration),
                        'color' => $color,
                        'customBorderColor' => $borderColor
                    ];
                }
            }
        }
    }

    public function getTrainingsBetweenDates($startDate, $endDate) {
        if ($this->user->role == 'admin' || $this->user->role == 'insegnante') {
            $trainings = Training::where(function ($query) use ($startDate, $endDate) {
                if ($endDate) {
                    $query->whereBetween('begins', [$startDate, $endDate])->orWhere(function ($query) use ($endDate) {
                        $query->where('begins', '<', $endDate)->where(function ($query) use ($endDate) {
                            $query->whereNull('ends')->orWhere('ends', '>', Carbon::now())->where('ends', '<=', $endDate);
                        });
                    });
                } else {
                    $query->Where(function ($query) use ($startDate) {
                        $query->where('begins', '<=', $startDate)->where(function ($query) {
                            $query->whereNull('ends')->orWhere('ends', '>=', Carbon::now()->toDateString());
                        });
                    });
                }
            })->get();
        } else {
            $trainings = Training::where('school_id', $this->user->schools()->first()->id)->where(function ($query) use ($startDate, $endDate) {
                if ($endDate) {
                    $query->whereBetween('begins', [$startDate, $endDate])->orWhere(function ($query) use ($endDate) {
                        $query->where('begins', '<', $endDate)->where(function ($query) use ($endDate) {
                            $query->whereNull('ends')->orWhere('ends', '>', Carbon::now())->where('ends', '<=', $endDate);
                        });
                    });
                } else {
                    $query->Where(function ($query) use ($startDate) {
                        $query->where('begins', '<=', $startDate)->where(function ($query) {
                            $query->whereNull('ends')->orWhere('ends', '>=', Carbon::now()->toDateString());
                        });
                    });
                }
            })->get();
        }

        return $trainings;
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

    #[On('planningUpdate')]
    public function updateCalendar($lesson) {
        $this->dispatch('updateCalendar', $lesson);
    }

    #[On('lessonRemove')]
    public function lessonRemove($lesson) {
        $this->dispatch('eventRemove', $lesson);
    }

    public function render()
    {
        return view('livewire.theory.trainings.calendar');
    }
}
