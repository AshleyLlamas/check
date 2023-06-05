<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    // public function __construct(){
    //     $this->middleware('can:admin.phones.index')->only('index');
    //     $this->middleware('can:admin.phones.edit')->only('edit');
    //     $this->middleware('can:admin.phones.show')->only('show');
    //     $this->middleware('can:admin.phones.create')->only('create');
    //     $this->middleware('can:admin.phones.destroy')->only('destroy');
    // }

    public function index()
    {
        return view('admin.phones.index');
    }

    public function create()
    {
        return view('admin.phones.create');
    }

    public function show(Phone $phone)
    {
        return view('admin.phones.show', compact('phone'));
    }

    public function edit(Phone $phone)
    {
        return view('admin.phones.edit', compact('phone'));
    }

    public function destroy(Phone $phone)
    {
        $phone->delete();

        return redirect()->route('admin.phones.index')->with('eliminar', 'ok');
    }
}
