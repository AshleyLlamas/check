<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.computers.index')->only('index');
        $this->middleware('can:admin.computers.edit')->only('edit');
        $this->middleware('can:admin.computers.show')->only('show');
        $this->middleware('can:admin.computers.create')->only('create');
        $this->middleware('can:admin.computers.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.computers.index');
    }

    public function create()
    {
        return view('admin.computers.create');
    }

    public function show(Computer $computer)
    {
        return view('admin.computers.show', compact('computer'));
    }

    public function edit(Computer $computer)
    {
        return view('admin.computers.edit', compact('computer'));
    }

    public function destroy(Computer $computer)
    {
        $computer->delete();

        return redirect()->route('admin.computers.index')->with('eliminar', 'ok');
    }
}
