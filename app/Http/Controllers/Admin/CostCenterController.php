<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.cost_centers.index')->only('index');
        $this->middleware('can:admin.cost_centers.edit')->only('edit');
        $this->middleware('can:admin.cost_centers.show')->only('show');
        $this->middleware('can:admin.cost_centers.create')->only('create');
        $this->middleware('can:admin.cost_centers.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.cost_centers.index');
    }

    public function create()
    {
        return view('admin.cost_centers.create');
    }

    public function show(CostCenter $cost_center)
    {
        return view('admin.cost_centers.show', compact('cost_center'));
    }

    public function edit(CostCenter $cost_center)
    {
        return view('admin.cost_centers.edit', compact('cost_center'));
    }

    public function destroy(CostCenter $cost_center)
    {
        $cost_center->delete();

        return redirect()->route('admin.cost_centers.index')->with('eliminar', 'ok');
    }
}
