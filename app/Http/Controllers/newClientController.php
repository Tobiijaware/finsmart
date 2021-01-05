<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\RegMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Mail;

class newClientController extends Controller
{
    public function win_hashs($length){
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz',$length)),0,$length);	
    }
   
    public function AddnewUser(Request $request){
        $validate =  Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validate();

        $skey = Auth::user()->skey;
        $pkey = Auth::user()->pkey;
        //return $skey;

        $user = new User();
        $user->bid = auth()->user()->bid;
        $user->userid = $this->win_hashs(8);
        $user->surname = $request['surname'];
        $user->othername = $request['othername'];
        $user->sex = $request['sex'];
        $user->email = $request['email'];
        $user->state = $request['state'];
        $user->is_user = 1;
        $user->city = $request['city'];
        $user->address = $request['address'];
        $user->address2 = $request['address2'];
        $user->birthday = $request['birthday'];
        $user->accname = $request['accname'];
        $user->bank = $request['bank'];
        $user->accountno = $request['accountno'];
        $user->bvn = $request['bvn'];
        $user->ctime = time();
        $user->name = $request['name'];
        $user->password = Hash::make($request['password']);
        $user->phone = $request['phone'];
        $user->phone2 = $request['phone2'];  
        $user->pkey = $pkey;
        $user->skey = $skey;
      

        $email = $user->email;
        // return $email;
        // $sql = DB::table('users')->where('email', $email)->get();
        // if(count($sql)==1){
        // return redirect('newclient')->with('error', 'Email Already Exists');
        // }else{
        $user->save();
        $details = User::where('email',$email)->first(['email','userid','surname','othername','bid']);
        $time = time()+2*60*60;
        $reset = 1;
        //return $details;

        if($user->save()){
            Mail::to($email)->send(new \App\Mail\RegMail($details));
            $update = DB::select("UPDATE users SET time1='$time',reset1='$reset' WHERE email='$email' AND bid='$details->bid'");
            return back()->with('success', 'Client Added Succesfully');
        }else{
            return redirect('newclient')->with('error', 'New Record Not Added');
        }
       
       
   // }    
  }

  public function verify(Request $request){
    $id = $request['Verify'];
    $email = $request['email'];
    $password = Hash::make($request['password']);
    $data = DB::select("SELECT * FROM users WHERE userid='$id'");
    $reset = 2;
    $ctime = time();
    foreach($data as $key){
        $email1 = $key->email;
        $bid = $key->bid;
    }
    if(empty($email)){
        return back()->with('error', 'email cannot be empty');
    }elseif($email != $email1){
        return back()->with('error', "email doesn't match");
    }else{
    $data = DB::select("UPDATE users SET password='$password',reset1='$reset',time1='$ctime' WHERE userid='$id' AND bid='$bid'");
    return redirect('login')->with('success', 'Verification Successful');
    }
}

    public function verification($userid){
        $id = decodeId($userid);
        //$bid = bid();
        $data = User::where('userid', $id)->first();
        return view('auth/userverification')->with('data', $data);
    }

}
