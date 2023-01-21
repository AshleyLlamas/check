<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.vacations.index')->only('index');
        $this->middleware('can:admin.vacations.edit')->only('edit');
        $this->middleware('can:admin.vacations.show')->only('show');
        $this->middleware('can:admin.vacations.create')->only('create');
        $this->middleware('can:admin.vacations.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.vacations.index');
    }

    public function create()
    {
        return view('admin.vacations.create');
    }

    public function show(Vacation $vacation)
    {
        return view('admin.vacations.show', compact('vacation'));
    }

    public function edit(Vacation $vacation)
    {
        return view('admin.vacations.edit', compact('vacation'));
    }
}
