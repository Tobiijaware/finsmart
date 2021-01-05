<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;


class RegController extends Controller
{
    //
    public function win_hashs($length){
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz',$length)),0,$length);	
        }

    public function Registration(Request $request){
          $user = new User();
          $user->bid = $this->win_hashs(5);
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
          $user->save();

          return redirect()->intended(route('login'));
    }
}
