<?php
function win_hash($length)
{
    return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);
}

  function walletProcess($bid,$id,$amt,$status,$type,$ctime,$ref,$remark=''){
        $rep = auth()->user()->userid;
        $ctime = $ctime=='' ? time() : $ctime;
        $amt = ($type>10) ? $amt : '-'.$amt;
        $mm = date('m',$ctime);
        $yy = date('y',$ctime);
        $trno = win_hash(10);
         if(empty($id) OR $id=='' OR $id=='0'){}
         else{
        $sql = DB::select("INSERT INTO ewallet (bid,userid,trno,cos,type,status,ctime,mm,yy,rep,ref,remark) VALUES
        ('$bid','$id','$trno','$amt','$type','$status','$ctime','$mm','$yy','$rep','$ref','$remark') ");

        }
        return;
    }




function penaltyfee(){
    $id = Auth::user()->userid;
    $bid = bid();
    $ctime= time();
    $remark='Penalty Fee';
    $ref = win_hash(10);
    $data = DB::select("SELECT * FROM loan WHERE userid = '$id' AND bid='$bid'");
    foreach($data as $key){
        $status = $key->status;
        $stop = $key->stop;
        $amt = $key->penaltyfee;
        $loanref = $key->ref;
    }
    if(empty($data) ){
        return FALSE;
    }

    elseif($status == 4 AND time() > $stop){

        $amt2 = ($amt == '-')?0:$amt;
        walletProcess($bid, $id, $amt, 30, 10, $ctime, $loanref, $remark);
        DB::select("INSERT INTO loan (ref,bid,userid,amount,start,status,type,rep) VALUES ('$loanref','$bid','$id','$amt2','$ctime',4,9,'$id')");
        return response(['success' => 'Operation Successful'], 200);

//        if($amt == '-'){
//            //$type = 10;
//        }else{
//
//        }
    }

}


?>
