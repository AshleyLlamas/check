<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmonitionType;
use Illuminate\Http\Request;

class AdmonitionTypeController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.admonition_types.index')->only('index');
        $this->middleware('can:admin.admonition_types.edit')->only('edit');
        $this->middleware('can:admin.admonition_types.show')->only('show');
        $this->middleware('can:admin.admonition_types.create')->only('create');
        $this->middleware('can:admin.admonition_types.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.admonition_types.index');
    }

    public function create()
    {
        return view('admin.admonition_types.create');
    }

    public function show(AdmonitionType $admonition_type)
    {
        return view('admin.admonition_types.show', compact('admonition_type'));
    }

    public function edit(AdmonitionType $admonition_type)
    {
        return view('admin.admonition_types.edit', compact('admonition_type'));
    }

    public function destroy(AdmonitionType $admonition_type)
    {
        $admonition_type->delete();

        return redirect()->route('admin.admonition_types.index')->with('eliminar', 'ok');
    }
}
