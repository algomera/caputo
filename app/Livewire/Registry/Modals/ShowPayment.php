<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Payment;
use App\Livewire\Registry\Modals\Payments;
use App\Livewire\Registry\Show;
use Livewire\WithFileUploads;
use App\Livewire\Forms\DocumentForm;
use App\Models\Registration;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class ShowPayment extends ModalComponent
{
    use WithFileUploads;

    public DocumentForm $documentForm;
    public $payment;
    public $registration;
    public $note;
    public $document;
    public $newScan;
    public $paymentFor;

    #[Validate('required', message: 'Seleziona metodo di pagamento')]
    public $type;
    #[Validate('required', message: 'Inserisci importo')]
    public $amount;

    public $oldData;

    public function mount($paymentFor, $payment, $registration) {
        $this->paymentFor = $paymentFor;
        $this->registration = Registration::find($registration);
        $this->payment = Payment::find($payment);

        $this->setPayment();
    }

    public function setPayment() {
        $this->fill(
            $this->payment->only('note', 'type', 'amount')
        );
        $this->document = $this->payment->document()->first();

        $this->oldData = [
            'type' => $this->type,
            'amount' => $this->amount
        ];
    }

    public function update() {
        $this->validate();

        if ($this->type != $this->oldData['type'] || ($this->amount != $this->oldData['amount'])) {
            $this->registration->chronologies()->create([
                'title' => 'Modifica pagamento da € '.$this->oldData['amount'].' con '. $this->oldData['type']. ' in € ' .$this->amount .' con '.$this->type
            ]);
        }

        $this->payment->update([
            'note' => $this->note,
            'type' => $this->type,
            'amount' => $this->amount
        ]);

        if ($this->newScan) {
            if ($this->document) {
                $this->documentForm->updateScan($this->document->id, $this->newScan, $this->paymentFor);
            } else {
                $path = Storage::disk('public')->putFileAs('customers/customer-'.$this->registration->customer_id.'/'.$this->registration->course->slug.'/payments', $this->newScan, str_replace(' ', '_', $this->newScan->getClientOriginalName()));

                $this->payment->document()->create([
                    'type' => 'Pagamento',
                    'path' => 'storage/'.$path
                ]);
            }
        }

        $this->closeModalWithEvents([
            Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
        ]);
    }

    public function delete() {
        $this->payment->delete();

        $this->registration->chronologies()->create([
            'title' => 'Cancellazione pagamento € '.$this->payment->amount
        ]);

        $this->closeModalWithEvents([
            Payments::class => ['updatePayment', ['registration' => $this->registration->id]],
            Show::class => ['updateDocument', ['customer' => $this->registration->customer_id]]
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
        return view('livewire.registry.modals.show-payment');
    }
}
