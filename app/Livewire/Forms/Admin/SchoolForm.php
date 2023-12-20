<?php

namespace App\Livewire\Forms\Admin;

use App\Models\School;
use Illuminate\Validation\Rule;
use Livewire\Form;

class SchoolForm extends Form
{
    public $school;
    public $code;
    public $address;
    public $postcode;
    public $city;

    public function rules() {
        return [
            'code' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',
        ];
    }

    public function messages() {
        return [
            'code.required' => 'Campo richiesto',
            'address.required' => 'Campo richiesto',
            'postcode.required' => 'Campo richiesto',
            'city.required' => 'Campo richiesto',
        ];
    }

    public function setSchool($id) {
        $this->school = School::find($id);
        $this->code = $this->school->code;
        $this->address = $this->school->address;
        $this->postcode = $this->school->postcode;
        $this->city = $this->school->city;
    }

    public function store() {
        $this->validate();
        School::create($this->validate());
    }

    public function update() {
        $this->validate();
        $this->school->update($this->validate());
        $this->reset();
    }
}
