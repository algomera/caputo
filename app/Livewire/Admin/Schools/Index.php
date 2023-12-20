<?php

namespace App\Livewire\Admin\Schools;

use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\On;
class Index extends Component
{
    public $schools;

    #[On('school')]
    public function mount() {
        $this->schools = School::all();
    }

    public function delete($id) {
        $school = School::find($id);
        $school->delete();
        $this->dispatch('school');
    }

    public function render()
    {
        return view('livewire.admin.schools.index');
    }
}
