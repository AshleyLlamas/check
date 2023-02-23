<?php

namespace App\Http\Livewire\Admin\Inventories;

use App\Models\Electronic;
use Livewire\Component;

class InventoriesCreate extends Component
{
    public function render()
    {

        $electronic_all = Electronic::all()->count();

        return view('livewire.admin.inventories.inventories-create', [
            'electronic_all' => $electronic_all
        ]);
    }
}
