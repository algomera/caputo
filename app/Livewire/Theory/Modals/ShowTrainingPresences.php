<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Training;
use LivewireUI\Modal\ModalComponent;

class ShowTrainingPresences extends ModalComponent
{
    public $training;
    public $lessonPlannings;
    public $name = '';
    public $lastName = '';

    public function mount($training) {
        $this->training = Training::find($training);
        $this->lessonPlannings = $this->training->plannings()->whereNotNull('begin')->get();
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        $customers = $this->training->getRegistrationCustomerBranch(1)
        ->whereHas('customer', function($q) {
            $q->filter('name', $this->name);
        })
        ->whereHas('customer', function($q) {
            $q->filter('lastName', $this->lastName);
        })
        ->get()->pluck('customer')->unique();

        return view('livewire.theory.modals.show-training-presences', [
            'customers' => $customers
        ]);
    }
}
