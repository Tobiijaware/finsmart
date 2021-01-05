<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
class forgotPasswordController extends Controller
{
    public function resetpage($userid){
        $id = decodeId($userid);
        //$bid = bid();
        $data = User::where('userid', $id)->first();
        return view('auth/resetpassword')->with('data', $data);
    }

    public function resetpassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:7', 'max:10'],
            'password1' => ['same:password'],
        ]);
        $email = $request['email'];
        $password = $request['password'];
        $password1 = $request['password1'];
            $pass =  Hash::make($password);
            $data = DB::select("SELECT email FROM users WHERE email='$email'");
            if(empty($data)){
                return back()->with('error','Please use the email you registered with');
            }else{
                $update = DB::select("UPDATE users SET password='$pass',reset=0,time=Null WHERE email='$email' ");
                return redirect('login')->with('success','Password Reset Successful');
            }

    }
}
