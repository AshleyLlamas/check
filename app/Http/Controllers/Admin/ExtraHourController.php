<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExtraHour;
use Illuminate\Http\Request;

class ExtraHourController extends Controller
{
    public function index(){
        return view('admin.extra_hours.index');
    }

    public function show(ExtraHour $extraHour){
        return view('admin.extra_hours.show', compact('extraHour'));
    }

    public function create(){
        return view('admin.extra_hours.create');
    }

    public function edit(ExtraHour $extraHour){
        return view('admin.extra_hours.edit', compact('extraHour'));
    }

    public function destroy(ExtraHour $extraHour){

        $extraHour->delete();

        return view('admin.extra_hours.index')->with('eliminar', 'ok');
    }
}
