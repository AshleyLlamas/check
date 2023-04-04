<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
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
        return view('admin.inventories.index');
    }

    public function create()
    {
        return view('admin.inventories.create');
    }

    public function show(Inventory $inventory)
    {
        return view('admin.inventories.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventories.edit', compact('inventory'));
    }

    public function destroy(Inventory $inventory)
    {

        switch($inventory->inventariable_type){
            case 'App\Models\Electronic':
                $inventory->inventariable->electronicable->delete();
                //ES ELECTRONICO
                $inventory->inventariable->delete(); //Eliminar la categoria (ELECTRONICO)
                $inventory->delete(); //Eliminar inventario
            break;
        }

        return redirect()->route('admin.inventories.index')->with('eliminar', 'ok');
    }
}
