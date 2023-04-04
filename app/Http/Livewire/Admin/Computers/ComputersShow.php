<?php

namespace App\Http\Livewire\Admin\Computers;

use Livewire\Component;

class ComputersShow extends Component
{
    public $computer;

    public function render()
    {
        return view('livewire.admin.computers.computers-show');
    }
}
