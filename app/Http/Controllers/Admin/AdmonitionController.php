<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admonition;
use Illuminate\Http\Request;

class AdmonitionController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.admonitions.index')->only('index');
        $this->middleware('can:admin.admonitions.edit')->only('edit');
        $this->middleware('can:admin.admonitions.show')->only('show');
        $this->middleware('can:admin.admonitions.create')->only('create');
        $this->middleware('can:admin.admonitions.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.admonitions.index');
    }

    public function create()
    {
        return view('admin.admonitions.create');
    }

    public function show(Admonition $admonition)
    {
        return view('admin.admonitions.show', compact('admonition'));
    }

    public function edit(Admonition $admonition)
    {
        return view('admin.admonitions.edit', compact('admonition'));
    }

    public function destroy(Admonition $admonition)
    {
        $admonition->delete();

        return redirect()->route('admin.admonitions.index')->with('eliminar', 'ok');
    }
}
