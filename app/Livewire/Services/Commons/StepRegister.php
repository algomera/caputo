<?php

namespace App\Livewire\Services\Commons;

use App\Livewire\Forms\CustomerForm;
use App\Models\Course;
use App\Models\Customer;
use App\Models\IdentificationDocument;
use App\Models\IdentificationType;
use App\Models\InterestedCourses;
use App\Models\MedicalPlanning;
use App\Models\Registration;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\On;

class StepRegister extends Component
{
    use WithFileUploads;

    public Course $course;
    public CustomerForm $customerForm;

    public $patent = null;
    public $customer = null;
    public $photo;
    public $signature;
    public $parentSignature;
    public $pathSignature;
    public $documents = [];
    public $documentUploaded = false;
    public $scans = [];
    public $parentScans = [];
    public $scanUploaded = false;
    public $parentScanUploaded = false;
    public $steps = [];
    public $skipped = [];
    public $typePatents = ['AM', 'A1', 'A2', 'A', 'B1','B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'DE'];
    public $typeDocuments = [];
    public $companions = null;
    public $companionUploaded = false;

    public function mount() {
        if (session('patent')) {
            $this->patent = IdentificationDocument::where('n_document', session()->get('patent'))->first();

            if ($this->patent) {
                $this->customer = Customer::find($this->patent->customer_id);
            }
        }
        foreach (IdentificationType::all() as $type) {
            $this->typeDocuments[] = [
                'id' => $type->id,
                'name' => $type->name,
                'disabled' => false
            ];
        }
        $this->setSteps();
    }

    public function updated($property) {
        if (str_contains($property,'documents')) {
            $this->verifyTypeDocument();
            $this->validateDocument();
        }
        if ($property == "scans") {
            $this->scanUploaded = true;
        }
        if ($property == "parentScan") {
            $this->parentScanUploaded = true;
        }
        if (str_contains($property,'companions')) {
            $this->verifyCompanions();
        }
    }

    public function back() {
        return redirect()->route('service');
    }

    public function setSteps() {
        $course = Course::find(session()->get('course')['id']);
        if ($course->type == 'service') {
            $this->steps= [
                'dati',
                'documenti',
                'scansioni',
                'fototessera',
                'firma',
                'anamnestico'
            ];
        } else {
            $this->steps = [
                'dati',
                'documenti',
                'scansioni',
                'fototessera',
                'firma',
            ];
        }

        if (in_array($course->id, ['10','11','14','15'])) {
            $this->steps[] = 'genitore/tutore';
        }

        if ($course->id == 14) {
            $this->steps[] = 'accompagnatori';
            $this->companions = [
                1 => [
                    'signature' => null,
                    'scans' => []
                ],
            ];
        }
    }

    public function setCustomer($customer) {
        $this->customerForm->setCustomer($customer);
    }

    public function backStep() {
        $this->customerForm->currentStep -= 1;
    }

    public function nextStep() {
        if ($this->customerForm->currentStep == count($this->steps)) {
            $this->dispatch('openModal', 'services.commons.modals.registration');
        } else {
            $this->customerForm->validation();

            foreach ($this->skipped as $key => $value) {
                if ($this->steps[($this->customerForm->currentStep - 1)] == $value) {
                    unset($this->skipped[$key]);
                }
            }

            $this->customerForm->currentStep += 1;
        }
    }

    public function skip() {
        if (!in_array($this->steps[($this->customerForm->currentStep - 1)], $this->skipped)) {
            $this->skipped[] = $this->steps[($this->customerForm->currentStep - 1)];
        }

        if ($this->customerForm->currentStep == count($this->steps)) {
            $this->dispatch('openModal', 'services.commons.modals.registration');
        } else {
            $this->customerForm->currentStep += 1;
        }
    }

    #[On('newRegistration')]
    public function registration($trainingId, $type, $variant = null) {
        $this->customerForm->setSchool(auth()->user()->schools()->first()->id);
        $this->customerForm->store();

        if ($this->documents) {
            $this->customerForm->documents($this->documents);
        }
        if ($this->scans) {
            $this->customerForm->scans($this->scans);
        }
        if ($this->photo) {
            $this->customerForm->photo($this->photo);
        }
        if ($this->signature) {
            $this->customerForm->signature($this->signature);
        }

        if ($type == 'esistente') {
            if (!in_array(15, array_values(session()->get('course')['selected_cost']))) {
                $this->skipped[] = 'visita';
            }

            $registration = Registration::create([
                'training_id' => $trainingId,
                'customer_id' => $this->customerForm->newCustomer->id,
                'option' => session()->get('course')['option'],
                'type' => session()->get('course')['registration_type'],
                'transmission' => session()->get('course')['transmission'],
                'optionals' => json_encode(session()->get('course')['selected_cost']),
                'step_skipped' => json_encode($this->skipped),
                'price' => session()->get('course')['price']
            ]);

            if ($this->parentScans) {
                $this->customerForm->parentScans($this->parentScans, $registration->id);
            }
            if ($this->parentSignature) {
                $this->customerForm->parentSignature($this->parentSignature, $registration->id);
            }
            if ($this->companions) {
                $signatures = [];
                $scans = [];

                foreach ($this->companions as $key => $companion) {
                    if ($companion['signature'] != null) {
                        $signatures[$key] = $companion['signature'];
                    }
                    if (count($companion['scans']) > 0) {
                        foreach ($companion['scans'] as $scan) {
                            $scans[$key] = $scan;
                        }
                    }
                }

                $this->customerForm->companionsSignature($signatures, $registration->id);
                $this->customerForm->companionsScans($scans, $registration->id);
            }
        } elseif ($type == 'interessato') {
            if ($variant) {
                InterestedCourses::create([
                    'customer_id' => $this->customerForm->newCustomer->id,
                    'course_id' => session()->get('course')['id'],
                    'variant_id' => $variant,
                    'confirm' => 'in attesa'
                ]);
            } else {
                InterestedCourses::create([
                    'customer_id' => $this->customerForm->newCustomer->id,
                    'course_id' => session()->get('course')['id'],
                    'confirm' => 'in attesa'
                ]);
            }
        }

        foreach (session()->get('course')['selected_cost'] as $key => $cost) {
            if ($cost == 15) {
                MedicalPlanning::create([
                    'registration_id' => $registration->id
                ]);
            }
        }

        //TODO va implentata la parte pagamenti prima di esssere reinderizzato

        return redirect()->route('registry.show', ['customer' => $this->customerForm->newCustomer->id]);
    }

    public function addDocument() {
        $this->verifyTypeDocument();
        $this->documents[] = ['identification_type_id' => ''];
        $this->validateDocument();
    }

    public function addCompanion() {
        $this->companions[] = [
            'signature' => null,
            'scans' => []
        ];

    }

    public function removeCompanion($key) {
        unset($this->companions[$key]);
        $this->verifyCompanions();
    }

    public function verifyCompanions() {
        foreach ($this->companions as $companion) {
            if (!$companion['signature'] || count($companion['scans']) < 1) {
                return $this->companionUploaded = false;
            }
            $this->companionUploaded = true;
        }
    }

    public function removeDocument($key) {
        unset($this->documents[$key]);
        $this->verifyTypeDocument();
        $this->validateDocument();

        if (count($this->documents) < 1) {
            $this->documentUploaded = false;
        }
    }

    public function verifyTypeDocument() {
        foreach ($this->typeDocuments as $key => $type) {
            $matchingId = collect($this->documents)->firstWhere('identification_type_id', $type['id']);

            if ($matchingId) {
                $this->typeDocuments[$key]['disabled'] = true;
            } else {
                $this->typeDocuments[$key]['disabled'] = false;
            }
        }
    }

    public function validateDocument() {
        foreach ($this->documents as $key => $document) {
            if ($document['identification_type_id'] != 2) {
                unset($this->documents[$key]['qualification']);
            }
            if (count($this->documents[$key]) == 6 AND $document['identification_type_id'] != '' AND $document['identification_type_id'] == 2) {
                foreach ($document as $key => $value) {
                    if ($value == '') {
                        return $this->documentUploaded = false;
                    }
                    if (array_key_exists('qualification', $document)) {
                        if (count($document['qualification']) < 1) {
                            return $this->documentUploaded = false;
                        }
                    }
                    $this->documentUploaded = true;
                }
            } elseif (count($this->documents[$key]) == 5 AND $document['identification_type_id'] != '' AND $document['identification_type_id'] != 2) {
                foreach ($document as $key => $value) {
                    if ($value == '') {
                        return $this->documentUploaded = false;
                    }
                }
                $this->documentUploaded = true;
            } else {
                $this->documentUploaded = false;
            }
        }
    }

    public function removeScan($key) {
        unset($this->scans[$key]);

        if (count($this->scans) < 1) {
            $this->scanUploaded = false;
        }
    }

    public function removeParentScan($key) {
        unset($this->parentScans[$key]);

        if (count($this->parentScans) < 1) {
            $this->parentScanUploaded = false;
        }
    }

    public function removeCompanionScan($key, $number) {
        unset($this->companions[$key]['scans'][$number]);
        $this->verifyCompanions();
    }

    public function changeStep($index) {
        $this->customerForm->currentStep = $index;
    }

    public function render()
    {
        return view('livewire.services.commons.step-register');
    }
}
