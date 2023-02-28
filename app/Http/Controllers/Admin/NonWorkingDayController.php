<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NonWorkingDay;
use Illuminate\Http\Request;

class NonWorkingDayController extends Controller
{
    public function index(){
        return view('admin.calendars.index');
    }

    public function create(){
        return view('admin.calendars.create');
    }

    public function edit(NonWorkingDay $nonWorkingDay){
        return view('admin.calendars.edit', compact('nonWorkingDay'));
    }

    public function destroy(NonWorkingDay $nonWorkingDay){

        $nonWorkingDay->delete();

        return view('admin.calendars.index')->with('eliminar', 'ok');
    }
}
