<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Navbar extends Component
{
    public $services = [
        [
            'route' => 'admin.services',
            'name' => 'Servizi'
        ],
        [
            'route' => 'admin.courses',
            'name' => 'Corsi'
        ],
    ];

    public function render()
    {
        return view('livewire.admin.navbar');
    }
}
