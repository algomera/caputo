<?php

namespace App\Livewire\Admin\Courses\Modals;

use App\Models\Step;
use App\Models\Branch;
use App\Models\Option;
use Illuminate\Support\Str;
use App\Models\RegistrationType;
use LivewireUI\Modal\ModalComponent;
use App\Models\CourseRegistrationStep;
use App\Livewire\Forms\Admin\CourseForm;

class Registration extends ModalComponent
{
    public CourseForm $courseForm;

    public $courseRegistration;
    public $registrationTypes;
    public $steps;
    public $allBranches;
    public $options;
    public $costs;
    public $guides;

    public $condition = null;
    public $selectedBranches = [];
    public $stateBranches = [];
    public $selectedCosts = [];
    public $selectedOptions = [];
    public $selectedGuide;
    public $detailGuide;
    public $selectedStepData;
    public $selectedSteps = [];


    public function mount($registration) {
        $this->courseRegistration = CourseRegistrationStep::find($registration);
        $this->registrationTypes = RegistrationType::all();
        $this->steps = Step::whereNotIn('id',[9])->get();
        $this->allBranches = Branch::all();
        $this->options = Option::where('type', 'opzionale')->where('registration_type_id', $this->courseRegistration->registration_type_id)->get();
        $this->costs = Option::where('type', 'fisso')->where('registration_type_id', $this->courseRegistration->registration_type_id)->get();
        $this->guides = Option::where('type', 'guide')->get();


        $branchCourse = $this->courseRegistration->branchCourses()->get();
        foreach ($branchCourse as $branch) {
            $this->selectedBranches[$branch->branch_id] = [
                'state' => true,
                'condition' => $branch->condition,
                'absences' => $branch->absences,
                'guides' => $branch->guides,
                'price' => $branch->price
            ];
        }
        foreach ($branchCourse as $branch) {
            $this->stateBranches[$branch->branch_id] = true;
        }

        $this->condition = $this->courseRegistration->condition;
        $this->selectedCosts = get_course($this->courseRegistration->course_id, $this->courseRegistration->variant_id)->getOptions()->where('type', 'fisso')->where('registration_type_id', $this->courseRegistration->registration_type_id)->pluck('option_id')->toArray();
        $this->selectedOptions = get_course($this->courseRegistration->course_id, $this->courseRegistration->variant_id)->getOptions()->where('type', 'opzionale')->where('registration_type_id', $this->courseRegistration->registration_type_id)->pluck('option_id')->toArray();
        $this->selectedGuide = get_course($this->courseRegistration->course_id, $this->courseRegistration->variant_id)->getOptions()->where('type', 'guide')->first()->id;
        $this->detailGuide = Option::find($this->selectedGuide);
        $this->selectedStepData = $this->courseRegistration->getSteps()->whereIn('id', [1,2])->first()->id;
        $this->selectedSteps = $this->courseRegistration->getSteps()->get()->whereNotIn('id',[1,2,9])->pluck('id')->toArray();
    }

    public function updated($property, $value) {
        if (Str::startsWith($property, 'stateBranches')) {
            $branchId = explode('.', $property);

            if ($this->selectedBranches[$branchId[1]] ?? false) {
                $this->selectedBranches[$branchId[1]]['state'] = !$this->selectedBranches[$branchId[1]]['state'];
            } else {
                $this->selectedBranches[$branchId[1]] = [
                    'state' => true,
                    'condition' => null,
                    'absences' => null,
                    'guides' => null,
                    'price' => null
                ];
            }
        }
        if ($property == 'selectedGuide') {
            $this->detailGuide = Option::find($value);
        }
    }

    public function save() {
        $this->selectedSteps[] = (Int)$this->selectedStepData;
        asort($this->selectedSteps);

        $this->selectedOptions[] = (Int)$this->selectedGuide;
        $options = array_merge($this->selectedCosts, $this->selectedOptions);
        asort($options);

        $this->courseForm->setCourseRegistrationType($this->courseRegistration->id);
        $this->courseForm->updateCourseRegistrationType($this->selectedSteps, $this->condition);
        $this->courseForm->updateBranchCourse($this->selectedBranches);
        $this->courseForm->updateOptionCourse($options);

        dd(
        'SelectedCost: ',$this->selectedCosts,
        'SelectedOption: ',$this->selectedOptions,
        'SelectedGuide: ', $this->selectedGuide,
        'options', $options
        );
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
