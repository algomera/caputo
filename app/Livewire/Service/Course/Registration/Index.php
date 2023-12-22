<?php

namespace App\Livewire\Service\Course\Registration;

use App\Models\Option;
use Livewire\Component;

class Index extends Component
{
    public $course;
    public $option;
    public $type;
    public $transmission;
    public $selectedOptions = [];
    public $total = 0;

    public function mount() {
        $this->total += $this->course->prices()->first()->price;

        foreach ($this->course->getOptions()->where('type', 'Fisso')->get() as  $option) {
            $this->total += $option->price;
        }
    }

    public function updated($selectedOptions) {
        $this->total = 0;
        $this->total += $this->course->prices()->first()->price;

        foreach ($this->course->getOptions()->where('type', 'Fisso')->get() as  $option) {
            $this->total += $option->price;
        }

        foreach ($this->selectedOptions as $id) {
            $option = Option::find($id);
            $this->total += $option->price;
        }
    }

    public function back() {
        $this->dispatch('backStep');
    }

    public function next() {
        // Todo concludere questo step....
        dd($this->course, $this->option, $this->type, $this->selectedOptions, $this->transmission);
    }

    public function render()
    {
        return view('livewire.service.course.registration.index');
    }
}
