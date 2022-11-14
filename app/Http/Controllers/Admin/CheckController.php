<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Check;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index()
    {
        return view('admin.checks.index');
    }

    public function show(Check $check)
    {
        return view('admin.checks.show', compact('check'));
    }
}
