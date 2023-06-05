<?php

namespace App\Exports;

use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersCompletedExport implements FromView
{
    public function view(): View
    {
        return view('exports.usersWithoutPuesto', [
            'users' => User::where('tipo', 'Empleado')->where('puesto', '!=', null)->has('image')->get()
        ]);
    }
}
