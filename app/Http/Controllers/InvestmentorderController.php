<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Investment;
class InvestmentorderController extends Controller
{
    public function investmentorder()
    {   
        $userid= auth()->user()->userid;
        $invdata = DB::table('invacc')->get()->where('userid', $userid);             
        return view('investmentorder',['data'=>$invdata]);
    }

    public function viewinvestment(Request $request)
    {   
        $userid= auth()->user()->userid;
        $refs = $request->input('ref');         
        $request->session()->put('ref', $request->input('ref'));
            $sql = DB::table('ewallet')
                  ->where('userid', $userid)
                  ->where('ref', $refs)
                  ->where('type', 11)
                  ->sum('cos');
            $sql = DB::table('ewallet')
                  ->where('userid', $userid)
                  ->where('ref', $refs)
                  ->where('type', 11)
                  ->sum('cos');
        return redirect('manageinvestment');       
    }
    public function manageinvestment(){
        $userid= auth()->user()->userid;      
        $ref = session()->get('ref');
        $invest = DB::table('invacc')->where('ref', $ref)->get();
        $term = $this->terminationDate($ref);
        $walletLoan = $this->walletLoan($userid,$ref,3);
        $statustype = Investment::where('ref', $ref)->first();
        $userstatus = $statustype->status;
        $status = $this->invStatus($userstatus);       
        $totalinv = $this->totalInvInt($ref);
        $Repayment = $this->Repayment($ref,18);
        $uName = $this->uName($Repayment->rep ?? '');
        $sql=DB::select("SELECT * FROM ewallet WHERE ref='$ref'" );
        return view('manageinvestment')->with(['invest'=>$invest, 'ccount'=>$sql, 'status'=>$status, 'termination'=>$term,
                                        'walletLoan'=>$walletLoan, 'totalinv'=>$totalinv, 
                                        'Repayment'=>$Repayment, 'userName'=>$uName]);
    }
    public function DeleteInvestment(Request $request){
        $reffs = $request['DeleteInvestment'];
        $sql = DB::table('invacc')
             ->where('ref', $reffs)
            ->delete();
         return redirect('createinvestment')->with('success', 'Investment Application Deleted Successfully');
        }
    
    public function updateinvestment(Request $request)
    {  
        $userid= auth()->user()->userid;
        $refs = $request['Editinvestment'];
        $affected = DB::table('invacc')
        ->where('userid', $userid)
        ->where('ref', $refs)
        ->update([
            'amount' => $request->input('amount'),
            'tenure' => $request->input('tenure'),
        ]);
        return redirect('investmentorders')->with('success', 'Savings details updated successfully');       
    }

}
