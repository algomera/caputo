<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\Document;
use App\Models\IdentificationType;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;

class CustomerForm extends Form
{
    public $school_id;
    public $customer;
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
        return [
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
            'email' => 'required',
            'phone_1' => 'required',
            'phone_2' => 'nullable',
        ];
    }

    public function messages() {
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
            'civic.required' => 'Richiesto',
            'postcode.required' => 'Richiesto',
            'email.required' => 'Email richiesta',
            'phone_1.required' => 'Campo richiesto',
        ];
    }

    public function setCustomer($customer) {
        $this->customer = Customer::find($customer);
        $this->fill(
            $this->customer->only(
                'name',
                'lastName',
                'sex',
                'fiscal_code',
                'date_of_birth',
                'birth_place',
                'country_of_birth',
                'country',
                'city',
                'province',
                'address',
                'civic',
                'postcode',
                'email',
                'phone_1',
                'phone_2',
            )
        );
    }

    public function setSchool($id) {
        $this->school_id = $id;
    }

    public function validation() {
        if ($this->currentStep <= 1) {
            $this->validate();
        }
    }

    public function store() {
        $this->newCustomer = Customer::create([
            'school_id' => $this->school_id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'sex' => $this->sex,
            'fiscal_code' => $this->fiscal_code,
            'date_of_birth' => $this->date_of_birth,
            'birth_place' => $this->birth_place,
            'country_of_birth' => $this->country_of_birth,
            'country' => $this->country,
            'city' => $this->city,
            'province' => $this->province,
            'address' => $this->address,
            'civic' => $this->civic,
            'postcode' => $this->postcode,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
        ]);

        $this->newCustomer->chronologies()->create([
            'title' => 'Registrazione cliente'
        ]);
    }

    public function photo($photo) {
        if ($this->customer) {
            $path = Storage::putFileAs('customers/customer-'.$this->customer->id, $photo, 'fototessera.png');

            $this->customer->documents()->updateOrCreate(
                ['type' => 'fototessera'],
                [
                    'type' => 'fototessera',
                    'path' => 'storage/app/'.$path
                ]
            );

            $this->customer->chronologies()->create([
                'title' => 'Aggiornamento fototessera'
            ]);
        } elseif ($this->newCustomer) {
            $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id, $photo, 'fototessera.png');

            $this->newCustomer->documents()->updateOrCreate(
                ['type' => 'fototessera'],
                [
                    'type' => 'fototessera',
                    'path' => 'storage/app/'.$path
                ]
            );

            $this->newCustomer->chronologies()->create([
                'title' => 'Inserimento fototessera'
            ]);
        }
    }

    public function documents($documents) {
        foreach ($documents as $document) {
            $this->newCustomer->identificationDocuments()->create([
                'identification_type_id' => $document['identification_type_id'],
                'n_document' => $document['n_document'],
                'document_release' => $document['document_release'],
                'document_from' => $document['document_from'],
                'document_expiration' => $document['document_expiration'],
                'qualification' => array_key_exists('qualification', $document) ? json_encode($document['qualification']) : null
            ]);

            $document = IdentificationType::find($document['identification_type_id']);

            $this->newCustomer->chronologies()->create([
                'title' => 'Inserimento '. $document->name
            ]);
        }
    }

    public function scans($scans) {
        foreach ($scans as $scan) {
            $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $this->newCustomer->documents()->create([
                'type' => 'documenti di riconoscimento',
                'path' => 'storage/app/'.$path
            ]);

            $this->newCustomer->chronologies()->create([
                'title' => 'Scansione cliente: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function newScan($customer, $scan, $registrationId = null) {
        $this->customer = Customer::find($customer);
        $path = Storage::putFileAs('customers/customer-'.$this->customer->id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

        if ($registrationId) {
            $registration = Registration::find($registrationId);

            $registration->documents()->create([
                'type' => 'Scansione: '. $scan->getClientOriginalName(),
                'path' => 'storage/app/'.$path
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione: '. $scan->getClientOriginalName()
            ]);
        } else {
            $this->customer->documents()->create([
                'type' => 'Scansione: '. $scan->getClientOriginalName(),
                'path' => 'storage/app/'.$path
            ]);

            $this->customer->chronologies()->create([
                'title' => 'Scansione: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function parentScans($scans, $registrationId) {
        $registration = Registration::find($registrationId);

        foreach ($scans as $scan) {
            $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id.'/parent', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $registration->documents()->create([
                'type' => 'documenti di riconoscimento genitori',
                'path' => 'storage/app/'.$path
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione genitore: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function companionsScans($scans, $registrationId) {
        $registration = Registration::find($registrationId);

        foreach ($scans as $key => $scan) {
            $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id.'/companions/'.'companion-'.$key, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $registration->documents()->create([
                'type' => 'documenti di riconoscimento accompagnatore-'.$key,
                'path' => 'storage/app/'.$path
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione accompagnatore-'.$key.': '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function updateScan($id, $scan) {
        $document = Document::find($id);
        $type = $document->documentable_type;
        $documentClass = new ReflectionClass($type);
        $className = $documentClass->getShortName();

        if ($className == 'Customer') {
            $customer = Customer::find($document->documentable_id);
            $path = Storage::putFileAs('customers/customer-'.$document->documentable_id.'/parent', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $customer->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        } elseif ($className == 'Registration') {
            $registration = Registration::find($document->documentable_id);
            $path = Storage::putFileAs('customers/customer-'.$registration->customer_id.'/parent', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $registration->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        } elseif ($className == 'Payment') {
            $payment = Payment::find($document->documentable_id);
            $registration = $payment->registration;
            $path = Storage::putFileAs('customers/customer-'.$registration->customer_id.'/'.$registration->course->slug.'/payments', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $registration->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        }

        $document->update([
            'path' => 'storage/app/'.$path
        ]);

        $this->reset();
    }

    public function signature($signature) {
        $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id, $signature, 'firma.png');
        $this->newCustomer->documents()->updateOrCreate(
            ['type' => 'firma'],
            [
                'type' => 'firma',
                'path' => 'storage/app/'.$path
            ]
        );

        $this->newCustomer->chronologies()->create([
            'title' => 'Aquisizione firma cliente'
        ]);
    }

    public function parentSignature($signature, $registrationId) {
        $registration = Registration::find($registrationId);

        $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id.'/parent', $signature, 'firma_genitore.png');
        $registration->documents()->updateOrCreate(
            ['type' => 'firma genitore'],
            [
                'type' => 'firma genitore',
                'path' => 'storage/app/'.$path
            ]
        );

        $registration->chronologies()->create([
            'title' => 'Aquisizione firma genitore '
        ]);
    }

    public function newSignature($signature, $registrationId) {
        $registration = Registration::find($registrationId);

        $path = Storage::putFileAs('customers/customer-'.$this->customer->id.'/parent', $signature, 'firma_parente.png');

        $registration->documents()->create([
            'type' => 'firma parente',
            'path' => 'storage/app/'.$path
        ]);

        $registration->chronologies()->create([
            'title' => 'Aquisizione firma parente'
        ]);
    }

    public function companionsSignature($signatures, $registrationId) {
        $registration = Registration::find($registrationId);

        foreach ($signatures as $key => $signature) {
            $path = Storage::putFileAs('customers/customer-'.$this->newCustomer->id.'/companions/'.'companion-'.$key, $signature, 'firma_accompagnatore-'.$key.'.png');

            $registration->documents()->updateOrCreate(
                ['type' => 'firma accompagnatore-'.$key],
                [
                    'type' => 'firma accompagnatore-'.$key,
                    'path' => 'storage/app/'.$path
                ]
            );

            $registration->chronologies()->create([
                'title' => 'Aquisizione firma accompagnatore-'.$key
            ]);
        }
    }

    public function update() {
        $this->validate();
        $this->customer->update($this->validate());

        $this->customer->chronologies()->create([
            'title' => 'Aggiornamento dati cliente'
        ]);
    }

    public function deleteScan($scan) {
        $document = Document::find($scan);
        $type = $document->documentable_type;
        $documentClass = new ReflectionClass($type);
        $className = $documentClass->getShortName();

        $document->delete();

        if ($className == 'Customer') {
            $customer = Customer::find($document->documentable_id);

            $customer->chronologies()->create([
                'title' => 'Eliminazione '. $document->type
            ]);
        } else {
            $registration = Registration::find($document->documentable_id);

            $registration->chronologies()->create([
                'title' => 'Eliminazione '. $document->type
            ]);
        }
        $this->reset();
    }
}
