<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Modals\Payments;
use App\Models\DrivingPlanning;
use App\Models\Registration;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class AddPayment extends ModalComponent
{
    public $registration;

    public $drivingPlanning;
    public $drivingPrice;

    #[Validate('required', message: 'Inserire Cifra')]
    public $amount;
    public $note;

    public function mount($registration = null, $drivingPlanning = null) {
        if ($registration) {
            $this->registration = Registration::find($registration);
        }

        if ($drivingPlanning) {
            $this->drivingPlanning = DrivingPlanning::find($drivingPlanning);
            $this->drivingPrice = $this->drivingPlanning->registration->course->getOptions()->where('type', 'guide')->first()->price;
        }
    }

    public function create() {
        $this->validate();
        $this->amount = str_replace(" ", '', $this->amount);

        if ($this->drivingPlanning) {
            $this->drivingPlanning->payments()->create([
                'amount' => $this->amount,
                'note' => $this->note
            ]);

            $registration = $this->drivingPlanning->registration;

            $registration->chronologies()->create([
                'title' => 'Pagamento guida del '. date("d/m/Y", strtotime($this->drivingPlanning->begins))
            ]);

            if ($this->drivingPlanning->sumPayments >= $this->drivingPrice) {
                $this->drivingPlanning->update([
                    'welded' => true
                ]);
            }

            $this->closeModalWithEvents([
                Payments::class => ['updatePayment', ['registration' => $registration->id]],
            ]);
        }

        if ($this->registration) {
            $this->registration->payments()->create([
                'amount' => $this->amount,
                'note' => $this->note
            ]);

            $this->registration->chronologies()->create([
                'title' => 'Pagamento iscrizione'
            ]);

            $this->closeModalWithEvents([
                Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
            ]);
        }


    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }


    public function render()
    {
        return view('livewire.registry.modals.add-payment');
    }
}
