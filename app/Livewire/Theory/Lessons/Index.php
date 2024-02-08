<?php

namespace App\Livewire\Theory\Lessons;

use App\Models\Training;
use Livewire\Component;

class Index extends Component
{
    public $training;

    public function mount($training) {
        $this->training = Training::find($training);
    }

    public function back() {
        return redirect()->route('theory.trainings.index');
    }

    public function render()
    {
        return view('livewire.theory.lessons.index');
    }
}
