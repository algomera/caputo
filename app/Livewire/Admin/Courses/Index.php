<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    #[On('service')]
    public function render()
    {
        $services = Service::all();
        return view('livewire.admin.courses.index', [
            'services' => $services
        ]);
    }
}
