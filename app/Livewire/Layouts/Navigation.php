<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Navigation extends Component
{
    public $theory = [
        ['route' => 'theory.trainings.index', 'name' => 'Gestione corsi'],
    ];

    public function render()
    {
        return view('livewire.layouts.navigation');
    }
}
