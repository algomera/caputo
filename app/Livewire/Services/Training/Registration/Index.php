<?php

namespace App\Livewire\Services\Training\Registration;

use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class Index extends Component
{
    public $course;
    public $branch;
    public $type;
    public $selectedOptions = [];
    public $total = 0;

    #[Validate('required', message: 'Scelta obbligatoria')]
    public $transmission;

    public function mount() {
        if (session()->get('course')['branch'] == 'teoria') {
            $this->total += $this->course->prices()->where('licenses', null)->first()->price;
        }

        foreach ($this->course->getOptions()->where('type', 'fisso')->where('registration_type_id', $this->type)->get() as  $option) {
            $this->total += $option->price;
        }
    }

    public function updated() {
        $this->total = 0;

        if (session()->get('course')['branch'] == 'teoria') {
            $this->total += $this->course->prices()->first()->price;
        }

        foreach ($this->course->getOptions()->where('type', 'fisso')->where('registration_type_id', $this->type)->get() as  $option) {
            $this->total += $option->price;
        }

        foreach ($this->selectedOptions as $id) {
            $option = Option::find($id);
            $this->total += $option->price;
        }
    }

    public function back() {
        $this->dispatch('backStep');
    }

    #[On('removeSupport')]
    public function removeSupport() {
        $this->selectedOptions = array_diff($this->selectedOptions, [17]);
        $this->dispatch('closeModal');
    }

    public function next() {
        $this->validate();

        $session = session()->get('course', []);
        $session['selected_options'] = [];
        foreach ($this->selectedOptions as $optionId) {
            $session['selected_options'][] = intval($optionId);
        }
        $session['transmission'] = $this->transmission;
        $session['price'] = $this->total;
        session()->put('course', $session);

        if (session()->get('course')['registration_type'] != 4) {
            $this->dispatch('openModal', 'services.training.modals.get-fiscal-code');
        } else {
            $this->dispatch('openModal', 'services.training.modals.remind-t-t2112');
        }
    }

    public function render()
    {
        return view('livewire.services.training.registration.index');
    }
}
