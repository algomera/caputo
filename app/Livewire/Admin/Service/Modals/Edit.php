<?php

namespace App\Livewire\Admin\Service\Modals;

use App\Models\School;
use App\Models\Service;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public School $school;
    public Service $service;
    public $selectedService;

    public function mount($school, $service = null) {
        $this->school = $school;

        if ($service) {
            $this->service = $service;
        }
    }

    public function rules() {
        return [
            'selectedService' => 'required'
        ];
    }

    public function messages() {
        return [
            'selectedService.required' => 'Seleziona un Servizio'
        ];
    }

    public function add() {
        $this->validate();
        $this->service = Service::find(intval($this->selectedService));
        $this->service->schools()->attach($this->school->id);
        $this->dispatch('school');
        $this->closeModal();
    }

    public function remove() {
        $this->service->schools()->detach($this->school->id);
        $this->dispatch('school');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.admin.service.modals.edit');
    }
}
