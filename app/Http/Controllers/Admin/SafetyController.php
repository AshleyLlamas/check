<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Safety;
use Illuminate\Http\Request;

class SafetyController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.safeties.index')->only('index');
        $this->middleware('can:admin.safeties.edit')->only('edit');
        $this->middleware('can:admin.safeties.show')->only('show');
        $this->middleware('can:admin.safeties.create')->only('create');
        $this->middleware('can:admin.safeties.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.safeties.index');
    }

    public function create()
    {
        return view('admin.safeties.create');
    }

    public function show(Safety $safety)
    {
        return view('admin.safeties.show', compact('safety'));
    }

    public function edit(Safety $safety)
    {
        return view('admin.safeties.edit', compact('safety'));
    }

    public function destroy(Safety $safety)
    {
        $safety->delete();

        return redirect()->route('admin.safeties.index')->with('eliminar', 'ok');
    }
}
