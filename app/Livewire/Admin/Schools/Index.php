<?php

namespace App\Livewire\Admin\Schools;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.schools.index');
    }
}
