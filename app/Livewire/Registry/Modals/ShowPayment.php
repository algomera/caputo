<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Livewire\Forms\CustomerForm;
use LivewireUI\Modal\ModalComponent;


class ShowPayment extends ModalComponent
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public Payment $payment;
    public $note;
    public $type;
    public $amount;
    public $document;
    public $newScan;

    public function mount($payment) {
        $this->payment = $payment;
        $this->setPayment();
    }

    public function setPayment() {
        $this->fill(
            $this->payment->only('note', 'type', 'amount')
        );
        $this->document = $this->payment->document()->first();
    }

    public function update() {
        $this->payment->update([
            'note' => $this->note,
            'type' => $this->type,
            'amount' => $this->amount
        ]);

        if ($this->newScan) {
            $this->customerForm->updateScan($this->document->id, $this->newScan);
        }

        $this->dispatch('closeModal');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.show-payment');
    }
}
