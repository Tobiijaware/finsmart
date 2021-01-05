<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Createloan;
use App\Savings;

class CreatesavingController extends Controller
{
    public function index()
    {   
        $product = DB::table('productsetup')->get()->where('type', 2)->where('bid', bid());      
        return view('createsavings',['products'=>$product]);
    }

    function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789',$length)),0,$length);	
    }

    public function submitsaving(Request $request)
    {
          $savings = new Savings();
          $savings->userid = auth()->user()->userid;
          $savings->bid = auth()->user()->bid;
          $savings->ref = $this->win_hash(10);
          $savings->amount = $request['amount'];
          $savings->period = $request['tenure'];
          $savings->type = $request['productkey'];
          $savings->rep = auth()->user()->userid;
          $data = Createloan::find($request['productkey']);
          $savings->rate = $data->interest;
          $min = number_format($data->min);
          $max = number_format($data->max);
          $userid = auth()->user()->userid;
          $check = DB::table('savings')->get()->where('userid', $userid)->where('status', 1)->count();

          if($request['amount']<$data->min or $request['amount']>$data->max)
          {
          return redirect('createsavings')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
          }           
          elseif($check > 0)
            {
              return redirect('createsavings')->with('error', 'You currently have a similar savings account. Liquidate it to create a new one');
            }
          else{
            $savings->save();
            $refs =  $savings->ref;      
            if($savings->save()){
              $data = DB::table('savings')->get()->where('ref', $refs);
              foreach($data as $stat){
                $userstatus = $stat->status;
            }
            $status = $this->savingsStatus($userstatus); 
              $sql = DB::table('ewallet')
                  ->where('userid', $userid)
                  ->where('ref', $refs)
                  ->where('type', 14)
                  ->sum('cos');
             $sqll = DB::table('ewallet')
                ->where('userid', $userid)
                ->where('ref', $refs)
                ->where('type', 17)
                ->sum('cos');
             $sqql=DB::select("SELECT * FROM ewallet WHERE ref='$refs' " );
              return back()->with('success', 'New Savings Account Created Successfully');
              //with(['success'=>'New Savings Account Created Successfully', 'savings'=>$data,
               //'wallet'=>$sql, 'wallett'=>$sqll, 'status'=>$status, 'ccount'=>$sqql ]);
            }
         }
    }

    public function DeleteSavings(Request $request){
      $reffs = $request['DeleteSavings'];
      $sql = DB::table('savings')
           ->where('ref', $reffs)
          ->delete();
       return redirect('createsavings')->with('success', 'Savings Application Deleted Successfully');
      }

}
