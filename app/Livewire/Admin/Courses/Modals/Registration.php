<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Step;
use App\Models\Branch;
use App\Models\RegistrationType;
use LivewireUI\Modal\ModalComponent;
use App\Models\CourseRegistrationStep;
use App\Models\Option;

class Registration extends ModalComponent
{
    public $courseRegistration;
    public $registrationTypes;
    public $steps;
    public $branches;
    public $options;
    public $costs;

    public $selectedOptions = [];
    public $selectedCosts = [];
    public $selectedSteps = [];
    public $selectedStepData;
    public $selectedBranch = [];


    public function mount($registration) {
        $this->courseRegistration = CourseRegistrationStep::find($registration);
        $this->registrationTypes = RegistrationType::all();
        $this->steps = Step::whereNotIn('id',[9])->get();
        $this->branches = Branch::all();
        $this->options = Option::where('type', 'opzionale')->where('registration_type_id', $this->courseRegistration->registration_type_id)->get();
        $this->costs = Option::where('type', 'fisso')->where('registration_type_id', $this->courseRegistration->registration_type_id)->get();

        $this->selectedOptions = get_course($this->courseRegistration->course_id, $this->courseRegistration->variant_id)->getOptions()->where('type', 'opzionale')->where('registration_type_id', $this->courseRegistration->registration_type_id)->pluck('option_id')->toArray();
        $this->selectedCosts = get_course($this->courseRegistration->course_id, $this->courseRegistration->variant_id)->getOptions()->where('type', 'fisso')->where('registration_type_id', $this->courseRegistration->registration_type_id)->pluck('option_id')->toArray();
        $this->selectedSteps = $this->courseRegistration->getSteps()->get()->whereNotIn('id',[9])->pluck('id')->toArray();
        $this->selectedStepData = $this->courseRegistration->getSteps()->whereIn('id', [1,2])->first()->id;
        $this->selectedBranch = $this->courseRegistration->branchCourses()->pluck('branch_id')->toArray();
    }

    public function debug() {
        dd($this->selectedSteps);

    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.admin.courses.modals.registration');
    }
}
