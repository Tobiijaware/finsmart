<?php

namespace App\Http\Controllers;
use DB;
use App\Robject;
use App\Ewallet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yabacon;
use Paystack;
class PayController extends Controller
{
    public function paywithpaystack(Request $request){
        require 'paystack/src/autoload.php';
        $public_key = Auth::user()->pkey;
        $secret_key = Auth::user()->skey;
        $amount = $request['amount']*100;
        $email = $request['email'];
        $reference = $this->win_hash(8);
        $paytype = $request['metadata'];
        $refer = $request['refer'];

        $paystack = new Yabacon\Paystack($secret_key);
        try
        {
          $tranx = $paystack->transaction->initialize([
            'amount'=>$amount,       // in kobo
            'email'=>$email,         // unique to customers
            'reference'=>$reference, // unique to transactions
            'metadata' => [
                'userid' => Auth::user()->userid,
                'bid' => Auth::user()->bid,
                'paytype' => $paytype,
                'ref' =>  $refer,
            ]
          ]);
        } catch(\Yabacon\Paystack\Exception\ApiException $e){
          print_r($e->getResponseObject());
          die($e->getMessage());
        }

        // store transaction reference so we can query in case user never comes back
        // perhaps due to network issue
        //save_last_transaction_reference($tranx->data->reference);

        // redirect to page so User can pay
        return redirect($tranx->data->authorization_url);

    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = Paystack::getPaymentData();


        //dd($paymentDetails);


        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

        //This save the data into the column, there are 3 level
        //First level is data, to get data id
        $paymentDetails['data']['id'] ;
        $amount = $paymentDetails['data']['amount'];
        $paymentDetails['data']['authorization'] ['last4'];
        //$paymentDetails['data']['forst_name'];
        $paytype = $paymentDetails['data']['metadata'] ['paytype'];
        //return $paytype;
        if($paytype==1){

        //You can save it like this
        $card = new Robject();
        $card->cardid = $paymentDetails['data']['id'];
        $card->userid =  $paymentDetails['data']['metadata'] ['userid'];
        $card->bid = $paymentDetails['data']['metadata'] ['bid'];
        $card->ref =  $paymentDetails['data']['reference'];
        $card->lastfour= $paymentDetails['data']['authorization'] ['last4'];
        $card->cardtype= $paymentDetails['data']['authorization'] ['card_type'];
        $card->expmonth= $paymentDetails['data']['authorization'] ['exp_month'];
        $card->expyear= $paymentDetails['data']['authorization'] ['exp_year'];
        $card->bank= $paymentDetails['data']['authorization'] ['bank'];
        $card->reset = 1;
        $card->status = 1;
        //return $card->userid;
        $card->save();
        $this->logPay($card->userid,$card->bid,$card->ref,2,$amount,1);
        if($card->save()){
            return redirect('paymentmethod')->with('success', 'Card Linked');
        }else{
            return redirect('paymentmethod')->with('error', 'Card Not Linked');
        }
     }elseif($paytype == 2){
        $wallet = new Ewallet();
        $transactionid = $paymentDetails['data']['id'];
        $wallet->trno = $this->win_hash(9);
        $wallet->userid =  $paymentDetails['data']['metadata'] ['userid'];
        $wallet->bid = $paymentDetails['data']['metadata'] ['bid'];
        $wallet->ref =  $paymentDetails['data']['metadata'] ['ref'];
        $wallet->cos = ($paymentDetails['data']['amount'])/100;
        $wallet->ref2 =  $paymentDetails['data']['reference'];
        $wallet->type = 33;
        $wallet->status = 5;
        $wallet->remark = 'Processing Fee';
        $wallet->ctime = time();
        $wallet->mm = date('m',$wallet->ctime);
        $wallet->yy = date('y',$wallet->ctime);
        $wallet->rep = $paymentDetails['data']['metadata'] ['userid'];
        $rep = $wallet->rep;
        $loanref =  $wallet->ref;
        $wallet->save();
        $sql = DB::select("UPDATE loan SET status=3,rep='$rep' WHERE ref='$loanref'");
        if($wallet->save()){
            return redirect('manageloan')->with('success', 'Payment Successful');
        }else{
            return redirect('manageloan')->with('error', 'Payment Not Successful');
        }
    }elseif($paytype==3){

        $wallet = new Ewallet();
        $transactionid = $paymentDetails['data']['id'];
        $wallet->trno = $this->win_hash(9);
        $wallet->userid =  $paymentDetails['data']['metadata'] ['userid'];
        $wallet->bid = $paymentDetails['data']['metadata'] ['bid'];
        $wallet->ref =  $paymentDetails['data']['metadata'] ['ref'];
        $wallet->cos = ($paymentDetails['data']['amount'])/100;
        $wallet->ref2 =  $paymentDetails['data']['reference'];
        $wallet->type = 14;
        $wallet->status = 5;
        $wallet->remark = 'Savings Deposit';
        $wallet->ctime = time();
        $wallet->mm = date('m',$wallet->ctime);
        $wallet->yy = date('y',$wallet->ctime);
        $wallet->rep = $paymentDetails['data']['metadata'] ['userid'];
        $rep = $wallet->rep;
        $savingsref =  $wallet->ref;
        $wallet->save();

        $mm = date('ym',$wallet->ctime);
        $sql = DB::select("UPDATE savings SET status=2,rep='$rep',start=$wallet->ctime,mm='$mm' WHERE ref='$savingsref'");
        if($wallet->save()){
            $request->session()->forget('amount');
            return redirect('managesavings')->with('success', 'Payment Successful');
        }else{
            return redirect('managesavings')->with('error', 'Payment Not Successful');
        }
    }elseif($paytype==4){
        $wallet = new Ewallet();
        $transactionid = $paymentDetails['data']['id'];
        $wallet->trno = $this->win_hash(9);
        $wallet->userid =  $paymentDetails['data']['metadata'] ['userid'];
        $wallet->bid = $paymentDetails['data']['metadata'] ['bid'];
        $wallet->ref =  $paymentDetails['data']['metadata'] ['ref'];
        $wallet->cos = ($paymentDetails['data']['amount'])/100;
        $wallet->ref2 =  $paymentDetails['data']['reference'];
        $wallet->type = 18;
        $wallet->status = 5;
        $wallet->remark = 'Investment Deposit';
        $wallet->ctime = time();
        $wallet->mm = date('m',$wallet->ctime);
        $wallet->yy = date('y',$wallet->ctime);
        $wallet->rep = $paymentDetails['data']['metadata'] ['userid'];
        $rep = $wallet->rep;
        $investmentref =  $wallet->ref;
        $start = $wallet->ctime;
        $stop = $start+60*60*24*$this->invName($wallet->ref,'tenure');
        $mm = date('ym', time());
        $wallet->save();
        $sql = DB::select("UPDATE invacc SET status=3,rep='$rep',start=$start,stop=$stop,mm='$mm' WHERE ref='$investmentref'");
        if($wallet->save()){
            return redirect('manageinvestment')->with('success', 'Payment Successful');
        }else{
            return redirect('manageinvestment')->with('error', 'Payment Not Successful');
        }
    }elseif ($paytype==5){
            $wallet = new Ewallet();
            $transactionid = $paymentDetails['data']['id'];
            $wallet->trno = $this->win_hash(9);
            $wallet->userid =  $paymentDetails['data']['metadata'] ['userid'];
            $wallet->bid = $paymentDetails['data']['metadata'] ['bid'];
            $wallet->ref =  $paymentDetails['data']['metadata'] ['ref'];
            $wallet->cos = ($paymentDetails['data']['amount'])/100;
            $wallet->ref2 =  $paymentDetails['data']['reference'];
            $wallet->type = 1;
            $wallet->status = 10;
            $wallet->remark = 'Wallet Funding';
            $wallet->ctime = time();
            $wallet->mm = date('m',$wallet->ctime);
            $wallet->yy = date('y',$wallet->ctime);
            $wallet->rep = $paymentDetails['data']['metadata'] ['userid'];
            //$rep = $wallet->rep;
            //$mm = date('ym', time());
            $wallet->save();
            if($wallet->save()){
                return back()->with('success', 'Funding Successful');
            }else{
                return back()->with('error', 'Operation Failed');
            }

        }elseif($paytype==6){
            $wallet = new Ewallet();
            //$transactionid = $paymentDetails['data']['id'];
            $wallet->trno = $this->win_hash(9);
            $wallet->userid =  $paymentDetails['data']['metadata'] ['userid'];
            $wallet->bid = $paymentDetails['data']['metadata'] ['bid'];
            $wallet->ref =  $paymentDetails['data']['metadata'] ['ref'];
            $wallet->cos = ($paymentDetails['data']['amount'])/100;
            $wallet->ref2 =  $paymentDetails['data']['reference'];
            $wallet->type = 20;
            $wallet->status = 6;
            $wallet->remark = 'Loan Repayment';
            $wallet->ctime = time();
            $wallet->mm = date('m',$wallet->ctime);
            $wallet->yy = date('y',$wallet->ctime);
            $wallet->rep = $paymentDetails['data']['metadata'] ['userid'];
            $rep = $wallet->rep;
            $loanref =  $wallet->ref;
            $wallet->save();
            $sql = DB::select("UPDATE loan SET status=5,rep='$rep' WHERE ref='$loanref'");
            if($wallet->save()){
                return back()->with('success', 'Loan Repaid');
            }else{
                return back()->with('error', 'Operation Failed');
            }

        }

}


        public function getAmount(Request $request){
            $ref = $request['CardSavingsPayment'];
            $bid = auth()->user()->bid;
            $amt = $request->input('payamount');
            $amount = $amt*100;
            $request->session()->put('amount', $amount);
            return back();
        }

        public function DelCard(Request $request){
            $sn = $request['delcard'];
            $userid = Auth::user()->userid;
            $bid = bid();
            $del = DB::table('robject')
                ->where('userid', $userid)
                ->where('sn', $sn)
                ->where('bid', $bid)
                ->delete();
            if($del){
                return back()->with('success', 'Card Successfully Deleted');
            }else{
                return back()->with('error', 'Operation Failed');
            }

        }

}
