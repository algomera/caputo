<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Livewire\Forms\CustomerForm;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class ShowSkipped extends ModalComponent
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public $registration;
    public $stepSkipped;
    public $scans;
    public $scanUploaded = false;
    public $signatureUpload = false;
    public $signature;
    public $companions;
    public $newCompanions = [];
    public $companionUploaded = false;

    public function mount($registration) {
        $this->registration = Registration::find($registration);
        $this->companions = $this->registration->companionDocuments()->get();
        if (count($this->companions) < 1) {
            $this->newCompanions = [
                1 => [
                    'signature' => null,
                    'scans' => []
                ],
            ];
        }
        $this->dispatch('selectedRegistration', $registration);
    }

    public function updated($property) {
        if ($property == "scans") {
            $this->scanUploaded = true;
        }
        if (str_contains($property,'newCompanions')) {
            $this->verifyCompanions();
        }
    }

    public function removeScan($key) {
        unset($this->scans[$key]);

        if (count($this->scans) < 1) {
            $this->scanUploaded = false;
        }
    }

    #[On('uploadSignature')]
    public function uploadSignature($signature) {
        if ($signature) {
            $this->signature = $signature;
            $this->signatureUpload = true;
        }
    }

    #[On('uploadSignatureCompanion')]
    public function uploadSignatureCompanion($key, $signature) {
        $this->newCompanions[$key]['signature'] = $signature;
        $this->verifyCompanions();
    }

    public function addCompanion() {
        $this->newCompanions[] = [
            'signature' => null,
            'scans' => []
        ];

        $this->verifyCompanions();
    }

    public function removeCompanion($key) {
        unset($this->newCompanions[$key]);
        $this->verifyCompanions();
    }

    public function removeCompanionScan($key, $number) {
        unset($this->newCompanions[$key]['scans'][$number]);
        $this->verifyCompanions();
    }

    public function verifyCompanions() {
        foreach ($this->newCompanions as $companion) {
            if (!$companion['signature'] || count($companion['scans']) < 1) {
                return $this->companionUploaded = false;
            }
            $this->companionUploaded = true;
        }
    }

    public function back() {
        $this->stepSkipped = null;
        $this->scans = null;
        $this->scanUploaded = false;
        $this->signatureUpload = false;
        $this->newCompanions = [
            1 => [
                'signature' => null,
                'scans' => []
            ],
        ];
    }

    public function save() {
        $this->customerForm->setCustomer($this->registration->customer_id);
        $stepSkipped = json_decode($this->registration->step_skipped);

        if ($this->scans) {
            if (strpos($this->stepSkipped, 'cliente')) {
                $this->customerForm->scans($this->scans);

                $step = array_search('scansioni', $stepSkipped);
                unset($stepSkipped[$step]);
                $this->registration->update([
                    'step_skipped' => json_encode(array_values($stepSkipped))
                ]);

                $this->dispatch('updateDocument', customer: $this->registration->customer_id);
            } elseif (strpos($this->stepSkipped, 'Genitore')) {
                $this->customerForm->parentScans($this->scans, $this->registration->id);

                if ($this->signature) {
                    $this->customerForm->parentSignature($this->signature, $this->registration->id);
                }

                $step = array_search('genitore/tutore', $stepSkipped);
                unset($stepSkipped[$step]);
                $this->registration->update([
                    'step_skipped' => json_encode(array_values($stepSkipped))
                ]);

                $this->dispatch('updateDocument', customer: $this->registration->customer_id);
            } elseif (strpos($this->stepSkipped, 'visita')) {
                $this->customerForm->medicalVisitScan($this->scans, $this->registration->id);

                $step = array_search('visita', $stepSkipped);
                unset($stepSkipped[$step]);
                $this->registration->update([
                    'step_skipped' => json_encode(array_values($stepSkipped))
                ]);

                $this->dispatch('updateDocument', customer: $this->registration->customer_id);
            }
        } elseif ($this->newCompanions) {
            $signatures = [];
            $scans = [];

            foreach ($this->newCompanions as $key => $companion) {
                if ($companion['signature'] != null) {
                    $signatures[$key] = $companion['signature'];
                }
                if (count($companion['scans']) > 0) {
                    foreach ($companion['scans'] as $scan) {
                        $scans[$key] = $scan;
                    }
                }
            }

            $this->customerForm->companionsSignature($signatures, $this->registration->id);
            $this->customerForm->companionsScans($scans, $this->registration->id);

            $step = array_search('accompagnatori', $stepSkipped);
            unset($stepSkipped[$step]);
            $this->registration->update([
                'step_skipped' => json_encode(array_values($stepSkipped))
            ]);

            $this->dispatch('updateDocument', customer: $this->registration->customer_id);
        }

        $this->mount($this->registration->id);
        $this->back();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.show-skipped');
    }
}
