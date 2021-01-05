<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\User;
use App\Flexible;
use Auth;
use App\Setup;
class AdminRegController extends Controller
{
    public function adminview(){
        return view('auth.adminregister');
    }

    public function adminloginview(){
      return view('auth.adminlogin');
    }

    public function win_hashs($length){
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz',$length)),0,$length);
    }

    public function adminRegistration(Request $request){

      $this->validate($request, [
          'password' => ['required', 'string', 'min:7', 'max:10'],
          'confirmpassword' => ['same:password'],
      ]);

        $admin = new User();
        $admin->bid = $this->win_hashs(5);
        $admin->userid = $this->win_hashs(8);
        $admin->surname = strtoupper($request['cname']);
        $admin->email = $request['email'];
        $admin->phone = $request['phone'];
        $admin->phone2 = $request['phone2'];
        $admin->bank = $request['bank'];
        $admin->accountno = $request['accno'];
        $admin->address = $request['address'];
        $admin->skey = $request['key'];
        $admin->accname = $request['accname'];
        $admin->password = Hash::make($request['password']);
        $admin->is_admin = 1;
        $admin->senderid = $request['senderid'];
        $admin->smskey = $request['smskey'];
        $admin->save();

        if($admin->save()){
            $setup = new Setup();
            $setup->bid = $admin->bid;
            $setup->userid = $admin->userid;
            $setup->phone = $admin->phone;
            $setup->phone2 = $admin->phone2;
            $setup->email = $admin->email;
            $setup->status = 1;
            $setup->company = $admin->surname;
            $setup->bank = $admin->bank;
            $setup->accno = $admin->accountno;
            $setup->address = $admin->address;
            $setup->accname = $admin->accname;
            $setup->save();

            if($setup->save()){

              $flexible = new Flexible();
              $flexible->bid = $admin->bid;
              $flexible->userid = $admin->userid;
              $flexible->status = 2;
              $flexible->l1 = 1;
              $flexible->l2 = 1;
              $flexible->l3 = 1;
              $flexible->l4 = 1;
              $flexible->l5 = 1;
              $flexible->l6 = 1;
              $flexible->s1 = 1;
              $flexible->s2 = 1;
              $flexible->s3 = 1;
              $flexible->s4 = 1;
              $flexible->i1 = 1;
              $flexible->i2 = 1;
              $flexible->i3 = 1;
              $flexible->i4 = 1;
              $flexible->i5 = 1;
              $flexible->rep = $admin->userid;
              $flexible->ctime = time();
              $flexible->o1 = 1;
              $flexible->o2 = 1;
              $flexible->o3 = 1;
              $flexible->o4 = 1;
              $flexible->o5 = 1;
              $flexible->o6 = 1;
              $flexible->save();
              if($flexible->save()){
                  $this->addreportstodb($admin->bid);
                return redirect('login')->with('success', 'Registration Successful');
              }else{
                return redirect('adminregister')->with('error', 'Registration Unsuccessful');
              }
            }else{
              return redirect('adminregister')->with('error', 'Registration Unsuccessful');
            }
        }else{
          return redirect('adminregister')->with('error', 'Registration Unsuccessful');
        }
  }



}
