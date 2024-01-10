<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Storage;


class CustomerForm extends Form
{
    public $school_id;
    public Customer $customer;
    public $newCustomer;
    public $currentStep = 1;

    public $name;
    public $lastName;
    public $sex;
    public $fiscal_code;
    public $date_of_birth;
    public $birth_place;
    public $country_of_birth;
    public $country;
    public $city;
    public $province;
    public $address;
    public $civic;
    public $postcode;
    public $email;
    public $phone_1;
    public $phone_2;

    public function rules() {
        if ($this->currentStep == 1) {
            return [
                'school_id' => 'nullable',
                'name' => 'required',
                'lastName' => 'required',
                'sex' => 'required',
                'fiscal_code' => 'required',
                'date_of_birth' => 'required',
                'birth_place' => 'required',
                'country_of_birth' => 'required',
                'country' => 'required',
                'city' => 'required',
                'province' => 'required',
                'address' => 'required',
                'civic' => 'required',
                'postcode' => 'required',
            ];
        } elseif ($this->currentStep == 2) {
            return [
                'email' => 'required',
                'phone_1' => 'required',
                'phone_2' => 'nullable',
            ];
        }
    }

    public function messages() {
        if ($this->currentStep == 1) {
            return [
                'name.required' => 'Campo richiesto',
                'lastName.required' => 'Campo richiesto',
                'sex.required' => 'Campo richiesto',
                'fiscal_code.required' => 'Campo richiesto',
                'date_of_birth.required' => 'Campo richiesto',
                'birth_place.required' => 'Campo richiesto',
                'country_of_birth.required' => 'Campo richiesto',
                'country.required' => 'Campo richiesto',
                'city.required' => 'Campo richiesto',
                'province.required' => 'Campo richiesto',
                'address.required' => 'Campo richiesto',
                'civic.required' => 'Campo richiesto',
                'postcode.required' => 'Campo richiesto',
            ];
        } elseif ($this->currentStep == 2) {
            return [
                'email.required' => 'Campo richiesto',
                'phone_1.required' => 'Campo richiesto',
            ];
        }
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
        $this->name = $this->customer->name;
        $this->lastName = $this->customer->lastName;
        $this->sex = $this->customer->sex;
        $this->fiscal_code = $this->customer->fiscal_code;
        $this->date_of_birth = $this->customer->date_of_birth;
        $this->birth_place = $this->customer->birth_place;
        $this->country_of_birth = $this->customer->country_of_birth;
        $this->country = $this->customer->country;
        $this->city = $this->customer->city;
        $this->province = $this->customer->province;
        $this->address = $this->customer->address;
        $this->civic = $this->customer->civic;
        $this->postcode = $this->customer->postcode;
        $this->email = $this->customer->email;
        $this->phone_1 = $this->customer->phone_1;
        $this->phone_2 = $this->customer->phone_2;
    }

    public function setSchool($id) {
        $this->school_id = $id;
    }

    public function store() {
        $this->validate();

        if ($this->currentStep == 1) {
            $this->newCustomer = Customer::create($this->validate());
        } elseif ($this->currentStep == 2) {
            $this->newCustomer->update($this->validate());
        }
    }

    public function photo($photo) {
        $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id, $photo, 'fototessera.png');

        $this->newCustomer->documents()->updateOrCreate(
            ['type' => 'fototessera'],
            [
                'type' => 'fototessera',
                'path' => $path
            ]
        );
    }

    public function documents($documents) {
        foreach ($documents as $document) {
            $this->newCustomer->identificationDocuments()->create([
                'type' => $document['type'],
                'n_document' => $document['n_document'],
                'document_release' => $document['document_release'],
                'document_from' => $document['document_from'],
                'document_expiration' => $document['document_expiration'],
                'qualification' => json_encode($document['qualification']) ?? null
            ]);
        }
    }

    public function scans($scans) {
        foreach ($scans as $scan) {
            $path = Storage::putFile('customers/customer-'.$this->newCustomer->id, $scan);
            $this->newCustomer->documents()->create([
                'type' => 'documenti di riconoscimento',
                'path' => $path
            ]);
        }
    }

    public function signature($path) {
        $this->newCustomer->documents()->updateOrCreate(
            ['type' => 'firma'],
            [
                'type' => 'firma',
                'path' => $path
            ]
        );
    }

    public function update() {
        $this->validate();
        $this->customer->update($this->validate());
        $this->reset();
    }
}
