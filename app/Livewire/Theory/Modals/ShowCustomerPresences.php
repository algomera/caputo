<?php

namespace App\Livewire\Theory\Modals;

use App\Models\Customer;
use App\Models\Training;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class ShowCustomerPresences extends ModalComponent
{
    public $training;
    public $customer;
    public $lessons;
    public $presences;
    public $totalPresences = 0;

    public function mount($training, $customer) {
        $this->training = Training::find($training);
        $this->customer = Customer::find($customer);
        $registration = $this->training->registrations()->where('customer_id', $this->customer->id)->first();

        if ($this->training->variant_id) {
            $this->lessons = $this->training->courseVariant->lessons()->get();
            $this->presences = DB::table('presences')
            ->join('lesson_plannings', 'presences.lesson_planning_id', 'lesson_plannings.id')
            ->join('lessons', 'lesson_plannings.lesson_id', '=', 'lessons.id')
            ->join('course_variants', 'lessons.variant_id', '=', 'course_variants.id')
            ->join('trainings', 'lesson_plannings.training_id', '=', 'trainings.id')
            ->join('registrations', 'trainings.id', '=', 'registrations.training_id')
            ->join('customers', 'registrations.customer_id', '=', 'customers.id')
            ->where('registrations.customer_id', $this->customer->id)
            ->where('registrations.id', $registration->id)
            ->where('presences.customer_id', $this->customer->id)
            ->select('presences.*','lesson_plannings.begin', 'lesson_plannings.lesson_id')
            ->get();
        } else {
            $this->lessons = $this->training->course->lessons()->get();
            $this->presences = DB::table('presences')
            ->join('lesson_plannings', 'presences.lesson_planning_id', 'lesson_plannings.id')
            ->join('lessons', 'lesson_plannings.lesson_id', '=', 'lessons.id')
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('trainings', 'lesson_plannings.training_id', '=', 'trainings.id')
            ->join('registrations', 'trainings.id', '=', 'registrations.training_id')
            ->join('customers', 'registrations.customer_id', '=', 'customers.id')
            ->where('registrations.customer_id', $this->customer->id)
            ->where('registrations.id', $registration->id)
            ->where('presences.customer_id', $this->customer->id)
            ->select('presences.*','lesson_plannings.begin', 'lesson_plannings.lesson_id')
            ->get();
        }

        foreach ($this->presences as $presence) {
            if ($presence->followed) {
                $this->totalPresences += 1;
            }
        }
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-screen-xl 2xl:max-w-screen-2xl';
    }

    public function render()
    {
        return view('livewire.theory.modals.show-customer-presences');
    }
}
