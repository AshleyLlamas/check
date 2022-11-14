<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Profile extends Component
{
    public $user;
    
    public function render()
    {
        return view('livewire.auth.profile');
    }
}
