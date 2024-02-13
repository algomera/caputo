<?php

namespace App\Livewire\Theory\Lessons;

use App\Models\Training;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $training;
    public $variant;

    #[On('updateLesson')]
    public function mount($training) {
        $this->training = Training::find($training);

        if ($this->training->variant_id) {
            $this->variant = 'courseVariant';
        } else {
            $this->variant = 'course';
        }
    }

    public function calendar() {
        return redirect()->route('theory.trainings.calendar', ['training' => $this->training->id]);
    }

    public function customers() {
        $this->dispatch('openModal', 'theory.modals.show-customers', [
            'training' => $this->training->id
        ]);
    }

    public function back() {
        return redirect()->route('theory.trainings.index');
    }

    public function render()
    {
        return view('livewire.theory.lessons.index');
    }
}
