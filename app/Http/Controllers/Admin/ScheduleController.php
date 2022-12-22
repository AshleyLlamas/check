<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.schedules.edit')->only('edit');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function destroy(Schedule $schedule)
    {
        //
        return redirect()->route('admin.users.show', $schedule->user)->with('eliminar', 'ok');
    }
}
