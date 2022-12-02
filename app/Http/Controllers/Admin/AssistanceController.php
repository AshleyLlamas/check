<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assistance;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    public function show(Assistance $assistance)
    {
        return view('admin.assistances.show', compact('assistance'));
    }
}
