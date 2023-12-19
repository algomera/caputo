<?php

namespace App\Livewire\Admin\Schools;

use App\Models\School;
use LivewireUI\Modal\ModalComponent;

class CreateOrUpdate extends ModalComponent
{
    public $school;
    public $action;

    public function mount($school, $action) {
        $this->action = $action;

        if ($action == 'edit') {
            $this->school = School::find($school);
        }
    }

    public function rules() {
        return [
            'school.code' => 'required|string',
            'school.address' => 'required|string',
            'school.postcode' => 'required|string',
            'school.city' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'school.code.required' => 'Campo richiesto',
            'school.address.required' => 'Campo richiesto',
            'school.postcode.required' => 'Campo richiesto',
            'school.city.required' => 'Campo richiesto',
        ];
    }

    public function store() {

    }

    public function update() {

    }

    public function render()
    {
        return view('livewire.admin.schools.create-or-update');
    }
}
