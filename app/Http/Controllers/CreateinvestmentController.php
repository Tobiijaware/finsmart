<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\CreateInvestment;
use App\Investment;
use App\Createloan;



class CreateinvestmentController extends Controller
{
    public function index()
    {   
        $product = DB::table('productsetup')->get()->where('type', 3)->where('bid', bid());      
        return view('createinvestment',['products'=>$product]);
    }

    function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);	
    }

    public function calculateInvest(Request $request)
    {          
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('tenure', $request['tenure']);       
        $data = Createloan::find($request['productkey']);
        $min = number_format($data->min);
        $max = number_format($data->max);        
        if($request['amount']<$data->min or $request['amount']>$data->max)
        {
          return redirect('createinvestment')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
        }
        else{           
          $request->session()->put('data', $data);
          return redirect('createinvestment')->with(['message'=> $data, 'vat'=>$data]);  
        }    
    }

    public function submitInvestment(Request $request)
    { 
          $investment = new Investment();
          $userid = auth()->user()->userid;
          $data = session()->get('data');
          $investment->userid = auth()->user()->userid;
          $investment->bid = auth()->user()->bid;
          $investment->ref = $this->win_hash(10);
          $investment->amount = $request['amount'];
          $investment->tenure = $request['tenure'];
          $d = Createloan::find($request['productkey']);
          $investment->type = $data->id;
          $product = DB::table('productsetup')->get()->where('type', 3);
          $investment->prorate  = $data->vat;
          $investment->rate = $data->interest;
          $investment->status = 1;
          $investment->profee = $data->interest*$data->vat/100;
          $investment->interest = $request['amount']*$data->interest*$request['tenure']/100/30;
          $investment->rep = auth()->user()->userid;
          $invacc = DB::table('invacc')->get()->where('userid', $userid)->where('status', 1)->count();
            if($invacc > 0)
            {
              $request->session()->forget('data');
            return redirect('createinvestment')->with('error', 'You have a current investment application waiting for approval');
            }else{
            $investment->save();
            $refs =  $investment->ref;
             if($investment->save()){
               $request->session()->forget('data');
            return redirect('createinvestment')->with(['success'=>' Investment Application Submitted Successfully ']);          
        }
      }
    }
}
