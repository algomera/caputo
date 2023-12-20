<?php

namespace App\Livewire\Admin\Schools\Users;

use App\Livewire\Forms\Admin\UserForm;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class CreateOrUpdate extends ModalComponent
{
    public UserForm $userForm;
    public $action;

    public function mount($user, $school, $action) {
        $this->action = $action;

        if ($action == 'edit') {
            $this->userForm->setUser($user);
        } else {
            $this->userForm->setSchool($school);
        }
    }

    public function next() {
        if ($this->action == 'edit') {
            $this->userForm->update();
        } else {
            $this->userForm->store();
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
        $roles = Role::all()->where('name', '!=', 'admin');
        return view('livewire.admin.schools.users.create-or-update', [
            'roles' => $roles
        ]);
    }
}
