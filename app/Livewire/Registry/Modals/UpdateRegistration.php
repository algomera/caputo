<?php

namespace App\Livewire\Registry\Modals;

use App\Models\MedicalPlanning;
use App\Models\Option;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class UpdateRegistration extends ModalComponent
{
    public $registration;
    public $options;
    public $selectedOptions = [];

    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $this->options = $this->registration->course->getOptions()->where('type', 'opzionale')->where('registration_type_id', $this->registration->registration_type_id)->whereNot('name', 'Supporto audio')->get();
        $this->selectedOptions = json_decode($this->registration->optionals);
    }

    public function remove($id) {
        $optionId = array_search($id, $this->selectedOptions);
        $option = Option::find($id);
        unset($this->selectedOptions[$optionId]);
        $priceUpdated = $this->registration->price - $option->price;

        $this->registration->update([
            'optionals' => json_encode(array_values($this->selectedOptions)),
            'price' => $priceUpdated
        ]);

        if (strpos($option->name, 'medico')) {
            MedicalPlanning::where('registration_id', $this->registration->id)->delete();

            $stepSkipped = json_decode($this->registration->step_skipped);
            $stepSkipped[] = 'visita';
            $this->registration->update([
                'step_skipped' => json_encode(array_values($stepSkipped))
            ]);
        }

        $this->registration->chronologies()->create([
            'title' => 'Rimozione opzione: '. $option->name
        ]);

        $this->dispatch('updateDocument', $this->registration->customer_id);

        $this->mount($this->registration->id);
    }

    public function add($id) {
        $this->selectedOptions[] = $id;
        $option = Option::find($id);
        $priceUpdated = $this->registration->price + $option->price;

        $this->registration->update([
            'optionals' => json_encode(array_values($this->selectedOptions)),
            'price' => $priceUpdated
        ]);

        if (strpos($option->name, 'medico')) {
            MedicalPlanning::create([
                'registration_id' => $this->registration->id
            ]);

            $stepSkipped = json_decode($this->registration->step_skipped);
            $step = array_search('visita', $stepSkipped);
            unset($stepSkipped[$step]);
            $this->registration->update([
                'step_skipped' => json_encode(array_values($stepSkipped))
            ]);
        }

        $this->registration->chronologies()->create([
            'title' => 'Aggiunta opzione: '. $option->name
        ]);

        $this->dispatch('updateDocument', $this->registration->customer_id);

        $this->mount($this->registration->id);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.update-registration');
    }
}
