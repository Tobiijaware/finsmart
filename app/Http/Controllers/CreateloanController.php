<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Createloan;
use App\Loan;

class createloanController extends Controller
{
    public function usercreateloan()
    {
        $product = DB::table('productsetup')->get()->where('type', 1)->where('bid', bid());
        return view('createloan',['products'=>$product]);
    }

    public function calculate(Request $request)
    {
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('tenure', $request['tenure']);
        $data = Createloan::find($request['productkey']);
        $min = number_format($data->min);
        $max = number_format($data->max);
        if($request['amount']<$data->min or $request['amount']>$data->max)
        {
          return redirect('usercreateloan')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
        }
        else{
          $request->session()->put('data', $data);
          return back();
        }
    }

    function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);
    }

    public function submitloan(Request $request)
    {
          $loan = new Loan();
          $data = session()->get('data');
          $loan->userid = auth()->user()->userid;
          $loan->bid = auth()->user()->bid;
          $loan->ref = $this->win_hash(8);
          $loan->amount = $request['amount'];
          $loan->tenure = $request['tenure'];
          $loan->rate = $data->interest;
          $loan->prorate = $data->profee;
          $loan->type = $data->id;
          $loan->rep = auth()->user()->userid;

          $interest = ($request['amount'])*($data->interest)*($request['tenure'])/100/30;
          $loan->interest = $interest;

          $profee = ($request['amount'])*($data->profee)/100;
          $loan->profee = $profee;

          $expected= $request['amount'] + $interest;
          $tranch = $expected*30/$request['tenure'];
          $loan->tranch = $tranch;
          $userid = auth()->user()->userid;
          $bid = bid();
          $data = DB::select("SELECT * FROM users WHERE userid='$userid' AND bid='$bid'");
          foreach($data as $key){
            $bvn = $key->bvn;
            $accno = $key->accountno;
            $accname = $key->accname;
            $bankname = $key->bank;
          }
        $cardcheck = DB::select("SELECT * FROM robject WHERE userid='$userid' AND bid='$bid'");
        if(empty($cardcheck)){
            return back()->with('error', 'Please Link A Link A Card');
        }else{
            foreach ($cardcheck as $key) {
                $expmonth = $key->expmonth;
                $expyear = $key->expyear;
            }
            $guarantor = DB::select("SELECT * FROM guarantor WHERE userid='$userid' AND bid='$bid'");

            $doc = DB::select("SELECT * FROM doc WHERE userid='$userid' AND bid='$bid'");
            //return $guarantor;

            $exp = $expmonth + 1;
            $checkdate = mktime(0, 0, 0, $exp, 0, $expyear);
            $ch = strtotime('+' . $loan->tenure . 'days');

            $loann = DB::table('loan')->get()->where('userid', $userid)->where('status', 1)->count();
            if ($this->cardLinked($userid) == 'NO') {
                return back()->with('error', 'Please Link Your Debit Card');
            } elseif ($checkdate < $ch) {
                return back()->with('error', 'The card linked will expire before the loan tenure, link a new card');
            } elseif (empty($guarantor)) {
                return back()->with('error', 'Please Add At Least A Guarantor');
            } elseif (empty($doc)) {
                return back()->with('error', 'Please Add At Least A Requested Document');
            } elseif (empty($bvn)) {
                return back()->with('error', 'Please Update Your Bvn');
            } elseif (empty($accno)) {
                return back()->with('error', 'Please Update Your Account Number');
            } elseif (empty($accname)) {
                return back()->with('error', 'Please Update Your Account Name');
            } elseif (empty($bankname)) {
                return back()->with('error', 'Please Update Your Bank Name');
            } elseif ($loann > 0) {
                return redirect('usercreateloan')->with('error', 'You have a current loan application waiting for approval');
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
                    $request->session()->forget('data');
                    return redirect('loanrecords')->with(['success' => 'Successfully Submitted']);// 'loan'=>$data,
                    //'walletloan'=> $sql, 'status'=>$status]);
                }
            }
        }
    }

    public function DeleteLoan(Request $request){
        $reffs = $request['DeleteLoan'];
        $sql = DB::table('loan')
             ->where('ref', $reffs)
            ->delete();
         return redirect('usercreateloan')->with('success', 'Loan Application Deleted Successfully');
        }


}

