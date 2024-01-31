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
    public function setCourse($course, $branch, $type) {
        $this->course = Course::find($course);
        $this->branch = $branch;
        $this->type = $type;
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
                'option' => 'guida accompagnata',
                'registration_type' => 'guide'
            ]);

            $this->setCourse($id,'guida accompagnata', session()->get('course')['registration_type']);
        }
    }

    public function addSession($option, $type, $except = null) {
        $session = session()->get('course', []);
        $session['option'] = $option;
        $session['registration_type'] = $type;
        if ($except) {
            $session['conseguimento'] = $except;
        }
        session()->put('course', $session);
    }

    public function getSignature() {
        dd('service.index');
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.services.index', [
            'services' => $services
        ]);
    }
}
