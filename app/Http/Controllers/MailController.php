<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use App\Mail\ForgotPassMail;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use Mail;

class MailController extends Controller
{
    // public function sendEmail(){
    //     $details = [
    //         'title' => 'Title:',
    //         'body' => 'Body: '
    //     ];

    //     \Mail::to('miketobicarter@gmail.com')->send(new SendMail($details));
    //     return view('admin/emailclients');
    // }

    public function send(Request $request){
       $this->validate($request, [
           'subject' => 'required',
           'message' => 'required'
       ]);

       $details = array(
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),

       );
       $bid = Auth::user()->bid;
       $getallmails = DB::select("SELECT * FROM users WHERE bid='$bid' AND is_user = 1");
       foreach( $getallmails as $mail){
        $allmail = $mail->email;
        Mail::to($allmail)->send(new \App\Mail\MyMail($details));
       
       }

                        

      
       return back()->with('success', 'Mail sent');
    }




    public function sendsingle(Request $request){
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);

        $bid = Auth::user()->bid;
        $userid = $request['sendUserEmail'];
        $details = array(
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),

       );
       $data = DB::select("SELECT * FROM users WHERE userid='$userid' AND bid='$bid' AND is_user = 1");
        foreach($data as $key){
            $mail = $key->email;
            Mail::to($mail)->send(new \App\Mail\MyMail($details));
        }
       
        return back()->with('success', 'Mail sent');
    }


    public function forgotpassword(Request $request){
        $email = $request['email'];
       
       $details = User::where('email',$email)->first(['email','userid','surname','othername','bid']);
       $time = time()+2*60*60;
       $reset = (int)substr(str_shuffle(str_repeat('123456789',10)),0,2);
       
      
       if(empty($details)){
        return back()->with('error', "This email doesn't exits on the system");
        }else{
         
            $update = DB::select("UPDATE users SET time='$time',reset='$reset' WHERE email='$email' AND bid='$details->bid' ");
   
            Mail::to($email)->send(new \App\Mail\ForgotPassMail($details));
     
        return back()->with('success', 'Please check your email for the password reset link');
        }
        
        }
}
