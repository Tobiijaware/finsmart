<?php
namespace App\Http\Controllers;
use DB;
use App\Ewallet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yabacon;
use Paystack;

class AdminPayController extends Controller
{
    public function paywithpaystack(Request $request){
        require 'paystack/src/autoload.php';
        // $public_key = Auth::user()->pkey;
        $secret_key = Auth::user()->skey;
        //return $secret_key;
        // $amount = $request['amount'];
        // $email = $request['email'];
        // $reference = $this->win_hash(8);
        // $paytype = $request['metadata'];
        // $refer = $request['refer'];

        $paystack = new Yabacon\Paystack($secret_key);
       
        // $url = "https://api.paystack.co/transferrecipient";
        // $fields = [
        //   "type" => "nuban",
        //   "name" => "Ijaware Oluwatobi",
        //   "description" => "Zombier",
        //   "account_number" => "0694895159",
        //   "bank_code" => "044",
        //   "currency" => "NGN"
        // ];

        $url = "https://api.paystack.co/transfer";
        $fields = [
          "source" => "balance", 
          "reason" => "Calm down", 
          "email" => 'lee@gmail.com',
          "amount" => 3794800, 
          "recipient" => "RCP_4390xnfxejxem61"
          ];
        $fields_string = http_build_query($fields);
      

        //open connection
        // $ch = curl_init();
        
        // //set the url, number of POST vars, POST data
        // curl_setopt($ch,CURLOPT_URL, $url);
        // curl_setopt($ch,CURLOPT_POST, true);
        // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //   "Authorization: Bearer $secret_key",
        //   "Cache-Control: no-cache",
        // ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        //curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        // //execute post
        // $result = curl_exec($ch);
        // return $result;
        // $this->transfer();

        try
        {
          $tranx = $paystack->transaction->transfer($fields);
        } catch(\Yabacon\Paystack\Exception\ApiException $e){
          print_r($e->getResponseObject());
          die($e->getMessage());
        }
    
        // store transaction reference so we can query in case user never comes back
        // perhaps due to network issue
        //save_last_transaction_reference($tranx->data->reference);
    
        // redirect to page so User can pay
        return redirect($tranx->data->url);

    }

    public function transfer(){
      $secret_key = Auth::user()->skey;
    
        $url = "https://api.paystack.co/transfer";
        $fields = [
          "source" => "balance", 
          "reason" => "Calm down", 
          "amount" => 3794800, 
          "recipient" => "RCP_4390xnfxejxem61"
          ];

          return $fields;
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer $secret_key",
          "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        return $result;

    }

    
}
