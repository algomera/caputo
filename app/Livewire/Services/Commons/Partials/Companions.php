<?php

namespace App\Livewire\Services\Commons\Partials;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Livewire\Forms\CustomerForm;
use Livewire\Component;

class Companions extends Component
{
    use WithFileUploads;
    public CustomerForm $customerForm;


    public $companions = [
        1 => [
            'signature' => null,
            'scans' => []
        ],
        2 => [
            'signature' => null,
            'scans' => []
        ],
        3 => [
            'signature' => null,
            'scans' => []
        ],
    ];

    #[On('creatingCustomer')]
    public function addCompanions() {
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

            $this->customerForm->companionsSignature($signatures);
            $this->customerForm->companionsScans($scans);
        }
    }

    public function putCompanion() {
        $this->dispatch('nextStep');
    }

    public function removeScan($key, $number) {
        unset($this->companions[$key]['scans'][$number]);
    }


    public function render()
    {
        return view('livewire.services.commons.partials.companions');
    }
}
