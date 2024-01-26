<?php

namespace App\Livewire\Registry\Modals;

use App\Models\Document;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\CustomerForm;
use App\Livewire\Registry\Modals\Scans;
use Livewire\WithFileUploads;

class ShowScan extends ModalComponent
{
    use WithFileUploads;

    public CustomerForm $customerForm;
    public $scan;

    public $newScan;

    public function mount($scan) {
        $this->scan = Document::find($scan);
    }

    public function updated($property) {
        if ($property == 'newScan') {
            $this->customerForm->updateScan($this->scan->id, $this->newScan);
            $this->mount($this->scan->id);
        }
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.registry.modals.show-scan');
    }
}
