<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginAdmin(Request $request){

        $loginData = $request->validate([
           'email' => 'email|required',
           'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return redirect('login')->with('error', 'Invalid Credentials');
        }elseif(auth()->user()->is_admin == 1){
            $userid = auth()->user()->userid;
            $request->session()->put('userid', $userid);
            return redirect('admindashboard')->with('success', 'Welcome Back');
        }else{
            return redirect('dashboard')->with('success','Welcome Back');
        }
    }
}
