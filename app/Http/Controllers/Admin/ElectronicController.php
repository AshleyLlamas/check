<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Electronic;
use Illuminate\Http\Request;

class ElectronicController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.inventories.index')->only('index');
        $this->middleware('can:admin.inventories.edit')->only('edit');
        $this->middleware('can:admin.inventories.show')->only('show');
        $this->middleware('can:admin.inventories.create')->only('create');
        $this->middleware('can:admin.inventories.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.electronics.index');
    }

    public function create()
    {
        return view('admin.electronics.create');
    }

    public function show(Electronic $electronic)
    {
        return view('admin.electronics.show', compact('electronic'));
    }

    public function edit(Electronic $electronic)
    {
        return view('admin.electronics.edit', compact('electronic'));
    }

    public function destroy(Electronic $electronic)
    {
        $electronic->delete();

        return redirect()->route('admin.electronics.index')->with('eliminar', 'ok');
    }
}
