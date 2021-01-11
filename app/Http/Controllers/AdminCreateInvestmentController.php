<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Investment;
use App\CreateInvestment;
use App\Product;
use App\User;
use Auth;
use http\Env\Response;
use Illuminate\Http\Request;

class AdminCreateInvestmentController extends Controller
{
    public function activateinvestment(Request $request){
        $uid = session()->get('uid');
        $data = DB::table('users')->get()->where('userid', $uid);
        $data2 = DB::table('invacc')->get()->where('userid', $uid);
        foreach($data2 as $stat){
            $userstatus = $stat->status;
        }
        $status = $this->loanStatus($userstatus ?? '') ;
        $request->session()->put('data', $data);
        $product = DB::table('productsetup')->get()->where('type', 3)->where('bid', bid());
        return view('admin/admincreateinvestment')->with(['data'=>$data,'invest'=>$data2, 'status'=>$status,'products'=>$product]);
    }


    public function viewinvestmentorder(){
      $usernn = [];
        $user = '';
        $usern = '';
        $status = [];
        $bid = Auth::user()->bid;
        $userid= Investment::all()->where('status',1)->where('bid',$bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        };
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->invStatus($stats);
            $status[] = $statss;
        }
        return view('admin/investmentorder',['invest'=>$userid, 'user'=>$usernn, 'status'=>$status]);
    }

    public function searchform(Request $request){
        $userstatus = '';
        $userid = $request->input('CreateNew');
        $request->session()->put('uid', $userid);
        return redirect('activateinvestment');
    }

    public function calculator(Request $request)
    {
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('tenure', $request['tenure']);
        $dataa = CreateInvestment::find($request['productkey']);
        $min = number_format($dataa->min);
        $max = number_format($dataa->max);
        if($request['amount']<$dataa->min or $request['amount']>$dataa->max)
        {
          return redirect('activateinvestment')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
        }
        else{
          $request->session()->put('d', $dataa);
          return redirect('activateinvestment');
        }
    }

    public function adminsubmitInvestment(Request $request)
    {
          $investment = new Investment();
          $data = session()->get('d');
          $investment->userid = session()->get('uid');
          $user = DB::table('users')->get()->where('userid', session()->get('uid'));
          foreach($user as $key){
            $investment->bid = $key->bid;
          }

          $investment->userid = session()->get('uid');
          $investment->bid = auth()->user()->bid;
          $investment->ref = $this->win_hash(10);
          $investment->amount = $request['amount'];
          $investment->tenure = $request['tenure'];
          $d = CreateInvestment::find($request['productkey']);
          $investment->type = $data->id;
          $product = DB::table('productsetup')->get()->where('type', 3);
          $investment->prorate  = $data->vat;
          $investment->rate = $data->interest;
          $investment->status = 1;
          $investment->profee = $data->interest*$data->vat/100;
          $investment->interest = $request['amount']*$data->interest*$request['tenure']/100/30;
          $investment->rep = auth()->user()->userid;
          $userid = $investment->userid;
            $bidd = bid();
            $data1 = DB::table('users')->where('userid', $userid)->where('bid', $bidd)->get();
            foreach($data1 as $key){
                $bvn = $key->bvn;
                $accno = $key->accountno;
                $accname = $key->accname;
                $bankname = $key->bank;
            }
          $invacc = DB::table('invacc')->get()->where('userid', $userid)->where('status', 1)->count();
            if($invacc > 0)
            {
              $request->session()->forget('data');
            return back()->with('error', 'You have a current investment application waiting for approval');
            }elseif (empty($bvn)) {
                return back()->with('error', 'No Bvn Number For Client');
            } elseif (empty($accno)) {
                return back()->with('error', 'No Account Number For Client');
            } elseif (empty($accname)) {
                return back()->with('error', 'No Account Name For Client');
            } elseif (empty($bankname)) {
                return back()->with('error', 'No Bank Name For Client');
            }
            else{
            $investment->save();
            $refs =  $investment->ref;
             if($investment->save()){
               $request->session()->forget('data');
            return redirect('investmentorder')->with(['success'=>' Investment Application Submitted Successfully ']);
        }
      }
    }

    public function search(Request $request){
        $q = $request->input('q');
        $user = User::where('surname', 'LIKE', '%'. $q . '%')->orwhere('othername', 'LIKE', '%'. $q . '%')
        ->orwhere('email', 'LIKE', '%'. $q . '%')->orwhere('phone', 'LIKE', '%'. $q . '%')->get();

        if(count($user) > 0) {
            $request->session()->put('details', $user);
           return back();  }
        else{
           return back()->with('error', 'No Details found. Try to search again!');   }
    }

    public function ViewUserInvestment(Request $request)
    {
        $refs = $request->input('ManageInvestment');
        $data = DB::table('loan')->get()->where('ref', $refs);
        $request->session()->put('loan', $data);
        $request->session()->put('ref', $request->input('ManageInvestment'));
        return redirect('adminmanageinvestment');
    }

    public function investmentpending(){
        $usernn = [];
        $user = '';
        $usern = '';
        $status = [];
        $bid = Auth::user()->bid;
        $userid= Investment::all()->where('status',2)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        };
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->invStatus($stats);
            $status[] = $statss;
        }
        return view('admin/investmentpending',['invest'=>$userid, 'user'=>$usernn, 'status'=>$status]);
    }

    public function investmentexpired(){
      $usernn = [];
      $user = '';
      $usern = '';
      $status = [];
      $bid = Auth::user()->bid;
      $userid= Investment::all()->where('status',4)->where('bid',$bid);
      foreach($userid as $user){
          $user = $user->userid;
          $usern = $this->uName($user);
         $usernn[] = $usern;

      };
      foreach($userid as $stat){
          $stats = $stat->status;
          $statss = $this->invStatus($stats);
          $status[] = $statss;
      }
      return view('admin/investmentexpired',['invest'=>$userid, 'user'=>$usernn, 'status'=>$status]);
  }

  public function invdeposits(){
    $usernn= [];
    $repss=[];
    $remark=[];
    $sumtotal = 0;
    $bid = Auth::user()->bid;
    $m = session()->has('month1')?session()->get('month1'):date("m");
    $data = DB::select("SELECT * FROM ewallet WHERE type=18 AND mm=$m AND bid='$bid'");
    //return $data;
    foreach($data as $dat){
        $user =$dat->userid;
        $usern = $this->uName($user);
        $usernn[] = $usern;
    }
    foreach($data as $datt){
        $reps =$datt->rep;
        $rep = $this->uName($reps);
        $repss[] = $rep;
    }
    foreach($data as $rem){
        $remm =$rem->type;
        $remar = $this->walletRemark($remm);
        $remark[] = $remar;
    }

    return view('admin/investmentdeposits')->with(['datas'=> $data, 'user'=> $usernn, 'rep'=>$repss, 'remark'=>$remark]);

}

    public function activeinvestment(){
      $usernn = [];
      $user = '';
      $usern = '';
      $status = [];
      $bid = Auth::user()->bid;
      $userid= Investment::all()->where('status',3)->where('bid',$bid);
      foreach($userid as $user){
          $user = $user->userid;
          $usern = $this->uName($user);
         $usernn[] = $usern;

      };
      foreach($userid as $stat){
          $stats = $stat->status;
          $statss = $this->invStatus($stats);
          $status[] = $statss;
      }
      return view('admin/investmentactive',['invest'=>$userid, 'user'=>$usernn, 'status'=>$status]);
  }

  public function ViewInvestDetails(Request $request)
    {
        $refs = $request->input('ManageInv');
        $data = DB::table('invacc')->get()->where('ref', $refs);
        $request->session()->put('invacc', $data);
        $request->session()->put('ref', $request->input('ManageInv'));
        return redirect('investmentmanaging');
    }

    public function investmentmanaging(Request $request){

      $invacc = session()->get('invacc');
      $refs = session()->get('ref');
      $data = DB::table('invacc')->get()->where('ref', $refs);
      $data3 = DB::table('invacc')->get()->where('ref', $refs);
      foreach($data3 as $typ){
              $type=$typ->type;
      }

      $userid = $this->invName($refs,'userid');
      $terminate = $this->terminationDate($refs);
      $total = $this->totalInvInt($refs);
      $walletloan =$this->walletLoan($userid,$refs,3);

       $data2 = DB::table('users')->get()->where('userid', $userid);
       foreach($data as $stat){
            $userstatus = $this->invName($refs,'status');
            $uname = $this->uName($userid);
       }
         $status = $this->invStatus($userstatus);
         $setname = $this->set2Name($type,'vat');
          $walletloan= $this->walletLoan($userid,$refs,18);
          $walletloan2= $this->walletLoan($userid,$refs,17);
          $walletloan3= $this->walletLoan($userid,$refs,6);
          $walletloan4= $this->walletLoan($userid,$refs,4);
          $walletloan5= $this->walletLoan($userid,$refs,3);
          $walletremark = $this->walletRemark($this->invName($refs,'type'));
         $id = auth()->user()->userid;
         $adminpermit = $this->adminName($id,$col='i1');
         $adminpermit2 = $this->adminName($id,$col='i2');
         $adminpermit3 = $this->adminName($id,$col='i3');
         $adminpermit4 = $this->adminName($id,$col='i4');
         $tranchloan = $this->invName($refs,'tranch');
         $invDeposit = $this->invDeposit($refs);
         $sql=DB::select("SELECT * FROM ewallet WHERE ref='$refs'" );

      return view('admin/adminmanageinv')->with(['invacc'=>$data, 'user'=>$data2, 'status'=>$status, 'setname'=>$setname,
      'terminate'=>$terminate, 'total'=>$total, 'walletloan'=>$walletloan, 'walletloan2'=>$walletloan2, 'walletloan3'=>$walletloan3,
      'walletloan4'=>$walletloan4,'walletloan5'=>$walletloan5,  'ccount'=>$sql, 'admin1'=>$adminpermit,
      'admin2'=>$adminpermit,'admin3'=>$adminpermit,'admin4'=>$adminpermit, 'deposit'=>$invDeposit, 'remark'=>$walletremark]);
  }

  public function Deleteinv(Request $request){
    $refs = session()->get('ref');
    $sql = DB::table('invacc')
         ->where('ref', $refs)
         ->delete();
    $request->session()->forget('ref');
     return redirect('activateinvestment')->with('success', 'Investment Application Deleted Successfully');
    }

    public function Approveinv(){
      $rep = auth()->user()->userid;
      $refs = session()->get('ref');
      $sql = DB::table('invacc')
      ->where('ref',$refs)
      ->update([
          'status'=>2,
          'rep'=>$rep,
      ]);
      if($sql){
          return redirect('investmentmanaging')->with('success', 'Investment Application Approved Successfully');
      }
      else{
          return redirect('investmentmanaging')->with('error', 'Error Approving Investment application');
      }
  }

  public function EditInv(Request $request)
  {
      $repp = Auth::user()->userid;
      $refs = $request->input('EditInv');
      $data = DB::table('invacc')->get()->where('ref', $refs);

      foreach($data as $rep){
          $id = $rep->id;
          $type = $rep->type;
      }

      $amount = $request->input('amount');
      $rate = $request->input('rate');
      $tenure = $request->input('tenure');
      $data2 = CreateInvestment::find($type);
      if($amount<$data2->min or $amount>$data2->max)
        {
        return redirect('investmentmanaging')->with('error', 'Invalid amount, choose between ₦'.$data2->min.' and ₦'.$data2->max);
        }
        else{
             $sqll = DB::select("UPDATE invacc SET amount='$amount',rate='$rate',tenure='$tenure',
               rep='$repp'  WHERE id='$id' ");
      return redirect('investmentmanaging')->with('success', 'Investment Application Updated Successfully');
        }
  }

  public function MakeInvPayment(Request $request){
    $repp = auth()->user()->userid;
    $ctime = time();
    $refs = session()->get('ref');
    $amoun = $request->input('payamount');
    $amount = trim($amoun);
    $date = $request->input('paydate') ? strtotime($request->input('paydate')) : $ctime;
    $stop = $date+60*60*24*$this->invName($refs,'tenure');
    $mm = date('ym',$date);
    $id = $this->invName($refs,'userid');

    $data = DB::table('ewallet')->get()->where('ref', $refs);
    foreach($data as $rep){
        $lastime = $rep->ctime;

    }
    $mm = date('ym',$date);
    $id = $this->invName($refs,'userid');
    $bid = $this->invName($refs,'bid');

    if($amount>0){
        $this->walletProcess($bid,$id,$amount,5,18,$date,$refs); //deposit
        DB::select("UPDATE invacc SET status=3,rep='$repp',start='$date',stop='$stop',mm='$mm' WHERE ref='$refs' ");
        return redirect('investmentmanaging')->with('success', 'Investment payment submitted Successfully');
    }
    else{
        return redirect('investmentmanaging')->with('error', 'Invalid amount entered, confirm and try again');
    }

}

public function LiquidateInv1(Request $request)
    {
        $rep = Auth::user()->userid;
        $refs = $request->input('Complete');
        $userid = $this->invName($refs,'userid');
        $bid = $this->invName($refs,'bid');
        $deposit = $this->walletLoan($userid,$refs,18)-$this->walletLoan($userid,$refs,6);
        $interest = $this->totalInvInt($refs);
        $ctime = time();
        $password = $_POST['validate'];
        $pass = $this->uName($rep,'password');
      if(password_verify($password, $pass)){
      $sq=DB::select("SELECT * FROM ewallet WHERE ref='$refs' AND type=4 ");
        if(count($sq)==0){
           $this->walletProcess($bid,$userid,$deposit,5,4,$ctime,$refs);//liquidate investment
           $this->walletProcess($bid,$userid,$interest,5,3,$ctime,$refs);//liquidate investment interest
           DB::select("UPDATE invacc SET status=4,rep='$rep',stop='$ctime' WHERE ref='$refs' ");
        }
          return redirect('investmentmanaging')->with('success', 'Investment Account successfully Liquidated');
      }
      else{
          return redirect('investmentmanaging')->with('error', 'You have entered an incorrect validation code');
      }
    }

    public function LiquidateInv2(Request $request)
    {
        $rep = Auth::user()->userid;
        $refs = $request->input('Partial');
        $userid = $this->invName($refs,'userid');
        $bid = $this->invName($refs,'bid');
        $amount1 = $this->invName($refs,'amount');
        $rate = $this->invName($refs,'rate');
        $period = $this->invName($refs,'tenure');
        $type = $this->invName($refs,'type');
        $date = strtotime($request->input('paydate'));
        $amount = $request->input('payamount');
        $mm = date('ym',$date);
        $password = $_POST['validate'];
        $pass = $this->uName($rep,'password');
      if(password_verify($password, $pass)){
           $this->walletProcess($bid,$userid,$amount,5,6,$date,$refs);// investment part liquidation record
           return redirect('investmentmanaging')->with('success', 'Operation Successful. Your investment has
            been partially liquidated.');
      }
      else{
          return redirect('investmentmanaging')->with('error', 'You have entered an incorrect validation code');
      }

    }




}
