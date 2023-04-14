<?php

namespace App\Http\Livewire\Admin\Devices;

use Livewire\Component;

class DevicesShow extends Component
{

    public $device;
    public function render()
    {
        return view('livewire.admin.devices.devices-show');
    }
}
