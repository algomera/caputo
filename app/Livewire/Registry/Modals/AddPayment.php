<?php

namespace App\Livewire\Registry\Modals;

use App\Livewire\Registry\Modals\Payments;
use App\Models\DrivingPlanning;
use App\Models\Registration;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class AddPayment extends ModalComponent
{
    use WithFileUploads;

    public $registration;

    public $drivingPlanning;
    public $drivingPrice;

    #[Validate('required', message: 'Inserire Cifra')]
    public $amount;

    #[Validate('required', message: 'Seleziona un metodo')]
    public $type;
    public $note;
    public $newScan;

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
            $payment = $this->drivingPlanning->payments()->create([
                'type' => $this->type,
                'amount' => $this->amount,
                'note' => $this->note
            ]);

            $registration = $this->drivingPlanning->registration;

            if ($this->newScan) {
                $path = Storage::putFileAs('customers/customer-'.$registration->customer_id, $this->newScan, str_replace(' ', '_', $this->newScan->getClientOriginalName()));

                $payment->document()->create([
                    'type' => 'Pagamento',
                    'path' => 'storage/app/'.$path
                ]);
            }

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
            $payment = $this->registration->payments()->create([
                'type' => $this->type,
                'amount' => $this->amount,
                'note' => $this->note
            ]);

            if ($this->newScan) {
                $path = Storage::putFileAs('customers/customer-'.$this->registration->customer_id, $this->newScan, str_replace(' ', '_', $this->newScan->getClientOriginalName()));

                $payment->document()->create([
                    'type' => 'Pagamento',
                    'path' => 'storage/app/'.$path
                ]);
            }

            $this->registration->chronologies()->create([
                'title' => 'Pagamento iscrizione'
            ]);

            $this->closeModalWithEvents([
                Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
            ]);
        }
        $this->reset();
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }


    public function render()
    {
        return view('livewire.registry.modals.add-payment');
    }
}