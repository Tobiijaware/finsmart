<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Loan;
use App\Product;
use App\User;
use App\Createloan;
use Illuminate\Http\Request;

class AdminCreateloanController extends Controller
{

    public function activateloan(Request $request){
        $product = DB::table('productsetup')->get()->where('type', 1);

        $uid = session()->get('uid');
        $data = DB::table('users')->get()->where('userid', $uid);
        $data2 = DB::table('loan')->get()->where('userid', $uid);
        foreach($data2 as $stat){
            $userstatus = $stat->status;
        }
        $status = $this->loanStatus($userstatus ?? '') ;
        $request->session()->put('data', $data);
        $product = DB::table('productsetup')->get()->where('type', 1)->where('bid', bid());
        return view('admin/admincreateloan',['data'=>$data,'loan'=>$data2, 'status'=>$status,
                                            'products'=>$product]);
    }

    public function search(Request $request){
        $q = $request->input('q');
        $bid = Auth::user()->bid;
        $user = User::select('*')->where('bid', $bid)->where(function ($query) use ($q) {
         $query->where('surname', 'LIKE', '%'.$q.'%')
            ->orWhere('othername', 'LIKE', '%'.$q.'%')
            ->orWhere('email', 'LIKE', '%'.$q.'%')
            ->orWhere('phone', 'LIKE', '%'.$q.'%');
        })->get();
        //return $user;
      if(empty($user)){
        return back()->with('error', 'No Details found. Try to search again!');
      }
       elseif(count($user) > 0) {
            $request->session()->put('details', $user);
           return back();  }
        else{
           return back()->with('error', 'No Details found. Try to search again!');   }
    }
    public function loanapplications(Request $request)
    {
        $user = '';
        $usernn = [];
        $usern = '';
        $status = [];
        $bid = Auth::user()->bid;
        $userid= Loan::all()->where('status', 1)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        };
        //return $userid;

        $status = $this->loanStatus($this->uName($user,'status'));
        return view('admin/loanapplications',['loans'=>$userid, 'user'=>$usernn, 'status'=>$status]);
    }

    public function loanapproved()
    {
        $user = '';
        $usernn = [];
        $status = [];

        $bid = Auth::user()->bid;
        $userid= Loan::all()->where('status', 2)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        };
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->loanStatus($stats);
            $status[] = $statss;
        }
        return view('admin/loanapproved',['loans'=>$userid, 'user'=>$usernn, 'status'=>$status]);
    }


    public function loanprocessing()
    {
        $user = '';
        $usernn = [];
        $status = [];
        $bid = Auth::user()->bid;
        $userid= Loan::all()->where('status', 3)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        };
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->loanStatus($stats);
            $status[] = $statss;
        }

        return view('admin/loanprocessing',['loans'=>$userid, 'user'=>$usernn, 'status'=>$status]);
    }
    public function loandisbursed()
    {
        $user = '';
        $bid = Auth::user()->bid;
        $usernn = [];
        $status = [];
        $ref = '';
        $userid= Loan::all()->where('status', 4)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        }
        foreach($userid as $refs){
            $ref= $refs->ref;
            $refss[] = $ref;
        }
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->loanStatus($stats);
            $status[] = $statss;
        }
       $cashpaid = $this->walletloan($user,$ref,11);
        return view('admin/loandisbursed',['loans'=>$userid, 'user'=>$usernn, 'status'=>$status, 'cashpaid'=> $cashpaid]);
    }

    public function loanterminated()
    {
        $user = '';
        $bid = Auth::user()->bid;
        $usernn = [];
        $status = [];
        $ref = '';
        $userid= Loan::all()->where('status', 5)->where('bid', $bid);
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        }
        foreach($userid as $refs){
            $ref= $refs->ref;
            $refss[] = $ref;
        }
        foreach($userid as $stat){
            $stats = $stat->status;
            $statss = $this->loanStatus($stats);
            $status[] = $statss;
        }
       $cashpaid = $this->walletloan($user,$ref,11);
        return view('admin/loanterminated',['loans'=>$userid, 'user'=>$usernn, 'status'=>$status, 'cashpaid'=> $cashpaid]);
    }

    public function loantranches(){
        //$bid =
        //bid='$bid'
        $month =  session()->has('month1')?session()->get('month1'):date("m");
        $data = DB::select("SELECT * FROM loantranch WHERE mm='$month' ");
        return view('admin/loantranches')->with('data', $data);
    }

    public function repaymenttoday()
    {
        // $sum=0;
        // $rem2=0;
        // $mm = date('ym');
        // $dd = date('ymd');
         $user = '';
        $usernn = [];
        $start = [];
        $userid= DB::select("SELECT * FROM loantranch ");
        foreach($userid as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;

        }
        foreach($userid as $start){
            $star= $start->start;
            $start = $star;
        }

     $cardlinked = $this->cardLinked($user);
        return view('admin/repaymenttoday',['loant'=>$userid, 'user'=>$usernn, 'start'=>$start, 'cardlinked'=>$cardlinked ]);
    }

    public function paymentmethod(){
        $user = '';
        $usernn = [];
        $data = DB::select("SELECT * FROM robject WHERE status=1 AND reset=1");
        foreach($data as $user){
            $user = $user->userid;
            $usern = $this->uName($user);
           $usernn[] = $usern;
        }

        return view('admin/paymentmethods')->with(['data'=>$data, 'user'=>$usernn]);
    }

   public function ViewUserLoan(Request $request)
    {
        $refs = $request->input('ManageLoan');
        $data = DB::table('loan')->get()->where('ref', $refs);
        $request->session()->put('loan', $data);
        $request->session()->put('ref', $request->input('ManageLoan'));
        return redirect('loanmanaging');
    }


    public function searchform(Request $request){
        $userstatus = '';
        $userid = $request->input('CreateNew');
        $request->session()->put('uid', $userid);
        return redirect('activateloan');
    }

    public function calculator(Request $request)
    {
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('tenure', $request['tenure']);
        $request->session()->put('rate', $request['rate']);

        $dataa = Product::find($request['productkey']);
        //$data=session()->get('data');
        $min = number_format($dataa->min);
        $max = number_format($dataa->max);
        if($request['amount']<$dataa->min or $request['amount']>$dataa->max)
        {
          return redirect('activateloan')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
        }
        else{
         $request->session()->put('d', $dataa);
         return redirect('activateloan');
        }
    }

    public function adminsubmitloan(Request $request)
    {
        $loan = new Loan();
        $data = session()->get('d');
        $loan->userid = session()->get('uid');
        $user = DB::table('users')->get()->where('userid', session()->get('uid'));
        foreach ($user as $key) {
            $loan->bid = $key->bid;
            $id = $key->userid;
            $bvn = $key->bvn;
            $accno = $key->accountno;
            $accname = $key->accname;
            $bankname = $key->bank;
        }


        $loan->ref = $this->win_hash(8);
        $loan->amount = $request['amount'];
        $loan->tenure = $request['tenure'];
        $loan->rate = $data->interest;
        $loan->prorate = $data->profee;
        $loan->type = $data->id;
        $loan->rep = auth()->user()->userid;
        $loan->penaltyfee = $request['amount']*$data->penalty/100;

        $interest = ($request['amount']) * ($data->interest) * ($request['tenure']) / 100 / 30;
        $loan->interest = $interest;

        $profee = ($request['amount']) * ($data->profee) / 100;
        $loan->profee = $profee;

        $expected = $request['amount'] + $interest;
        $tranch = $expected * 30 / $request['tenure'];
        $loan->tranch = $tranch;
        $userid = $loan->userid;
        $bid = bid();
        $loann = DB::table('loan')->get()->where('userid', $userid)->where('status', 1)->count();
        $cardcheck = DB::select("SELECT * FROM robject WHERE userid='$userid' AND bid='$bid'");

            if(empty($cardcheck)){
                return back()->with('error', 'Client Must Link A Card');
            }else{
                foreach($cardcheck as $key){
                    $expmonth = $key->expmonth;
                    $expyear = $key->expyear;
                }

         $exp = $expmonth+1;
        //return $cardcheck;
        $guarantor = DB::select("SELECT * FROM guarantor WHERE userid='$userid' AND bid='$bid'");
        $doc = DB::select("SELECT * FROM doc WHERE userid='$userid' AND bid='$bid'");


        $checkdate = mktime(0, 0, 0, $exp, 0, $expyear);
        $ch = strtotime('+' . $loan->tenure . 'days');

        if ($this->cardLinked($userid) == 'NO') {
            return back()->with('error', 'Please Link Your Debit Card');
        } elseif ($checkdate < $ch) {
            return back()->with('error', 'The User card linked will expire before the loan tenure, User Should link a new card');
        } elseif (empty($guarantor)) {
            return back()->with('error', 'Client Must Have At Least A Guarantor');
        } elseif (empty($doc)) {
            return back()->with('error', 'Client Must Have At Least A Requested Document Uploaded');
        } elseif (empty($bvn)) {
            return back()->with('error', 'No Bvn Number For Client');
        } elseif (empty($accno)) {
            return back()->with('error', 'No Account Number For Client');
        } elseif (empty($accname)) {
            return back()->with('error', 'No Account Name For Client');
        } elseif (empty($bankname)) {
            return back()->with('error', 'No Bank Name For Client');
        } elseif ($loann > 0) {
            return redirect('activateloan')->with('error', 'You have a current loan application waiting for approval');
        } else {
            $loan->save();
            $refs = $loan->ref;
            if ($loan->save()) {
                $data = DB::table('loan')->get()->where('ref', $refs);
                $user = auth()->user()->userid;

                foreach ($data as $stat) {
                    $userstatus = $stat->status;
                }
                $status = $this->loanStatus($userstatus);

                $sql = DB::table('ewallet')
                    ->where('userid', $user)
                    ->where('ref', $refs)
                    ->where('type', 11)
                    ->sum('cos');
                $request->session()->forget('d');
                $request->session()->forget('uid');
                return redirect('loanapplications')->with(['success' => 'Successfully Submitted']);
            }
        }
        }
    }

    public function loanmanaging(Request $request){
        $uname = '';
        $repp = '';
        $userstatus = '';
        $remm = [];
        $sql ='';
        $status = [];
        $loan = session()->get('loan');
        $refs = session()->get('ref');
        $data = DB::table('loan')->get()->where('ref', $refs);
        $data3 = DB::table('ewallet')->get()->where('ref', $refs);

        $userid = $this->loanName($refs,'userid');

        $data2 = DB::table('users')->get()->where('userid', $userid);
            foreach($data as $stat){
                $userstatus = $this->loanName($refs,'status');
                $uname = $this->uName($userid);
            }
        $card = $this->cardLinked($userid);
        $status = $this->loanStatus($userstatus);
        //$processed= $this->walletRemark($name);
        $loanExpiry = $this->loanExpiryDate($refs);
        $walletloan= $this->walletLoan($userid,$refs,11);
        $walletloan2= $this->walletLoan($userid,$refs,10);
        $id = auth()->user()->userid;
        $adminpermit = $this->adminName($id,$col='l1');
        $adminpermit2 = $this->adminName($id,$col='l2');
        $adminpermit3 = $this->adminName($id,$col='l3');
        $adminpermit4 = $this->adminName($id,$col='l4');
        $adminpermit5 = $this->adminName($id,$col='l5');
        $adminpermit6 = $this->adminName($id,$col='o6');
        $tranchloan = $this->loanName($refs,'tranch');

        $sql=DB::select("SELECT * FROM ewallet WHERE type>10 AND ref='$refs' " );
    //     foreach($sql as $typ){
    //         $ty = $typ->type;
    //         $type[] = $ty;
    //     }
    //   return $type;

        return view('admin/adminmanageloan')->with(['loan'=>$data, 'status'=>$status, 'user'=>$data2,
                'loanExpiry'=>$loanExpiry, 'walletloan'=>$walletloan, 'processed'=>$uname, 'walletloan2'=>$walletloan2,
                'ccount'=>$sql, 'data'=>$data3, 'tranch'=>$tranchloan, 'admin'=>$adminpermit, 'admin2'=>$adminpermit2,
                'admin3'=>$adminpermit3, 'admin4'=>$adminpermit4, 'admin5'=>$adminpermit5,'admin6'=>$adminpermit6, 'cardlinked'=>$card]);
    }

    public function Editloan(Request $request)
    {
        $repp = Auth::user()->userid;
        $refs = session()->get('ref');
        $data = DB::table('loan')->get()->where('ref', $refs);
        foreach($data as $rep){
            $id = $rep->id;
            $type = $rep->type;
        }
        $amount = $request->input('amount');
        $rate = $request->input('rate') ;
        $tenure = $request->input('tenure');
        $prorate = $request->input('profee') ;
        $interest =$amount*$rate*$tenure/100/30;
        $profee =$amount*$prorate/100;
        $expected = $amount + $interest;
        $tranch = $expected*30/$tenure;
        $data2 = Createloan::find($type);
        if($amount<$data2->min or $amount>$data2->max)
          {
          return redirect('loanmanaging')->with('error', 'Invalid amount, choose between ₦'.$data2->min.' and ₦'.$data2->max);
          }else{
        $sqll = DB::select("UPDATE loan SET amount='$amount',rate='$rate',interest='$interest',prorate='$prorate',
        profee='$profee',tranch='$tranch',tenure='$tenure',rep='$repp'  WHERE id='$id' ");
        return redirect('loanmanaging')->with('success', 'Loan Application Updated Successfully');
          }
    }

    public function Editloan2(Request $request)
    {
        $repp = Auth::user()->userid;
        $refs = session()->get('ref');
        $data = DB::table('loan')->get()->where('ref', $refs);
        foreach($data as $rep){
            $id = $rep->id;
            $type = $rep->type;
        }
        $amount = $request->input('amount');
        $rate = $request->input('rate') ;
        $tenure = $request->input('tenure');
        $interest =$amount*$rate*$tenure/100/30;
        $expected = $amount + $interest;
        $tranch = $expected*30/$tenure;
        $start = strtotime($request->input('start'));
        $stop = $start+60*60*24*$tenure;
        $data2 = Createloan::find($type);
        if($amount<$data2->min or $amount>$data2->max)
          {
          return redirect('loanmanaging')->with('error', 'Invalid amount, choose between ₦'.$data2->min.' and ₦'.$data2->max);
          }else{
        $sqll = DB::select("UPDATE loan SET amount='$amount',rate='$rate',interest='$interest',
        tranch='$tranch',tenure='$tenure',rep='$repp',start='$start',stop='$stop'  WHERE id='$id' ");
             $addloantranch = $this->addLoanTranch($refs);
             DB::select("DELETE FROM ewallet WHERE ref='$refs' AND type=10");
             $id = $this->loanName($refs,'userid');
             $bid = $this->loanName($refs,'bid');
             $amt = $this->loanName($refs,'amount')+$this->loanName($refs,'interest');
             $this->walletProcess($bid,$id,$amt,5,10,'',$refs); //disburse
             return redirect('loanmanaging')->with('success', 'Loan Application Updated Successfully');
             }

        }

        public function DelLoan(Request $request){
            $reffs = $request['DeleteLoan'];
            $refs = session()->get('ref');
            $sql = DB::table('loan')
                 ->where('ref', $refs)
                ->delete();
            $request->session()->forget('ref');
             return redirect('activateloan')->with('success', 'Loan Application Deleted Successfully');
            }

        public function ApproveLoan(){
            $rep = auth()->user()->userid;
            $refs = session()->get('ref');
            $sql = DB::table('loan')
            ->where('ref',$refs)
            ->update([
                'status'=>3,
                'rep'=>$rep,
            ]);
            if($sql){
                return redirect('loanmanaging')->with('success', 'Loan Application Approved Successfully');
            }
            else{
                return redirect('loanmanaging')->with('error', 'Error Approving loan application');
            }

        }

        public function ConfirmProfee(Request $request){
        $rep = auth()->user()->userid;
        $refs = session()->get('ref');
        $sql = DB::table('loan')
            ->where('ref',$refs)
            ->update([
                'status'=>3,
                'rep'=>$rep,
            ]);

            $id = $this->loanName($refs,'userid');
            $bid = $this->loanName($refs,'bid');
            $pro = $this->loanName($refs,'profee');
            $amt = $pro;
            $ctime = $request->input('ctime') ? strtotime($request->input('ctime')) : time();
            $this->walletProcess($bid,$id,$amt,5,33,$ctime,$refs);//proc fee
            return redirect('loanmanaging')->with('success', 'Loan Processing Fee Confirmed Successfully');

        }

        public function GoToTransaction(Request $request){
            $rep = auth()->user()->userid;
            $refs = session()->get('ref');
            $userid = $this->loanName($refs,'userid');
            $data2 = DB::table('users')->get()->where('userid', $userid);
            $trno = $request->input('trno');
            $flex = $request->input('flex');
            $request->session()->put('trno',$trno);
            $request->session()->put('flex',$flex);
            $request->session()->put('userid',$userid);
            return redirect('transaction')->with('success', 'Transaction information Successfully Updated!');
        }

        public function transaction(Request $request){
            $rate = '';
            $rep = auth()->user()->userid;
            $userid = session()->get('userid');
            $trno = session()->get('trno');
            $flex = session()->get('flex');
            $data = DB::table('ewallet')->get()->where('trno', $trno);
            $admin = $this->adminName($rep,'o6');
            $invacc = DB::table('ewallet')
                  ->where('trno', $trno)
                  ->get('ref');
            foreach($invacc as $inv){
                $ref = $inv->ref;
            }
            $invacc2 = DB::table('invacc')
                  ->where('ref', $ref)
                  ->get('rate');
            foreach($invacc2 as $inva){
                    $rate = $inva->rate;
                }
                return view('admin/transactionedit')->with(['data'=>$data, 'flex'=>$flex, 'admin'=>$admin, 'rate'=>$rate]);
        }

        public function Updateloanref(Request $request){
            $rep = auth()->user()->userid;
            $amoun = $request->input('amount');
            $amount = str_replace(",", "", $amoun);
            $dat = $request->input('date');
            $date = strtotime($dat);
            $rate = $request->input('rate');
            $trno = session()->get('trno');
            $flex = session()->get('flex');
            $mm = date('m',strtotime($date));
            $yy = date('y',strtotime($date));
            $ewallet = DB::table('ewallet')->where('trno', $trno)->get();
            foreach($ewallet as $inv){
                $ref = $inv->ref;
                $ctime = $inv->ctime;
      	        $oldcos = $inv->cos;
            }
            $cos = $oldcos<0 ? '-'.$amount : $amount ;
            $sql = date('ymd',$date)==date('ymd',$ctime) ? DB::select("UPDATE ewallet SET cos='$cos', rep='$rep' WHERE trno='$trno' ") :
            DB::select("UPDATE ewallet SET cos='$cos', ctime='$date', mm='$mm', yy='$yy', rep='$rep' WHERE trno='$trno' ");
             if($flex==3){
                $stop = $date+60*60*24*$this->invName($ref,'tenure');
                $s = DB::select("SELECT * FROM invacc WHERE ref='$ref' ");
                foreach($s as $v){
                    $rate = $v->rate;
                }
            $interest =$cos*$rate*$this->invName($ref,'tenure')/100/30;
            DB::select("UPDATE invacc SET amount='$cos',rep='$rep',rate='$rate',interest='$interest',
            start='$date',stop='$stop',mm='$mm', yy='$yy' WHERE ref='$ref'
            ");
            }
            return back()->with('success', 'Transaction information Successfully Updated!');
        }

        public function ConfirmDisburse(Request $request){
            $rep = auth()->user()->userid;
            $refs = session()->get('ref');
            $startt = $request->input('start');
            $start = strtotime($startt);
            $stop = $start+60*60*24*$this->loanName($refs,'tenure');
            $sql = DB::table('loan')
                ->where('ref',$refs)
                ->update([
                    'status'=>4,
                    'start'=>$start,
                    'stop'=>$stop,
                    'rep'=>$rep,
                ]);

            $this->addLoanTranch($refs);
            $remark = 'Loan Disbursed';
            $id = $this->loanName($refs,'userid');
            $bid = $this->loanName($refs,'bid');
            $amt = $this->loanName($refs,'amount')+$this->loanName($refs,'interest');
            $amount = $this->loanName($refs,'amount');
            $interest = $this->loanName($refs,'interest');
            $profee = $this->loanName($refs,'profee');
            $this->walletPro2($refs,$bid,$id,10,$amount,$interest,$profee,$remark);
            $this->walletProcess($bid,$id,$amt,5,10,$start,$refs,$remark); //disburse

            return redirect('loanmanaging')->with('success', 'Loan Disburse Confirmed Successfully');
            }

            public function ReceivePayment(Request $request){
                $rep = auth()->user()->userid;
                $ctime = time();
                $date = $request->input('paydate') ? strtotime($request->input('paydate')) : $ctime;
                $amount = $request->input('payamount');
                $datee = $request->input('date');
                $date = trim($datee);
                $refs = session()->get('ref');
                $id = $this->loanName($refs,'userid');
                $bid = $this->loanName($refs,'bid');
                $rate = $this->loanName($refs,'rate')/100;
                $n = $this->loanName($refs ,'tenure')/30;
                $capital = $this->calCapital($amount,$rate,$n);
                $interest = $amount-$capital;
                $loan = abs($this->walletLoan($id,$refs,10));
                $paid = $this->walletLoan($id,$refs,11);
                $excess = $amount+$paid-$loan;
                $amt = $excess>0 ? $loan-$paid : $amount;
                $this->walletProcess($bid,$id,$amount,5,11,$date,$refs); //repay loan capital
                if($excess>=0){
                    $sql = DB::table('loan')
                         ->where('ref',$refs)
                         ->update([
                          'status'=>5,
                          'terminate'=>$ctime,
                          'rep'=>$rep
                         ]);
                return redirect('loanmanaging')->with('success', 'This loan contract is successfully terminated');
                }

                if($excess>0){
                    $this->walletProcess($bid,$id,$excess,5,12,$date,$ref) ;  //excess
                    return redirect('loanmanaging')->with('success', 'Excess in loan repayment of NGN'.
                    number_format($excess,2).' has been recorded for client');
                }
                return redirect('loanmanaging')->with('success', 'Loan Repayment submitted Successfully');

            }



}

