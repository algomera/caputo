<?php

namespace App\Livewire\Subscribers;

use Livewire\Component;

class Index extends Component
{
    public $name = '';
    public $lastName = '';
    public $phone = '';
    public $code = '';

    public function render()
    {
        return view('livewire.subscribers.index');
    }
}
