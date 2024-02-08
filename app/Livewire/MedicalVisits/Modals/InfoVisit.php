<?php

namespace App\Livewire\MedicalVisits\Modals;

use App\Models\MedicalPlanning;
use App\Livewire\MedicalVisits\Calendar;
use LivewireUI\Modal\ModalComponent;

class InfoVisit extends ModalComponent
{
    public $visit;

    public function mount($visit) {
        $this->visit = MedicalPlanning::find($visit);
    }

    public function delete() {
        $this->visit->update([
            'booked' => null
        ]);

        $this->closeModalWithEvents([
            Calendar::class => 'visitUpdate',
        ]);
        return redirect()->route('visits.calendar');
    }

    public function showCustomer() {
        return redirect()->route('registry.show', ['customer' => $this->visit->registration->customer->id]);
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-sm !align-top';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.medical-visits.modals.info-visit');
    }
}
