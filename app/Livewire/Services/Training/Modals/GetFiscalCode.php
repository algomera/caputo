<?php

namespace App\Livewire\Services\Training\Modals;

use App\Livewire\Forms\CustomerForm;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class GetFiscalCode extends ModalComponent
{
    public CustomerForm $customerForm;

    public $fiscalCode;
    public $message = null;

    public function verifyData() {
        Validator::make(
            ['fiscalCode' => $this->fiscalCode],
            ['fiscalCode' => 'required'],
            ['required' => 'Il campo non può essere vuoto']
        )->validate();

        if ($this->message) {
            $this->next();
        }

        $this->message = 'Nessuna marca operativa trovata';

        //Todo in caso di ritorno dati positivo registrare un nuovo customer e salvare id in sessione
    }

    public function storeCustomer() {
        $this->customerForm->store();
    }

    public function next() {
        if (session()->get('course')['option'] == 'cambio codice') {
            $this->dispatch('openModal', 'services.training.modals.get-signature');
        } else {
            $course = Course::find(session()->get('course')['id']);

            return redirect()->route('service.step.register', [
                'course' => $course,
            ]);
        }
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.get-fiscal-code');
    }
}
