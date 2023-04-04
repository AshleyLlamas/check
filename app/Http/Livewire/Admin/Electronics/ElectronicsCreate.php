<?php

namespace App\Http\Livewire\Admin\Electronics;

use App\Models\Computer;
use App\Models\Printer;
use Livewire\Component;

class ElectronicsCreate extends Component
{
    public function render()
    {
        $printers_all = Printer::all()->count();

        $computers_all = Computer::all()->count();

        return view('livewire.admin.electronics.electronics-create', [
            'printers_all' => $printers_all,
            'computers_all' => $computers_all
        ]);
    }
}
