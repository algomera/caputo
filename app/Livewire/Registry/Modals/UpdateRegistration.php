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
    public $existingDocumentVisit = false;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $this->options = $this->registration->course->getOptions()->where('type', 'opzionale')->where('registration_type_id', $this->registration->registration_type_id)->whereNotIn('option_id', [8,18])->get();
        $this->selectedOptions = json_decode($this->registration->optionals);
        $this->existingDocumentVisit =  $this->registration->documents()->where('step_id', 9)->first();
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

        if ($id == 16) {
            MedicalPlanning::where('registration_id', $this->registration->id)->delete();

            $arrayStepSkippedId = json_decode($this->registration->step_skipped);
            $key = array_search(9, $arrayStepSkippedId);

            if ($key == false) {
                $arrayStepSkippedId[] = 9;
            }

            $this->registration->update([
                'step_skipped' => array_values($arrayStepSkippedId)
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

        if ($id == 16) {
            MedicalPlanning::create([
                'registration_id' => $this->registration->id
            ]);

            $arrayStepSkippedId = json_decode($this->registration->step_skipped);
            $key = array_search(9, $arrayStepSkippedId);

            if ($key !== false) {
                unset($arrayStepSkippedId[$key]);
            }

            $this->registration->update([
                'step_skipped' => array_values($arrayStepSkippedId)
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
