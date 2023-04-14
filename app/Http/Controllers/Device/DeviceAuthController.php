<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeviceAuthController extends Controller
{
    public function getLogin(){
        return view('device.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('device')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('device')->user();
            return redirect()->route('deviceCheck')->with('success','You are Logged in sucessfully.');
            // if($user->is_device == 1){
            //     return redirect()->route('deviceCheck')->with('success','You are Logged in sucessfully.');
            // }
        }else {
            return back()->with('error','Estas credenciales no coinciden con nuestros registros.');
        }
    }

    public function deviceLogout(Request $request)
    {
        auth()->guard('device')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('deviceLogin'));
    }
}
