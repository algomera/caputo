<?php

namespace App\Livewire\Services;

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
    public $branch;
    public $type;
    public $signature;

    public function setService($id) {
        $this->selectedService = Service::find($id);
        $this->courses = $this->selectedService->courses()->get();
        session()->put('serviceName', $this->selectedService->name);
        $this->step += 1;
    }

    #[On('backStep')]
    public function backStep() {
        $this->step -= 1;
    }

    #[On('setCourse')]
    public function setCourse() {
        $this->course = Course::find(session()->get('course')['id']);
        $this->branch = session()->get('course')['branch'];
        $this->type = session()->get('course')['registration_type'];
        $this->step += 1;
    }

    public function redirectService($id) {
        $course = Course::find($id);

        session()->put('course', [
            'id' => $id,
        ]);

        return redirect()->route('service.driver', ['course' => $course]);
    }

    public function next($id) {
        if ($id == 14) {
            session()->put('course', [
                'id' => $id,
                'branch' => 'guida accompagnata',
                'registration_type' => 1
            ]);

            $this->setCourse();
        }
    }

    public function getSignature() {
        $this->dispatch('openModal', 'services.commons.modals.registration');
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.services.index', [
            'services' => $services
        ]);
    }
}
