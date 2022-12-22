<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Check;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.checks.index')->only('index');
        $this->middleware('can:admin.checks.show')->only('show');
    }

    public function index()
    {
        return view('admin.checks.index');
    }

    public function show(Check $check)
    {
        return view('admin.checks.show', compact('check'));
    }
}
