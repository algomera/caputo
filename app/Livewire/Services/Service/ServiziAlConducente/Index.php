<?php

namespace App\Livewire\Services\Service\ServiziAlConducente;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public Course $service;
    public $step = 0;
    public $patent;

    public function mount($service) {
        $this->service = $service;
    }

    #[On('backStep')]
    public function backStep() {
        if ($this->step == 0) {
            return redirect()->route('service');
        }
        $this->step -= 1;
    }

    #[On('nextStep')]
    public function nextStep() {
        $this->step += 1;
    }

    public function dataControl() {
        $this->dispatch('openModal', 'services.service.servizi-al-conducente.modals.data-control',
        [
            'service' => $this->service->id,
            'patent' =>  $this->patent
        ]);
    }

    public function render()
    {
        return view('livewire.services.service.servizi-al-conducente.index');
    }
}
