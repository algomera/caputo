<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Livewire\MedicalVisits\Index as MedicalIndex;
use App\Models\MedicalPlanning;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class VisitOutcome extends ModalComponent
{
    public $visit;

    #[Validate('required', message: 'Campo obbligatorio')]
    public $protocol;

    #[Validate('required', message: 'Campo obbligatorio')]
    public $release;

    public function mount($visitId) {
        $this->visit = MedicalPlanning::find($visitId);
    }

    public function save() {
        $this->validate();

        $this->visit->update([
            'protocol' => $this->protocol,
            'protocol_release' => $this->release,
            'protocol_expiration' => Carbon::parse($this->release)->addMonth(3)
        ]);

        $this->closeModalWithEvents([
            MedicalIndex::class => 'visitModified',
        ]);
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.visit-outcome');
    }
}
