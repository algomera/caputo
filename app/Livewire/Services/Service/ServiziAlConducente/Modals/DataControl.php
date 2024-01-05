<?php

namespace App\Livewire\Services\Service\ServiziAlConducente\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class DataControl extends ModalComponent
{
    public Course $course;
    public $title;
    public $patent;
    public $customer;
    public $message;
    public $label;
    public $result;

    public function mount($course, $patent) {
        $this->course = $course;
        $this->patent = $patent;
        $this->setResponse();
    }

    public function setResponse() {
        $this->title = 'Verifica completata';
        $this->message = 'risulta rinnovabile telematicamente.';
        $this->label = 'Patente scaduta il: 11/03/2024';
        $this->customer = [
            'patent' => $this->patent,
            'release' => '11/10/2014',
            'expiration' => '11/03/2024',
            'fullName' => 'Cristino Barbara Concetta',
            'sex' => 'donna',
            'dateOfBirth' => '14/01/1964'
        ];
        $this->result = 'next';
    }

    public function nextControl() {
        $this->dispatch('openModal', 'services.service.servizi-al-conducente.modals.residence-control',
        [
            'course' => $this->course->id,
            'customer' => $this->customer,
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.services.service.servizi-al-conducente.modals.data-control');
    }
}
