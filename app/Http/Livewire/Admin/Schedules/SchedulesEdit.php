<?php

namespace App\Http\Livewire\Admin\Schedules;

use Livewire\Component;

class SchedulesEdit extends Component
{
    public $schedule;
    
    public function render()
    {
        return view('livewire.admin.schedules.schedules-edit');
    }
}
