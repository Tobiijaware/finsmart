<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Savings;
use Illuminate\Http\Request;

class SavingsaccountController extends Controller
{
    public function savingsaccount()
    {   
        $userstatus = '';
        $userid= auth()->user()->userid;       
        $savingsdata = DB::table('savings')->get()->where('userid', $userid);  
        foreach($savingsdata as $stat){
            $userstatus = $stat->status;
        }
        $status = $this->savingsStatus($userstatus);             
        return view('savingsaccount', ['savings'=>$savingsdata, 'status'=>$status]);
    }

    public function viewsavings(Request $request)
    {   
        $userid= auth()->user()->userid;
        $refs = $request->input('ref'); 
        $data = DB::table('savings')->get()->where('ref', $refs);        
        $request->session()->put('savings', $data);
        $request->session()->put('ref', $request->input('ref'));
        return redirect('managesavings');
    }

    public function managesavings(Request $request)
    {   
        $userstatus = '';
        $userid = auth()->user()->userid;
        $loan = session()->get('savings');
        $refs = session()->get('ref');
        $data = DB::table('savings')->get()->where('ref', $refs);
            foreach($data as $stat){
                $userstatus = $stat->status;
            } 
        $status = $this->savingsStatus($userstatus);
        $walletloan= $this->walletLoan($userid,$refs,11);  

        $sqll = DB::table('ewallet')
            ->where('userid', $userid)
            ->where('ref', $refs)
            ->where('type', 11)
            ->sum('cos');
        $sql=DB::select("SELECT * FROM ewallet WHERE ref='$refs' " );
  return view('managesavings')->with(['savings'=>$data, 'walletloan'=> $sqll, 'status'=>$status, 'ccount'=>$sql]);

    }

    public function updatesavings(Request $request)
    {   
        $refs = session()->get('ref');
        $data = DB::table('savings')->get()->where('ref', $refs);
        foreach($data as $rep){
            $id = $rep->id;
        }
        $amount = $request->input('amount');
        $period = $request->input('tenure');

        $newsavings = DB::select("UPDATE savings SET amount='$amount', period='$period'  WHERE id='$id' ");
        return redirect('savingsaccount')->with('success', 'Savings details updated successfully');       
    }

}
