<?php

namespace App\Livewire\Services\Commons\Modals;

use App\Models\Registration;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Payment extends ModalComponent
{
    use WithFileUploads;

    public $registration;

    public $paymentSelected;

    public $amount;

    public $note;
    public $newScan;

    public $paymentTypes = [
        ['icon' => 'pay_cart', 'name' => 'carta di credito'],
        ['icon' => 'pay_other', 'name' => 'ricarica postepay'],
        ['icon' => 'bank', 'name' => 'Bonifico'],
        ['icon' => 'money', 'name' => 'contanti'],
    ];

    public function mount($registration) {
        $this->registration = Registration::find($registration);
    }

    public function rules() {
        return [
            'amount' => 'required',
            'paymentSelected' => 'required'
        ];
    }
    public function messages() {
        return [
            'amount.required' => 'Inserire importo',
            'paymentSelected.required' => 'Seleziona un metodo di pagamento'
        ];
    }

    public function skip() {
        return redirect()->route('registry.show', ['customer' => $this->registration->customer_id]);
    }

    public function create() {
        $this->validate();

        $payment = $this->registration->payments()->create([
            'type' => $this->paymentSelected,
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
                'title' => 'Saldo iscrizione di € '. $this->amount .' con '. $this->paymentSelected
            ]);
        } else {
            $this->registration->chronologies()->create([
                'title' => 'Pagamento iscrizione di € '. $this->amount .' con '. $this->paymentSelected
            ]);
        }

        return redirect()->route('registry.show', ['customer' => $this->registration->customer_id]);
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.services.commons.modals.payment');
    }
}
