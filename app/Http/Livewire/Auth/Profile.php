<?php

namespace App\Http\Livewire\Auth;

use App\Models\Check;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination;

    public $user;

    protected $paginationTheme = "bootstrap";
    
    public function render()
    {
        return view('livewire.auth.profile', [
            "checks" => Check::Where("user_id", $this->user->id)->orderBy('fecha', 'desc')->paginate(10)
        ]);
    }
}
