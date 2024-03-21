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

    public function updated($property) {
        if ($property == 'amount') {
            $this->amount = str_replace(" ", '', $this->amount);
        }
    }

    public function create() {
        $this->validate();

        if ($this->drivingPlanning) {
            $payment = $this->drivingPlanning->payments()->create([
                'type' => $this->type,
                'amount' => $this->amount,
                'note' => $this->note
            ]);

            $registration = $this->drivingPlanning->registration;

            if ($this->newScan) {
                $path = Storage::disk('public')->putFileAs('customers/customer-'.$registration->customer_id, $this->newScan, str_replace(' ', '_', $this->newScan->getClientOriginalName()));

                $payment->document()->create([
                    'type' => 'Pagamento',
                    'path' => 'storage/'.$path
                ]);
            }

            if ($this->drivingPlanning->sumPayments >= $this->drivingPrice) {
                $this->drivingPlanning->update([
                    'welded' => true
                ]);

                $registration->chronologies()->create([
                    'title' => 'Saldo guida del '. date("d/m/Y H:i", strtotime($this->drivingPlanning->begins)). ' di € '. $this->amount .' con '. $this->type
                ]);
            } else {
                $registration->chronologies()->create([
                    'title' => 'Pagamento guida del '. date("d/m/Y H:i", strtotime($this->drivingPlanning->begins)). ' di € '. $this->amount .' con '. $this->type
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
                $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->registration->customer_id, $this->newScan, str_replace(' ', '_', $this->newScan->getClientOriginalName()));

                $payment->document()->create([
                    'type' => 'Pagamento',
                    'path' => 'storage/'.$path
                ]);
            }

            if ($this->registration->sumPayments >= $this->registration->price) {
                $this->registration->update([
                    'welded' => true
                ]);

                $this->registration->chronologies()->create([
                    'title' => 'Saldo iscrizione di € '. $this->amount .' con '. $this->type
                ]);
            } else {
                $this->registration->chronologies()->create([
                    'title' => 'Pagamento iscrizione di € '. $this->amount .' con '. $this->type
                ]);
            }

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

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.registry.modals.add-payment');
    }
}
