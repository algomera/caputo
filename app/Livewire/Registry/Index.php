<?php

namespace App\Livewire\Registry;

use App\Models\Customer;
use App\Models\School;
use Livewire\Component;

class Index extends Component
{
    public $name = '';
    public $lastName = '';
    public $phone = '';
    public $code = '';

    public function show($customer) {
        return redirect()->route('registry.show', $customer);
    }

    public function render()
    {
        if (auth()->user()->id == 1) {
            $customers = Customer::with('school')
            ->filter('name', $this->name)
            ->filter('lastName', $this->lastName)
            ->filter('phone_1', $this->phone)
            ->whereHas('school', function($q) {
                $q->filter('code', $this->code);
            })
            ->get()->sortByDesc('id');
        } else {
            $school = School::find(auth()->user()->schools()->first()->id);
            $customers = $school->customers()
            ->filter('name', $this->name)
            ->filter('lastName', $this->lastName)
            ->filter('phone_1', $this->phone)
            ->get()->sortByDesc('id');
        }

        return view('livewire.registry.index', [
            'customers' => $customers
        ]);
    }
}
