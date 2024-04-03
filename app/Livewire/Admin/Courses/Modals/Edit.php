<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\Admin\CourseForm;
use App\Models\Branch;
use App\Models\RegistrationType;
use App\Models\Step;
use Livewire\Attributes\On;

class Edit extends ModalComponent
{
    public CourseForm $courseForm;
    public $courseVariants = false;
    public $showVariants = false;
    public $lessons;
    public $registrationTypes;
    public $courseRegistrationSteps;
    public $steps;
    public $branches;

    public $tabs = ['Lezioni','Registrazioni'];
    public $currentTab = 'Lezioni';

    public function mount($course, $variant = null) {
        $this->registrationTypes = RegistrationType::all();
        $this->steps = Step::all();
        $this->branches = Branch::all();
        $this->setCourseData($course, $variant);
    }

    #[On('setCourseVariant')] #[On('newLesson')]
    public function setCourseData($courseId, $variantId = null) {
        if ($variantId) {
            $this->courseForm->setCourse($courseId, $variantId);
            $this->courseRegistrationSteps = $this->courseForm->course->courseRegistrationSteps()->where('variant_id', $variantId)->get();
            $this->courseVariants = false;
        } else {
            $this->courseForm->setCourse($courseId);
            $this->courseRegistrationSteps = $this->courseForm->course->courseRegistrationSteps()->where('variant_id', null)->get();

            if (count($this->courseForm->course->variants()->get())) {
                $this->courseVariants = $this->courseForm->course->variants()->get();
            }
        }

        $this->lessons = $this->courseForm->course->lessons;
    }

    public function setCourseStandard($course) {
        $this->mount($course);
    }

    public function update() {
        $this->courseForm->update();
        $this->dispatch('service');
    }

    public function deleteLesson($lessonId) {
        $lesson = Lesson::find($lessonId);
        $lesson->delete();

        if ($lesson->variant_id) {
            $this->mount( $this->courseForm->course->course->id, $this->courseForm->course->id);
        } else {
            $this->mount( $this->courseForm->course->id);
        }

    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.edit');
    }
}
