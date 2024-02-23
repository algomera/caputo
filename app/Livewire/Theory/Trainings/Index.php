<?php

namespace App\Livewire\Theory\Trainings;

use App\Models\Training;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $course = '';
    public $user = '';
    public $code = '';

    public function show($training) {
        return redirect()->route('theory.lessons.index', ['training' => $training]);
    }

    public function calendar($training) {
        return redirect()->route('theory.trainings.calendar', ['training' => $training]);
    }

    #[On('UpdateTrainingIndex')]
    public function render()
    {
        $user = auth()->user();
        $schoolId = $user->schools()->first()->id;
        if ($user->role->name == 'admin') {
            $trainings = Training::with('course', 'courseVariant', 'user', 'school')
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->whereHas('user', function($q) {
                $q->filter('name', $this->user);
            })
            ->whereHas('school', function($q) {
                $q->filter('code', $this->code);
            })->get();
        } elseif ($user->role->name == 'insegnante') {
            $trainings = Training::where('school_id', $schoolId)->where('user_id', $user->id)->with('course', 'courseVariant')
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })->get();
        } else {
            $trainings = Training::where('school_id', $schoolId)->with('course', 'courseVariant', 'user')
            ->whereHas('course', function($q) {
                $q->filter('name', $this->course);
            })
            ->whereHas('user', function($q) {
                $q->filter('name', $this->user);
            })->get();
        }

        return view('livewire.theory.trainings.index', [
            'trainings' => $trainings
        ]);
    }
}
