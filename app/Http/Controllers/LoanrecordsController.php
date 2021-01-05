<?php

namespace App\Http\Controllers;
use DB;
use App\Loan;
use Illuminate\Http\Request;

class LoanrecordsController extends Controller
{   

    public function loanrecords()
    {   
        $userstatus = '';
        $userid= auth()->user()->userid;
        $loandata = DB::table('loan')->get()->where('userid', $userid); 
        foreach($loandata as $stat){
            $userstatus = $stat->status;
        } 
        $status = $this->loanStatus($userstatus);
               
        return view('loanrecords',['loans'=>$loandata, 'status'=>$status]);
    }

    public function viewloan(Request $request)
    {   
        $userid= auth()->user()->userid;
        $refs = $request->input('ref'); 
        $data = DB::table('loan')->get()->where('ref', $refs);        
        $request->session()->put('loan', $data);
        $request->session()->put('ref', $request->input('ref'));
        return redirect('manageloan');    
    }

    public function manageloan(Request $request){
        $userstatus = '';
        $userid = auth()->user()->userid;
        $loan = session()->get('loan');
        $refs = session()->get('ref');
        $data = DB::table('loan')->get()->where('ref', $refs);
            foreach($data as $stat){
                $userstatus = $stat->status;
            } 
        $status = $this->loanStatus($userstatus);
        $loanExpiry = $this->loanExpiryDate($refs);
        $walletloan= $this->walletLoan($userid,$refs,11);  
        return view('manageloan')->with(['loan'=>$data,'status'=>$status,
                                  'loanExpiry'=>$loanExpiry, 'walletloan'=>$walletloan]);    
    }

}
