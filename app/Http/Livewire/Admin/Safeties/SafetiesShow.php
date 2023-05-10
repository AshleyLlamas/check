<?php

namespace App\Http\Livewire\Admin\Safeties;

use App\Models\Safety;
use Livewire\Component;

class SafetiesShow extends Component
{
    public $safety;

    public function mount(Safety $safety){
        $this->safety = $safety;
    }

    public function render()
    {
        return view('livewire.admin.safeties.safeties-show');
    }
}
