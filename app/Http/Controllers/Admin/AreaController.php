<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return view('admin.areas.index');
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function show(Area $area)
    {
        return view('admin.areas.show', compact('area'));
    }

    public function edit(Area $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')->with('eliminar', 'ok');
    }
}
