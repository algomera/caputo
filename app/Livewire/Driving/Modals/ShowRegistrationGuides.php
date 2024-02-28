<?php

namespace App\Livewire\Driving\Modals;

use App\Models\DrivingPlanning;
use App\Models\Registration;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class ShowRegistrationGuides extends ModalComponent
{
    public $registration;

    #[On('updateGuide')]
    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public function performed($guide) {
        $drivingPlanning = DrivingPlanning::find($guide);
        $registration = Registration::find($drivingPlanning->registration_id);

        $drivingPlanning->update([
            'performed' => 'Svolta'
        ]);

        $registration->chronologies()->create([
            'title' => 'Guida eseguita del '. date("d/m/Y - H:i", strtotime($drivingPlanning->begins))
        ]);

        $this->mount($this->registration->id);
        $this->dispatch('updatePlan');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        $guides = $this->registration->drivingPlanning;

        return view('livewire.driving.modals.show-registration-guides', [
            'guides' => $guides
        ]);
    }
}
