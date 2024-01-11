<?php

namespace App\Livewire\Services\Training\Modals;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class RegistrationType extends ModalComponent
{
    public Course $course;
    public $selectedOption = null;

    public function mount($course) {
        $this->course = $course;

        session()->put('course', [
            'id' => $this->course->id,
        ]);
    }

    public function setOption($option) {
        if ($option == 'possessore di patente') {
            $this->addSession($option, 'guide');

            $this->dispatch('setCourse',
                course: $this->course->id,
                option: 'iscrizione',
                type  : 'guide'
            );
            return $this->closeModal();
        }

        $this->selectedOption = $option;
    }

    public function resetOption() {
        $this->selectedOption = null;
    }

    public function setType($type) {
        $this->addSession($this->selectedOption, $type);

        $this->dispatch('setCourse',
            course: $this->course->id,
            option: $this->selectedOption,
            type  : $type
        );
        $this->closeModal();
    }

    public function addSession($option, $type) {
        $session = session()->get('course', []);
        $session['option'] = $option;
        $session['registration_type'] = $type;
        session()->put('course', $session);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function render()
    {
        return view('livewire.services.training.modals.registration-type');
    }
}
