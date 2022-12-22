<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReclutaController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.reclutas.index')->only('index');
        $this->middleware('can:admin.reclutas.edit')->only('edit');
        $this->middleware('can:admin.reclutas.create')->only('create');
    }
    
    public function index()
    {
        return view('admin.reclutas.index');
    }

    public function create()
    {
        return view('admin.reclutas.create');
    }

    public function edit(User $reclutum)
    {   

        //Laravel uso por default 'reclutum' como variable por el Route::resource

        return view('admin.reclutas.edit', [
            'user' => $reclutum //mandamos 'reclutum' como 'user'
        ]);
    }
}