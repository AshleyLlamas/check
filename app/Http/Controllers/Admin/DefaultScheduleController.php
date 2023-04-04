<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultSchedule;
use Illuminate\Http\Request;

class DefaultScheduleController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.default_schedules.index')->only('index');
        $this->middleware('can:admin.default_schedules.edit')->only('edit');
        $this->middleware('can:admin.default_schedules.show')->only('show');
        $this->middleware('can:admin.default_schedules.create')->only('create');
        $this->middleware('can:admin.default_schedules.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.default_schedules.index');
    }

    public function create()
    {
        return view('admin.default_schedules.create');
    }

    public function show(DefaultSchedule $default_schedule)
    {
        return view('admin.default_schedules.show', compact('default_schedule'));
    }

    public function edit(DefaultSchedule $default_schedule)
    {
        return view('admin.default_schedules.edit', compact('default_schedule'));
    }

    public function destroy(DefaultSchedule $default_schedule){

        $default_schedule->delete();

        return view('admin.default_schedules.index')->with('eliminar', 'ok');
    }
}
