<?php

namespace App\Http\Livewire\Admin\Admonitions;

use Livewire\Component;

class AdmonitionsShow extends Component
{
    public $admonition;
    
    public function render()
    {
        return view('livewire.admin.admonitions.admonitions-show');
    }
}
