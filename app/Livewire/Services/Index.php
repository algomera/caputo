<?php

namespace App\Livewire\Services;

use App\Models\Course;
use App\Models\CourseVariant;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $step = 0;
    public $selectedService = null;
    public $courses = null;
    public $course;
    public $courseVariant;
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
        $this->course = Course::find(session('course')['id']);
        $this->courseVariant = CourseVariant::find(session('course')['course_variant']);
        $this->branch = session()->get('course')['branch'];
        $this->type = session()->get('course')['registration_type'];
        $this->step += 1;
    }

    public function redirectService($id) {
        $course = Course::find($id);
        dd('Da vedere con Nicola');

        session()->put('course', [
            'id' => $id,
            'course_variant' => '',
            'registration_type' => '',
            'branch' => ''
        ]);

        return redirect()->route('service.driver', ['course' => $course]);
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
