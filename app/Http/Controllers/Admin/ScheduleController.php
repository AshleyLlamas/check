<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultSchedule;
use App\Models\Schedule;
use App\Models\User;
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
        //$schedule->delete();

        $schedule->actual = false;
        $schedule->save();

        switch($schedule->scheduleble_type){
            case User::class:
                return redirect()->route('admin.users.show', $schedule->scheduleble)->with('eliminar', 'ok');
            break;
            case DefaultSchedule::class:
                return redirect()->route('admin.default_schedules.show', $schedule->scheduleble)->with('eliminar', 'ok');
            break;
            default:
                return redirect()->route('admin.users.index');
            break;
        }
    }
}
