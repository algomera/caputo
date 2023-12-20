<?php

namespace App\Livewire\Admin\Schools;

use App\Livewire\Forms\Admin\SchoolForm;
use LivewireUI\Modal\ModalComponent;

class CreateOrUpdate extends ModalComponent
{
    public SchoolForm $schoolForm;
    public $action;

    public function mount($school, $action) {
        $this->action = $action;

        if ($action == 'edit') {
            $this->schoolForm->setSchool($school);
        }
    }

    public function next() {
        if ($this->action == 'edit') {
            $this->schoolForm->update();
        } else {
            $this->schoolForm->store();
        }
        $this->dispatch('school');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.admin.schools.create-or-update');
    }
}
