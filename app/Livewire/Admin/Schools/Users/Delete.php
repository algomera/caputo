<?php

namespace App\Livewire\Admin\Schools\Users;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public $user;

    public function mount($user) {
        $this->user = User::find($user);
    }

    public function delete() {
        $this->user->delete();
        $this->dispatch('school');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.admin.schools.users.delete');
    }
}
