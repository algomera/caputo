<?php

namespace App\Livewire\Theory\Modals;

use App\Models\School;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class TrainingCreate extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {

        return view('livewire.theory.modals.training-create');
    }
}
