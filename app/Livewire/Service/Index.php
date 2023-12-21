<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Index extends Component
{
    public $selectedService = null;
    public $courses = null;

    public function setService($id) {
        $this->selectedService = Service::find($id);
        $this->courses = $this->selectedService->courses()->get();
    }
    public function resetService() {
        $this->selectedService = null;
        $this->courses = null;
    }

    public function render()
    {
        $services = Service::all();
        return view('livewire.service.index', [
            'services' => $services
        ]);
    }
}
