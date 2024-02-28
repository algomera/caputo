<?php

namespace App\Livewire\Driving\Modals;

use App\Livewire\Driving\Modals\ShowRegistrationGuides;
use App\Models\DrivingPlanning;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class PaymentGuide extends ModalComponent
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

    public function mount($guide) {
        $this->drivingPlanning = DrivingPlanning::find($guide);
        $this->drivingPrice = $this->drivingPlanning->registration->course->getOptions()->where('type', 'guide')->first()->price;
    }

    public function create() {
        $this->validate();
        $this->amount = str_replace(" ", '', $this->amount);

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
                'title' => 'Saldo guida del '. date("d/m/Y H:i", strtotime($this->drivingPlanning->begins))
            ]);
        } else {
            $registration->chronologies()->create([
                'title' => 'Pagamento guida del '. date("d/m/Y H:i", strtotime($this->drivingPlanning->begins)). ' di € '. $this->amount
            ]);
        }

        $this->closeModalWithEvents([
            ShowRegistrationGuides::class => ['updateGuide', ['registration' => $registration->id]],
        ]);
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
        return view('livewire.driving.modals.payment-guide');
    }
}
