<?php

namespace App\Exports;

use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersWithoutPuestoExport implements FromView
{
    public function view(): View
    {
        return view('exports.usersWithoutPuesto', [
            'users' => User::where('puesto', null)->get()
        ]);
    }
}
