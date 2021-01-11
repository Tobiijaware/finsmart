<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);
    }

    public function terminationDate($ref)
    {
    $sql=DB::select("SELECT * FROM ewallet WHERE ref='$ref' ORDER BY id DESC LIMIT 1");
        foreach($sql as $row){
            return $row->ctime;
            }
    }

    public function walletLoan($userid,$ref,$opt)
    {

        $sql = DB::table('ewallet')
            ->where('userid', $userid)
            ->where('ref', $ref)
            ->where('type', $opt)
            ->sum('cos');
        return $sql;

    }

    public function walletLoa($userid,$ref,$opt)
    {

        $sql=DB::select("SELECT SUM(cos) AS value_sum FROM ewallet WHERE userid = '$userid' AND ref='$ref' AND type='$opt' ");
        foreach($sql as $row){
            $amt = $row->value_sum;
            return abs($amt);
          }
    }

    public function savingsDeposit($ref)
    {
      $sql = DB::table('ewallet')
      ->where('ref', $ref)
      ->where('type', 14)
      ->sum('cos');
      return abs($sql);
    }


    public function totalSavInt($ref){
      $rate = $this->saveName($ref,'rate');
      $sum=0;
      $sql=DB::select("SELECT * FROM ewallet WHERE ref='$ref'");
      foreach($sql as $s){
        $month = floor(abs(time()-$s->ctime)/(60*60*24*30));
        $sum  += $s->cos*$rate*$month/100;
        return $sum;
      }

    }

    function invName($ref,$col='amount'){
        $sql=DB::select("SELECT * FROM invacc WHERE ref='$ref' ");
        foreach($sql as $row){
            return $row->$col;
          }
    }

    public function totalInvInt($ref){
        $rate = $this->invName($ref,'rate');
        $sum=0;
        $sql=DB::select("SELECT * FROM ewallet WHERE ref='$ref'");
        foreach($sql as $row){
          $month = floor(abs(time()-$row->ctime)/(60*60*24*30));
          $sum  += $row->cos*$rate*$month/100;
      }
        return $sum;
      }

      public function Repayment($ref,$opt){
        $sql=DB::select("SELECT * FROM ewallet WHERE ref='$ref' AND type='$opt' " );
        foreach($sql as $row){
           return $row;
        }
      }

      public function set2Name($productkey,$col=''){
        $sql=DB::select("SELECT * FROM productsetup WHERE id='$productkey' " );
        foreach($sql as $row){
           return $row->$col;
        }
      }

      public function loanName($trno,$opt=''){
          $sql=DB::select("SELECT * FROM loan WHERE ref='$trno' ");
          foreach($sql as $row){
            return $row->$opt;
         }
      }

      public function saveName($trno,$opt=''){
        $sql=DB::select("SELECT * FROM savings WHERE ref='$trno' ");
        foreach($sql as $row){
          return $row->$opt;
       }
    }

    function saveNam($ref,$col='amount'){
      $sql = DB::select("SELECT * FROM savings WHERE ref='$ref' ");
      foreach($sql as $row){
        return $row->$col;
     }
    }

      public function expectedCycles($ref){
        $start = $this->saveName($ref,'start');
        $period = $this->saveName($ref,'period');
        $cycle = ceil(abs(time()-$start)/(60*60*24*$period));
        return $cycle;
     }

      public function uName($userid,$col=''){
        $sql = DB::select("SELECT * FROM users WHERE userid='$userid' ");
        foreach($sql as $row){
        $res = empty($col) ? $row->surname.' '.$row->othername : $row->$col;
        return $res;
        }
      }

      function cardLinked($userid){
        $sql = DB::select("SELECT * FROM robject WHERE userid='$userid' AND status=1 AND reset=1 ");
        $res = (count($sql) ==0 ) ? 'NO' : 'YES';
        return $res;
      }

     public function loanStatus($status)
      {
          if($status==1 OR $status==0){$r='<p style="color:red;">Awaiting Approval</p>'; }
          //elseif($status==2){$r='<p color="blue">Approved</p>'; }
          elseif($status==3){$r='<p style="color:blue;">Awaiting Disbursement</p>'; }
          elseif($status==4){$r='<p style="color:green;">Loan Disbursed</p>'; }
          elseif($status==5){$r='<p style="color:darkgreen;">Loan Repaid</p>'; }
          else{$r='Suspended';}
          return $r;
      }

      public function savingsStatus($status)
      {
        if($status==1){$r='<font color="red">Awaiting First Deposit</font>'; }
        elseif($status==2){$r='<font color="blue">Active Savings </font>'; }
        elseif($status==3){$r='<font color="green">Savings Liquidated</font>'; }
        else{$r='Complicated';}
        return $r;
      }

      public function invStatus($status)
      {
          if($status==1 OR $status==0){$r='<font color="red">Awaiting Approval</font>'; }
          elseif($status==2){$r='<font color="blue"> Approved. Awaiting Payment </font>'; }
          elseif($status==3){$r='<font color="#036">Activated</font>'; }
          elseif($status==4){$r='<font color="green">Terminated</font>'; }
          else{$r='Suspended';}
          return $r;
      }

      public function loanExpiryDate($ref){
        $sql=DB::select("SELECT * FROM loantranch WHERE ref='$ref'" );
           foreach($sql as $Loanexpire){
            return $Loanexpire->start;
           }

      }

      public function adminName($id,$col=''){
        $sql = DB::select("SELECT * FROM flexible WHERE userid='$id' ");
        foreach($sql as $row){
          return $row->$col;
        }
      }

      function topupStart($id){
        $sql = DB::select("SELECT * FROM loantranch WHERE userid='$id' ORDER BY sn DESC LIMIT 1 ");
        foreach($sql as $row){
          return $row->start;
        }
      }

      public function addLoanTranch($ref){
        $tenure = $this->loanName($ref,'tenure')/30;
        $tranch = $this->loanName($ref,'tranch');
        $id = $this->loanName($ref,'userid');
        $loan = $this->loanName($ref,'amount');
        $start = $this->loanName($ref,'start');
        $sql = DB::select("DELETE FROM loantranch WHERE ref='$ref' ");

        if($this->loanName($ref,'type')==5){
         $start = $this->topupStart($id);
        }
        $i=1;
        $data = DB::table('loan')->get()->where('ref', $ref);
        foreach($data as $rep){
            $bid = $rep->bid;
        }
        while($i<=$tenure){
         $e = $i++; $start += 60*60*24*30;
          $mm = date('ym',$start);

        $sqll = DB::select("INSERT INTO loantranch (bid,userid,ref,loan,tranch,start,mm,instal)
       VALUES ('$bid','$id','$ref','$loan','$tranch','$start','$mm','$e') ");
      }
      return;
      }

      public function wallet($id,$opt=0)
      {
        $amt = 0;
        $sql = ($opt==0) ? DB::select("SELECT SUM(cos) AS value_sum FROM ewallet WHERE userid = '$id' AND type<21 ") :
        DB::select("SELECT SUM(cos) AS value_sum FROM ewallet WHERE userid = '$id' AND type='$opt' ");
         foreach($sql as $row){
        return $row->value_sum;
         }
      }

      function invDeposit($ref)
      {
          $amt = 0;
          $sql =  DB::select("SELECT SUM(cos) AS value_sum FROM ewallet WHERE ref='$ref' AND type=18 ") ;
          foreach($sql as $row){
            return $row->value_sum;
          }
      }

      public function rem($total,$tranch,$paid){
        if($paid>=$total){$res = 100;}
        elseif($total-$paid<$tranch){$res =  100-(100*($total-$paid)/$tranch);}
        else{$res=0;}
        return number_format($res,2);
    }


    public function walletPro2($refs,$bid,$id,$type,$amount,$interest,$profee,$remark){
        $rep = Auth::user()->userid;
        $ctime = time();
        $amount = ($type>10) ? $amount : '-'.$amount;
        if(empty($id) OR $id=='' OR $id=='0'){}
        else {
            $sql = DB::select("INSERT INTO ewallet2 (ref,bid,userid,type,amount,interest,profee,ctime,rep,remark) VALUES
        ('$refs','$bid','$id','$type','$amount','$interest','$profee','$ctime','$rep','$remark') ");
        }
        return;
    }

      public function walletProcess($bid,$id,$amt,$status,$type,$ctime,$ref,$remark=''){
        $rep = auth()->user()->userid;
        $ctime = $ctime=='' ? time() : $ctime;
        $amt = ($type>10) ? $amt : '-'.$amt;
        $mm = date('m',$ctime);
        $yy = date('y',$ctime);
        $trno = $this->win_hash(10);
         if(empty($id) OR $id=='' OR $id=='0'){}
         else{
        $sql = DB::select("INSERT INTO ewallet (bid,userid,trno,cos,type,status,ctime,mm,yy,rep,ref,remark) VALUES
        ('$bid','$id','$trno','$amt','$type','$status','$ctime','$mm','$yy','$rep','$ref','$remark') ");
               $bal = $this->wallet($id);
               $sms = ($type>10) ? 'CR: NGN' : 'DR: NGN';
               $sms .= number_format(abs($amt),2).'
               Acct No: '.$this->uName($id,'keyy').'
               Desc: '.$this->walletRemark($type).'
               Date: '.date('d/m/Y',$ctime).'
               Available Bal: NGN'.number_format(abs($bal),2).'
               Total Bal: NGN'.number_format(abs($bal),2);
               $phone = $this->uName($id,'phone');
              // sendSms($phone,$sms);
        }
        return;
    }

    public function walletRemark($code,$amt=0){
      $r='';
            //Debits all types from clients
                if($code==1){$r='Company Expenses'; $sms=''; }
            elseif($code==2){$r=''; }
            elseif($code==3){$r='Investment Interest'; $sms='You have earned an interest of NGN'.number_format($amt,2).' on your investment';  }
            elseif($code==4){$r='Investment Full Liquidation'; $sms='Your investment of NGN'.number_format($amt,2).' has been successflly liquidated'; }
            elseif($code==5){$r='Savings Partial Liquidation'; }
            elseif($code==6){$r='Investment Partial Liquidation'; }
            elseif($code==7){$r=''; }
            elseif($code==8){$r='Savings Interest'; $sms='You have earned an interest of NGN'.number_format($amt,2).' on your savings';   }
            elseif($code==9){$r='Savings Full Liquidation'; $sms='Your savings of NGN'.number_format($amt,2).' has been successflly liquidated';  }
            elseif($code==10){$r='Disbursed Loan';  $sms='Your loan request of NGN'.number_format($amt,2).' has been processed and disbursed to you';  }

            //Credit: Wallet Funding
            elseif($code==11){$r='Loan Capital Repayment'; $sms='Your loan capital repayment of NGN'.number_format($amt,2).' was received and your account updated accordingly';  }
            //elseif($code==12){$r='Excess in Loan Repayment';   }
            elseif($code==13){$r=''; }
            elseif($code==14){$r='Savings Deposit';  $sms='Your savings deposit of NGN'.number_format($amt,2).' was received and your account updated accordingly';  }
            //elseif($code==15){$r='Loan Holiday Cost';  $sms='Your loan holiday has been approved and processed at a fee of NGN'.number_format($amt,2).' and your account has been updated accordingly';   }
            elseif($code==16){$r='Interest on Loan'; $sms='Your loan interest repayment of NGN'.number_format($amt,2).' was received and your account updated accordingly'; }
            elseif($code==17){$r='VAT on Investment Interest';  $sms='A total of NGN'.number_format($amt,2).' was deducted from your account as VAT on your investment interest';   }
            elseif($code==18){$r='Investment Deposit'; $smnms='Your investment deposit of NGN'.number_format($amt,2).' was received and your account updated accordingly';  }
            elseif($code==19){$r='Card Link Charges'; $sms='Your card has been successfully linked to your account and a fee of NGN'.number_format($amt,2).' was deducted for the transaction';  }
            elseif($code==20){$r=''; }

            //credit: non-refundable payment
            elseif($code==21){$r=''; }
            elseif($code==22){$r=''; }
            elseif($code==23){$r=''; }
            elseif($code==24){$r=''; }
            elseif($code==25){$r=''; }
            elseif($code==26){$r=''; }
            elseif($code==27){$r=''; }
            elseif($code==28){$r=''; }
            elseif($code==29){$r=''; }
            elseif($code==30){$r=''; }
            //Just for Record: Company payments to clients
            elseif($code==31){$r='Savings Partial Liquidation'; }
            elseif($code==32){$r='Investment Partial Liquidation'; }
            elseif($code==33){$r='Loan Processing Fee'; $sms='Your loan processing fee of NGN'.number_format($amt,2).' was received and your loan is currently being processed'; }
            elseif($code==34){$r=''; }
            elseif($code==35){$r=''; }
            elseif($code==36){$r=''; }
            elseif($code==37){$r=''; }
            elseif($code==38){$r=''; }
            elseif($code==39){$r=''; }
            elseif($code==40){$r=''; }
            return $amt==0 ? $r : $sms;
        }

        public function statusLoan($status,$opt=1){
          $bid = Auth::user()->bid;
          $loan = DB::table('loan')
                  ->where('status', $status)
                  ->where('bid', $bid)
                  ->sum('amount');
          $numloan = DB::select("SELECT * FROM loan WHERE status='$status' AND bid='$bid'");
          return $opt==1 ? $loan: count($numloan);
        }

        public function statusInv($status,$opt=1){
          $bid = Auth::user()->bid;
          $invest = DB::table('invacc')
                  ->where('status', $status)
                  ->where('bid', $bid)
                  ->sum('amount');
          $numinvest = DB::select("SELECT * FROM invacc WHERE status='$status' AND bid='$bid'");
          return $opt==1 ? $invest: count($numinvest);
        }

        public function statusSavings($status,$opt=1){
          $bid = Auth::user()->bid;
          $saving = DB::table('savings')
                  ->where('status', $status)
                  ->where('type', 14)
                  ->where('bid', $bid)
                  ->sum('amount');
          $numsavings = DB::select("SELECT * FROM savings WHERE status='$status' AND type=14 AND bid='$bid'");
          return $opt==1 ? $saving: count($numsavings);
        }

        public function calCapital($amount,$rate,$n){ //where $n = no of repayments
          return $amount / (1 + $rate * $n);
          }

        public function monthlyExp($cat,$mm){
          $bid = auth()->user()->bid;
            $sum = 0;
             $sql2 = DB::select("SELECT * FROM ewallet WHERE ref='$cat' AND bid='$bid' ");
             foreach($sql2 as $sql){
              if(date('Ym',$sql->ctime)==$mm){
                $sum += $sql->cos;
              }
             }
             return abs($sum);
        }

        public function monthlyExp2($type,$mm){
          $bid = auth()->user()->bid;
          $sum = 0;
           $sql2 = DB::select("SELECT * FROM ewallet WHERE type='$type' AND bid='$bid'");
           foreach($sql2 as $row2){
            if(date('Ym',$row2->ctime)==$mm){
            $sum += $row2->cos;
            }
           }
           return abs($sum);
        }

        public function yearlyExp($mm){
          $bid = auth()->user()->bid;
            $sum = 0;
            $sql2 = DB::select("SELECT * FROM ewallet WHERE type=1 AND bid='$bid' ");
            foreach($sql2 as $sql){
               if(date('Ym',$sql->ctime)==$mm){
                $sum += $sql->cos;
               }
            }
             return abs($sum);
        }

        public function catName($sn,$col='category'){
          $bid = auth()->user()->bid;
          $sql = DB::select("SELECT * FROM category WHERE sn='$sn' AND bid='$bid'");
          foreach($sql as $row){
            return  $row->$col;
          }
        }

        public function monthlyActual($mm){
          $bid = auth()->user()->bid;
          $sum = 0;
           $sql2 = DB::select("SELECT * FROM ewallet WHERE (type=11 OR type=16) AND bid='$bid'");
           foreach($sql2 as $row){
            if(date('Ym',$row->ctime)==$mm){
            $sum += $row->cos;
          }
             }
           return abs($sum);
          }

        public function monthlyExpected($mm){
          $bid = auth()->user()->bid;
          $sum = 0;
          $sql = DB::select("SELECT * FROM loantranch WHERE bid='$bid'");
            foreach($sql as $row){
              if(date('Ym',$row->start)==$mm){
              $sum += $row->tranch;
              }
            }
           return abs($sum);
          }

          public function yearlyExp1($mm){
            $bid = auth()->user()->bid;
            $sum = 0;
             $sql2 = DB::select("SELECT * FROM ewallet WHERE type<11 AND bid='$bid'");
             foreach($sql2 as $row){
               if(date('Ym',$row->ctime)==$mm){
                $sum += $row->cos; }
              }
             return abs($sum);
            }

            public function yearlyExp2($mm){
            $bid = auth()->user()->bid;
            $sum = 0;
             $sql2 = DB::select("SELECT * FROM ewallet WHERE type>10 AND bid='$bid'");
             foreach($sql2 as $row){
               if(date('Ym',$row->ctime)==$mm AND $row->type<21){
                $sum += $row->cos; }
              }
             return abs($sum);
            }

            public function countLoans($status){
              $bid = bid();
              $que=DB::select("SELECT * FROM loan WHERE status = '$status' AND bid = '$bid' " );
              $num=count($que);
              $res = $num==0 ? '<span class="badge badge-primary pull-right">'.$num.'</span>' : '<span class="badge badge-danger pull-right">'.$num.'</span>' ;
              return $res;
            }

            public function countSavings($status){
              $bid = bid();
              $que=DB::select("SELECT * FROM savings WHERE status = '$status'  AND bid = '$bid' " );
              $num=count($que);
              $res = $num==0 ? '<span class="badge badge-primary pull-right">'.$num.'</span>' : '<span class="badge badge-danger pull-right">'.$num.'</span>' ;
              return $res;
            }

            public function countInv($status){
              $bid = bid();
              $que=DB::select("SELECT * FROM invacc WHERE status = '$status'  AND bid = '$bid' " );
              $num=count($que);
              $res = $num==0 ? '<span class="badge badge-primary pull-right">'.$num.'</span>' : '<span class="badge badge-danger pull-right">'.$num.'</span>' ;
              return $res;
            }

            public function operations($mm,$type){
              $y = substr($mm,0,2);
              $m = substr($mm,2,4);
              $sum=0;
              $sql=DB::select("SELECT * FROM ewallet WHERE mm='$m' AND yy='$y' AND type='$type' ORDER BY id ASC " );
               return $sql;
            }

            public function logPay($userid,$bid,$ref,$amount,$type){
            $ctime = time();
            $bid = auth()->user()->bid;
            DB::select("INSERT INTO logpay (userid,bid,ref,ctime,amount,type) VALUES
             ('$userid','$bid','$ref','$ctime','$amount','$type') ");
            return;
            }

            public function addTd($ig,$col){
              $c = count($ig);
              $i=1;
              $th='';
              while($i<$c){ $e=$i++; $id=$ig[$e];
                $ch=$this->adminName($id,$col)==1 ? ' checked' : '';
            $th .= '<td class="text-center"><input type="radio" class="flat-red"'. $ch.' ></td>';
             }
             return $th;
            }



public function key(){
  $key = Auth::user()->pkey;
  return $key;
  //$key = Config::set('PAYSTACK_SECRET_KEY', Auth::user()->pkey);


}


public function addreportstodb($bid){
        $active = 0;
    $query1 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Company Expenses',1,'$active')  ");
        $query2 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Investment Interest',3,'$active')  ");
         $query3 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Investment Full Liquidation',4,'$active')  ");
         $query4 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Savings Partial Liquidation',5,'$active')  ");
         $query5 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Investment Partial Liquidation',6,'$active')  ");
         $query6 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Savings Interest',8,'$active')  ");
         $query7 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Savings Full Liquidation',9,'$active')  ");
         $query8 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Disbursed Loans',10,'$active')  ");
         $query9 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Loan Capital Repayment',11,'$active')  ");
         $query10 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Savings Deposit',14,'$active')  ");
         $query11 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Interest On Loan',16,'$active')  ");
         $query12 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','VAT On Investment Interest',17,'$active')  ");
         $query13 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Investment Deposit',18,'$active')  ");
         $query14 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Card Link Charges',19,'$active')  ");
         $query15 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Savings Partial Liquidation',31,'$active')  ");
        $query16 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Investment Partial Liquidation',32,'$active')  ");
     $query17 = DB::select("INSERT INTO reports (bid,title,type,active) VALUES ('$bid','Loan Processing Fee',33,'$active')");
     return;

}

}
