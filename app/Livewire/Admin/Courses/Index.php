<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Service;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $services = Service::all();
        return view('livewire.admin.courses.index', [
            'services' => $services
        ]);
    }
}
