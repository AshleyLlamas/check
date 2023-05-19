<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zkteco;
use Illuminate\Http\Request;

class ZktecoController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.zktecos.index')->only('index');
        $this->middleware('can:admin.zktecos.edit')->only('edit');
        $this->middleware('can:admin.zktecos.show')->only('show');
        $this->middleware('can:admin.zktecos.create')->only('create');
        $this->middleware('can:admin.zktecos.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.zktecos.index');
    }

    public function create()
    {
        return view('admin.zktecos.create');
    }

    public function show(Zkteco $zkteco)
    {
        return view('admin.zktecos.show', compact('zkteco'));
    }

    public function edit(Zkteco $zkteco)
    {
        return view('admin.zktecos.edit', compact('zkteco'));
    }

    public function destroy(Zkteco $zkteco)
    {
        $zkteco->delete();

        return redirect()->route('admin.zktecos.index')->with('eliminar', 'ok');
    }
}
