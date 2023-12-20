<?php

namespace App\Livewire\Admin\Schools;

use App\Models\School;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public $school;

    public function mount($school) {
        $this->school = School::find($school);
    }

    public function delete() {
        $this->school->delete();
        $this->dispatch('school');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }


    public function render()
    {
        return view('livewire.admin.schools.delete');
    }
}
