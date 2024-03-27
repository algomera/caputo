<?php

namespace App\Livewire\Services\Commons;

use App\Models\Course;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Models\MedicalPlanning;
use App\Models\InterestedCourses;
use App\Models\IdentificationType;
use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\DocumentForm;
use App\Models\CourseRegistrationStep;
use App\Models\CourseVariant;
use App\Models\IdentificationDocument;
use App\Models\Patent;

class StepRegister extends Component
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public DocumentForm $documentForm;

    public $course;
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
    public $patents;
    public $typeDocuments = [];
    public $companions = null;
    public $companionUploaded = false;
    public $currentStep;

    public function mount() {
        $this->patents = Patent::all();

        if (session('course')['course_variant']) {
            $this->course = CourseVariant::find(session('course')['course_variant']);
        } else {
            $this->course = Course::find(session('course')['id']);
        }

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
        $courseRegistrationSteps = $this->course->courseRegistrationSteps()
        ->where('registration_type_id', session('course')['registration_type'])
        ->first()->getSteps();

        $this->currentStep = $courseRegistrationSteps->first()->short_name;
        $this->customerForm->stepName = $this->currentStep;

        foreach ($courseRegistrationSteps as $key => $step) {
            $this->steps[$key+1] = [
                'id' => $step->id,
                'short_name' => $step->short_name
            ];
        }

        if (session()->get('course')['id'] == 14) {
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
        $this->documentForm->setCustomer($customer);
    }

    public function backStep() {
        $this->customerForm->currentStep -= 1;
        $this->currentStep = $this->steps[$this->customerForm->currentStep]['short_name'];
    }

    public function nextStep() {
        if ($this->customerForm->currentStep == count($this->steps)) {
            $this->dispatch('openModal', 'services.commons.modals.registration');
        } else {
            if ($this->currentStep == 'dati' || $this->currentStep == 'recapiti') {
                $this->customerForm->validation();
            }

            foreach ($this->skipped as $value) {
                if ($this->steps[($this->customerForm->currentStep)]['id'] == $value) {
                    $key = array_search($value, $this->skipped);

                    if ($key !== false) {
                        array_splice($this->skipped, $key, 1);
                    }
                }
            }

            $this->customerForm->currentStep += 1;
            $this->currentStep = $this->steps[$this->customerForm->currentStep]['short_name'];
            $this->customerForm->stepName = $this->currentStep;
        }
    }

    public function skip() {
        if (!in_array($this->steps[($this->customerForm->currentStep)], $this->skipped)) {
            $this->skipped[] = $this->steps[($this->customerForm->currentStep)]['id'];
        }

        if ($this->customerForm->currentStep == count($this->steps)) {
            $this->dispatch('openModal', 'services.commons.modals.registration');
        } else {
            $this->customerForm->currentStep += 1;
            $this->currentStep = $this->steps[$this->customerForm->currentStep]['short_name'];
        }
    }

    #[On('newRegistration')]
    public function registration($trainingId, $type) {
        $this->customerForm->setSchool(auth()->user()->schools()->first()->id);
        $this->customerForm->store();
        $this->setCustomer($this->customerForm->newCustomer->id);

        if ($this->documents) {
            $this->customerForm->documents($this->documents);
        }
        if ($this->photo) {
            $this->customerForm->photo($this->photo);
        }

        if ($this->scans) {
            $this->documentForm->scans($this->scans);
        }
        if ($this->signature) {
            $this->documentForm->signature($this->signature);
        }

        if ($type == 'esistente') {
            if (!in_array(15, array_values(session()->get('course')['selected_options']))) {
                $this->skipped[] = 9;
            }

            $registration = Registration::create([
                'training_id' => $trainingId,
                'customer_id' => $this->customerForm->newCustomer->id,
                'registration_type_id' => session()->get('course')['registration_type'],
                'branch_id' => session()->get('course')['branch'],
                'transmission' => session()->get('course')['transmission'],
                'optionals' => json_encode(session()->get('course')['selected_options']),
                'step_skipped' => json_encode($this->skipped),
                'price' => session()->get('course')['price']
            ]);

            if ($this->parentScans) {
                $this->documentForm->parentScans($this->parentScans, $registration->id);
            }
            if ($this->parentSignature) {
                $this->documentForm->parentSignature($this->parentSignature, $registration->id);
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

                $this->documentForm->companionsSignature($signatures, $registration->id);
                $this->documentForm->companionsScans($scans, $registration->id);
            }
        } elseif ($type == 'interessato') {
            $registration = InterestedCourses::create([
                'customer_id' => $this->customerForm->newCustomer->id,
                'course_id' => session()->get('course')['id'],
                'variant_id' => session()->get('course')['course_variant'],
                'confirm' => 'in attesa'
            ]);
        }

        foreach (session()->get('course')['selected_options'] as $key => $cost) {
            if ($cost == 15) {
                MedicalPlanning::create([
                    'registration_id' => $registration->id
                ]);
            }
        }

        if ($type == 'esistente') {
            $this->dispatch('openModal', 'services.commons.modals.payment', ['registration' => $registration->id]);
        } else {
            return redirect()->route('registry.show', ['customer' => $registration->customer_id]);
        }
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
