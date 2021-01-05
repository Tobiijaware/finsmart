<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Redirect;
use App\Robject;
use App\Ewallet;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;

class PaymentController extends Controller
{
   
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
  

    public function redirectToGateway()
    {
      
      

        try{
           
            return Paystack::getAuthorizationUrl()->redirectNow();
           
            // $this->logResponse($trx,$userid,$bid,$ref);
        }catch(\Exception $e) {
            return back()->with(['error'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
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
    }
      
}

    public function showcards(){
        $data = [];
        $userid = auth()->user()->userid;
        $sql = DB::table('users')->where(['userid'=>$userid])->get('bid');
        foreach($sql as $key){
            $bid = $key->bid;
        }
        $data = DB::table('robject')->where(['userid'=>$userid,'bid'=>$bid, 'status'=>1, 'reset'=>1])->get();
        return view('paymentmethod')->with('data', $data);
    }

    public function getAmount(Request $request){
        $ref = $request['CardSavingsPayment'];
        $bid = auth()->user()->bid;
        $amt = $request->input('payamount');
        $amount = $amt*100;
        // $check = DB::table('savings')->where(['ref'=>$ref, 'bid'=>$bid])->get('amount');
        // $check2 = DB::table('ewallet')->where(['ref'=>$ref, 'bid'=>$bid])->sum('cos');
        // foreach($check as $data){
        //     $am = $data->amount;
        // }
        // foreach($check2 as $key){
        //     $total = $key->cos;
        //     $ref1 = $key->ref;
        // }
        //return $check2;
        $request->session()->put('amount', $amount);
        return back();
    }

    //  public function paynew(Request $request){
    //     $userid = auth()->user()->userid;
    //         $ref2 = $this->win_hash(12);
    //         $bid = auth()->user()->bid;

    //         // $this->logPay($id,$ref,$ref2,$amount,$type);
    //         $amount = $request['amount'];
    //         $amount2 = $amount*100;
    //         // validate and save the order posted

    //         // craft a reference for the payment, here we are using the ID from saving it earlier

    //         $email = auth()->user()->email;

    //         // Get this from https://github.com/yabacon/paystack-class
    //         //require 'Paystack.php'; 
    //         // if using https://github.com/yabacon/paystack-php
    //         // require 'paystack/autoload.php';

    //         $paystack = new Paystack(test_key($userid, $bid, 'pkey'));
    //         // the code below throws an exception if there was a problem completing the request, 
    //         // else returns an object created from the json response
    //         $trx = $paystack->transaction->initialize(
    //         [
    //             'amount'=>$amount2, /* 20 naira */
    //             'email'=>$email,
    //             'reference'=>$ref2,
    //             'callback_url'=>'http://127.0.0.1:8000/payment/callback',
    //             'metadata'=>json_encode([
    //             'cart_id'=>$id,
    //             'reference'=>$ref2,
    //             ])
    //         ]
    //         );
    //         // status should be true if there was a successful call // I commented this when it was not working
    //         //if(!$trx['status']){
    //         //  exit($trx->message);
    //         //}

    //         // full sample initialize response is here: https://developers.paystack.co/docs/initialize-a-transaction
    //         // Get the user to click link to start payment or simply redirect to the url generated
    //         header('Location: ' . $trx->data->authorization_url);
    // }
}