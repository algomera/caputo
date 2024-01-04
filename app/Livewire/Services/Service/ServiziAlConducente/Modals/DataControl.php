<?php

namespace App\Livewire\Services\Service\ServiziAlConducente\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class DataControl extends ModalComponent
{
    public Course $service;
    public $title;
    public $patent;
    public $customer;
    public $message;
    public $label;
    public $result;

    public function mount($service, $patent) {
        $this->service = $service;
        $this->patent = $patent;
        $this->setResponse();
    }

    public function setResponse() {
        $this->title = 'Verifica completata';
        $this->message = 'risulta rinnovabile telematicamente.';
        $this->label = 'Patente scaduta il: 11/03/2024';
        $this->customer = [
            'release' => '11/10/2014',
            'expiration' => '11/03/2024',
            'fullName' => 'Cristino Barbara Concetta',
            'sex' => 'donna',
            'dateOfBirth' => '14/01/1964'
        ];
        $this->result = 'next';
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
