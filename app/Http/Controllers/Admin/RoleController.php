<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.edit')->only('edit');
        $this->middleware('can:admin.roles.show')->only('show');
        $this->middleware('can:admin.roles.create')->only('create');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('eliminar', 'ok');
    }
}
