<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Payment;
use Livewire\Form;
use ReflectionClass;

class DocumentForm extends Form
{
    public $customer;

    public function setCustomer($customer) {
        $this->customer = Customer::find($customer);
    }

    // Scansione Documenti
    public function scans($scans, $step_id = null) {
        foreach ($scans as $scan) {
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $this->customer->documents()->create([
                'type' => 'documenti di riconoscimento',
                'path' => 'storage/'.$path,
                'step_id' => $step_id
            ]);

            $this->customer->chronologies()->create([
                'title' => 'Scansione cliente: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function newScan($customer, $scan, $registrationId = null) {
        $this->customer = Customer::find($customer);
        $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

        if ($registrationId) {
            $registration = Registration::find($registrationId);

            $registration->documents()->create([
                'type' => 'Scansione: '. $scan->getClientOriginalName(),
                'path' => 'storage/'.$path
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione: '. $scan->getClientOriginalName()
            ]);
        } else {
            $this->customer->documents()->create([
                'type' => 'Scansione: '. $scan->getClientOriginalName(),
                'path' => 'storage/'.$path
            ]);

            $this->customer->chronologies()->create([
                'title' => 'Scansione: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function medicalVisitScan($scans, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        foreach ($scans as $scan) {
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $registration->documents()->create([
                'type' => 'Certificato visita medica',
                'path' => 'storage/'.$path,
                'step_id' => $step_id
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione certificato visita medica'
            ]);
        }
    }

    public function parentScans($scans, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        foreach ($scans as $scan) {
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id.'/parent', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $registration->documents()->create([
                'type' => 'documenti di riconoscimento genitori',
                'path' => 'storage/'.$path,
                'step_id' => $step_id
            ]);

            $registration->chronologies()->create([
                'title' => 'Scansione genitore: '. $scan->getClientOriginalName()
            ]);
        }
    }

    public function companionsScans($scans, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        foreach ($scans as $key => $scan) {
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id.'/companions/'.'companion-'.$key, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));
            $registration->documents()->create([
                'type' => 'documenti di riconoscimento accompagnatore-'.$key,
                'path' => 'storage/'.$path,
                'step_id' => $step_id
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
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$document->documentable_id, $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $customer->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        } elseif ($className == 'Registration') {
            $registration = Registration::find($document->documentable_id);
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$registration->customer_id.'/parent', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $registration->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        } elseif ($className == 'Payment') {
            $payment = Payment::find($document->documentable_id);
            $registration = $payment->registration;
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$registration->customer_id.'/'.$registration->course->slug.'/payments', $scan, str_replace(' ', '_', $scan->getClientOriginalName()));

            $registration->chronologies()->create([
                'title' => 'Aggiornamento '. $document->type
            ]);
        }

        $document->update([
            'path' => 'storage/'.$path
        ]);

        $this->reset();
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

    // Firme
    public function signature($signature, $step_id = null) {
        $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id, $signature, 'firma.png');
        $this->customer->documents()->updateOrCreate(
            ['type' => 'firma'],
            [
                'type' => 'firma',
                'path' => 'storage/'.$path,
                'step_id' => $step_id
            ]
        );

        $this->customer->chronologies()->create([
            'title' => 'Aquisizione firma cliente'
        ]);
    }

    public function parentSignature($signature, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id.'/parent', $signature, 'firma_genitore.png');
        $registration->documents()->updateOrCreate(
            ['type' => 'firma genitore'],
            [
                'type' => 'firma genitore',
                'path' => 'storage/'.$path,
                'step_id' => $step_id
            ]
        );

        $registration->chronologies()->create([
            'title' => 'Aquisizione firma genitore '
        ]);
    }

    public function companionsSignature($signatures, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        foreach ($signatures as $key => $signature) {
            $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id.'/companions/'.'companion-'.$key, $signature, 'firma_accompagnatore-'.$key.'.png');

            $registration->documents()->updateOrCreate(
                ['type' => 'firma accompagnatore-'.$key],
                [
                    'type' => 'firma accompagnatore-'.$key,
                    'path' => 'storage/'.$path,
                    'step_id' => $step_id
                ]
            );

            $registration->chronologies()->create([
                'title' => 'Aquisizione firma accompagnatore-'.$key
            ]);
        }
    }

    public function newSignature($signature, $registrationId, $step_id = null) {
        $registration = Registration::find($registrationId);

        $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->customer->id.'/parent', $signature, 'firma_parente.png');

        $registration->documents()->create([
            'type' => 'firma parente',
            'path' => 'storage/'.$path,
            'step_id' => $step_id
        ]);

        $registration->chronologies()->create([
            'title' => 'Aquisizione firma parente'
        ]);
    }
}
