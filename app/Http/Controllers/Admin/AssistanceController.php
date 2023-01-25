<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assistance;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.assistances.index')->only('index');
        $this->middleware('can:admin.assistances.show')->only('show');
    }

    public function index()
    {
        return view('admin.assistances.index');
    }

    public function show(Assistance $assistance)
    {
        return view('admin.assistances.show', compact('assistance'));
    }
}
