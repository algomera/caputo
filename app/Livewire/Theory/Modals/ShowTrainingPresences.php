<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Training;
use LivewireUI\Modal\ModalComponent;

class ShowTrainingPresences extends ModalComponent
{
    public $training;
    public $name = '';
    public $lastName = '';

    public function mount($training) {
        $this->training = Training::find($training);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        $customers = $this->training->customers()
        ->filter('name', $this->name)
        ->filter('lastName', $this->lastName)
        ->get();

        return view('livewire.theory.modals.show-training-presences', [
            'customers' => $customers
        ]);
    }
}
