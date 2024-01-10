<?php

namespace App\Livewire\Services;

use App\Models\Course;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\CustomerForm;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public CustomerForm $customerForm;

    public $step = 0;
    public $selectedService = null;
    public $courses = null;
    public $course;
    public $option;
    public $type;
    public $signature;
    public $pathSignature;


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

    public function redirectService($id) {
        $course = Course::find($id);
        return redirect()->route('driver', ['course' => $course]);
    }

    public function getSignature() {
        // TODO qui di dovra creare il customer e salvare la firma in storage
        // $customer = $this->customerForm->newCustomer;
        // $this->pathSignature = Storage::putFileAs('customers/customer-'.$customer->id, $this->signature, 'firma.png');
        $this->dispatch('uploadedSignature');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.services.index', [
            'services' => $services
        ]);
    }
}
