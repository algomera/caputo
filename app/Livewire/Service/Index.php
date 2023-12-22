<?php

namespace App\Livewire\Service;

use App\Models\Course;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $step = 0;
    public $selectedService = null;
    public $courses = null;
    public $course;
    public $option;
    public $type;


    public function setService($id) {
        $this->selectedService = Service::find($id);
        $this->courses = $this->selectedService->courses()->get();
        $this->step += 1;
    }

    #[On('backStep')]
    public function backStep() {
        $this->step -= 1;
    }

    #[On('nextStep')]
    public function nextStep() {
        $this->step += 1;
    }

    #[On('setCourse')]
    public function setCourse($course, $option, $type) {
        $this->course = Course::find($course);
        $this->option = $option;
        $this->type = $type;
        $this->step += 1;
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.service.index', [
            'services' => $services
        ]);
    }
}
