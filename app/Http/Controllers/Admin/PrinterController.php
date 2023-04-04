<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Printer;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.printers.index')->only('index');
        $this->middleware('can:admin.printers.edit')->only('edit');
        $this->middleware('can:admin.printers.show')->only('show');
        $this->middleware('can:admin.printers.create')->only('create');
        $this->middleware('can:admin.printers.destroy')->only('destroy');
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
