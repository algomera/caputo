<?php

namespace App\Livewire\Services\Service\ServiziAlConducente\Modals;

use App\Models\Course;
use App\Models\IdentificationDocument;
use LivewireUI\Modal\ModalComponent;

class ResidenceControl extends ModalComponent
{
    public Course $course;
    public $customer;

    public function mount($course, $customer) {
        $this->course = $course;
        $this->customer = $customer;
    }

    public function next() {
        session()->put('patent', $this->customer['patent']);

        return redirect()->route('step.register', [
            'course' => $this->course,
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.services.service.servizi-al-conducente.modals.residence-control');
    }
}
