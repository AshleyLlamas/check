<?php

namespace App\Http\Livewire\Admin\Printers;

use Livewire\Component;

class PrintersShow extends Component
{
    public $printer;

    public function render()
    {
        return view('livewire.admin.printers.printers-show');
    }
}
