<?php

// use Auth;
// use DB;
function bid(){
    return Auth::user()->bid;
}

function checktransaction($userid){
    $bid = bid();
    $data = DB::select("SELECT * FROM loan WHERE userid='$userid' AND bid='$bid'");
    $data1 = DB::select("SELECT * FROM invacc WHERE userid='$userid' AND bid='$bid'");
    $data2 = DB::select("SELECT * FROM savings WHERE userid='$userid' AND bid='$bid'");
    if(count($data)>0 or count($data1)>0 or count($data2)>0){
        return TRUE;
    }else{
        return FALSE;
    }


}

 function uName($userid,$col=''){
    $sql = DB::select("SELECT * FROM users WHERE userid='$userid' ");
    foreach($sql as $row){
        $res = empty($col) ? $row->surname.' '.$row->othername : $row->$col;
        return $res;
    }
}


function formatPhone($phone){
    if(substr($phone, 0,1)=='0'){$phone = '234'.substr($phone, 1,10); }
    elseif(substr($phone, 0,1)=='+'){$phone = substr($phone, 1,13); }
    return trim($phone);
  }

function sendSms($recipient,$message){
    $smskey = Auth::user()->smskey;
    $senderid = Auth::user()->senderid;
    $route = Auth::user()->route;
    $recipient=formatPhone($recipient);
    $message=urlencode($message);
    $sender=urlencode($senderid);

    $api = 'https://flexrecharge.com/api/v1/http.php?api_key='.$smskey.'&recipient='.$recipient.'&message='.$message.'&sender='.$sender.'&route='.$route;
    $send = file($api);

    return;
}


function getStaff($userid){
    $bid = bid();
    $data = DB::select("SELECT * FROM users WHERE userid='$userid' AND bid = '$bid'");
    foreach ($data as $key){
        $surname = $key->surname;
        $othername = $key->othername;
    }
    return $surname.' '.$othername;
}

function Role($userid){
    $bid = bid();
    $data = DB::select("SELECT * FROM staffs WHERE userid='$userid' AND bid = '$bid'");
    foreach ($data as $key){
        $role = $key->staffrole;

    }
    return $role;
}

function Payroll($userid){
    $bid = bid();
    $data = DB::select("SELECT * FROM staffs WHERE userid='$userid' AND bid = '$bid'");
    foreach ($data as $key){
        $payroll = $key->payroll;

    }
    return $payroll;
}

function hashId($id){
    $hash = substr(str_shuffle(str_repeat('abcdefghi.jklmnopqr.stuvwxyz12345.67890adcvbt123',100)),1,100);
    $value = $hash.'.'.$id;
    return $value;
}

function decodeId($id){
    $ids = explode('.', $id);
    $value = end($ids);
    return $value;
}

function Status($userid){
    $bid = bid();
    $data = DB::select("SELECT * FROM staffs WHERE userid='$userid' AND bid = '$bid'");
    foreach ($data as $key){
        $status = $key->status;

    }
    if($status==1){
        return "<p style='color:green;'>Active</p>";
    }else{
    return "<p style='color:red;'>Inactive</p>";
    }
}


function reportCheck($sn,$col=''){
    $bid = bid();
    $query = DB::select("SELECT * FROM reports WHERE sn='$sn' AND bid='$bid'");
    foreach($query as $key){
        return $key->$col;
    }

}


 function Reports($code,$amt=0){
      $r='';
      $bid = bid();
      $data = DB::select("SELECT * FROM reports WHERE bid = '$bid' AND active=1 AND type=$code ");
      foreach($data as $key) {
          $r = $key->title;
          $sms = $key->sms;
          //Debits all types from clients
          //if($code==1){  $r; }
          return $amt==0 ? $r : $sms;
     }



//            elseif($code==2){ echo $r; }
//            elseif($code==3){ echo $r; }

        }



?>
