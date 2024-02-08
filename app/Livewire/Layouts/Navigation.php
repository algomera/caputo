<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Navigation extends Component
{
    public $theory = [
        ['route' => 'theory.trainings.index', 'name' => 'Gestione corsi'],
        ['route' => 'service', 'name' => 'Gestione presenze'],
    ];

    public function render()
    {
        return view('livewire.layouts.navigation');
    }
}
