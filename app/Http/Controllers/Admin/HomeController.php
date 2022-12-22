<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assistance;
use App\Models\Check;
use App\Models\TimeCheck;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
        
        return view('admin.home');
    }
}
