<?php

namespace App\Http\Livewire;

use App\Models\Assistance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $users = User::whereHas('assistances', function($query) {
            $query->where('asistencia', '=', 'Inasistencia');
        })
        ->inRandomOrder()
        ->paginate();

            return view('livewire.home', [
                //'assistances' => $assistances
                'users' => $users
            ]);
    }
}
