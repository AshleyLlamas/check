<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
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
        return view('admin.printers.index');
    }

    public function create()
    {
        return view('admin.printers.create');
    }

    public function show(Printer $printer)
    {
        return view('admin.printers.show', compact('printer'));
    }

    public function edit(Printer $printer)
    {
        return view('admin.printers.edit', compact('printer'));
    }

    public function destroy(Printer $printer)
    {
        $printer->delete();

        return redirect()->route('admin.printers.index')->with('eliminar', 'ok');
    }
}
