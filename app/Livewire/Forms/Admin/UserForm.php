<?php

namespace App\Livewire\Forms\Admin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public $school;
    public $role;
    public $user;
    public $name;
    public $lastName;
    public $email;

    public function rules() {
        return [
            'role' => 'required',
            'name' => 'required',
            'lastName' => 'nullable',
            'email' => 'required|email|unique:users,email'
        ];
    }

    public function messages() {
        return [
            'role.required' => 'Campo richiesto',
            'name.required' => 'Campo richiesto',
            'email.required' => 'Campo richiesto',
        ];
    }

    public function setUser($user) {
        $this->user = User::find($user);
        $this->role = $this->user->role->name;
        $this->name = $this->user->name;
        $this->lastName = $this->user->lastName;
        $this->email = $this->user->email;
    }

    public function setSchool($school) {
        $this->school = $school;
    }

    public function store() {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($this->role);
        $user->schools()->attach($this->school);
    }

    public function update() {
        $this->validate();
        $this->user->update($this->validate());
        $this->reset();
    }

}
