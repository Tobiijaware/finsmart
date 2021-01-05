<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendsms(Request $request){
       
        $message = $request['sms'];
        
        $bid = bid();
        $i=1;
        $data = DB::select("SELECT * FROM users WHERE bid = '$bid' " );
            foreach($data as $key){
                $recipient = $key->phone;
                sendSms($recipient,$message);

            }
        return;
        }
     
       
  
}
