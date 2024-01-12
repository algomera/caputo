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
        if (session()->get('course')['id'] == 10 AND $option == 'iscrizione') {
            $this->addSession($option, 'teoria');

            $this->dispatch('setCourse',
                course: $this->course->id,
                branch: $option,
                type  : session()->get('course')['registration_type']
            );
            return $this->closeModal();
        }

        if ($option == 'possessore di patente') {
            $this->addSession($option, 'guide');
            $this->selectedOption = 'guide';
        } else {
            $this->addSession($option, $option);
        }

        $this->selectedOption = $option;
    }

    public function resetOption() {
        $this->selectedOption = null;
    }

    public function setType($type) {
        if ($type == 'guide/s.esame') {
            $this->addSession($this->selectedOption, 'guide', 's.esame');
        } else {
            $this->addSession($this->selectedOption, $type);
        }

        $this->dispatch('setCourse',
            course: $this->course->id,
            branch: $this->selectedOption,
            type  : session()->get('course')['registration_type']
        );
        $this->closeModal();
    }

    public function addSession($option, $type, $except = null) {
        $session = session()->get('course', []);
        $session['option'] = $option;
        $session['registration_type'] = $type;
        if ($except) {
            $session['conseguimento'] = $except;
        }
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
