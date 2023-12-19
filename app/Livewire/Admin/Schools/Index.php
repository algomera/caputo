<?php

namespace App\Livewire\Admin\Schools;

use App\Models\School;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $schools = School::all();

        return view('livewire.admin.schools.index', [
            'schools' => $schools
        ]);
    }
}
