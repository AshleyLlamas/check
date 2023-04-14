<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.devices.index')->only('index');
        $this->middleware('can:admin.devices.edit')->only('edit');
        $this->middleware('can:admin.devices.show')->only('show');
        $this->middleware('can:admin.devices.create')->only('create');
        $this->middleware('can:admin.devices.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.devices.index');
    }

    public function create()
    {
        return view('admin.devices.create');
    }

    public function show(Device $device)
    {
        return view('admin.devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        return view('admin.devices.edit', compact('device'));
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('admin.devices.index')->with('eliminar', 'ok');
    }
}
