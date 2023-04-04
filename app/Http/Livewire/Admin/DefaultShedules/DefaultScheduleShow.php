<?php

namespace App\Http\Livewire\Admin\DefaultShedules;

use Livewire\Component;

class DefaultScheduleShow extends Component
{
    public $default_schedule;

    public function render()
    {
        return view('livewire.admin.default-shedules.default-schedule-show');
    }
}
