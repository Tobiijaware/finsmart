<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
       $user = Auth::user()->userid;  
       $bid = Auth::user()->bid;    
        $q = DB::select("SELECT * FROM users WHERE bid='$bid'");
        $qq = count($q);
        
        $loan = DB::table('loan')
             ->where('status', 4)
             ->where('bid', $bid)
             ->sum('amount');

        $invest = DB::table('invacc')
             ->where('status', 3)
             ->where('bid', $bid)
             ->sum('amount');

        $saving = DB::table('savings')
            ->where('status', 2)
            ->where('type', 14)
            ->where('bid', $bid)
            ->sum('amount');
        $loan1 = $this->statusLoan(1,2);
        $loan2 = $this->statusLoan(1);
        $loan3 = $this->statusLoan(2,2);
        $loan4 = $this->statusLoan(2);
        $loan5 = $this->statusLoan(3,2);
        $loan6 = $this->statusLoan(3);
        $loan7 = $this->statusLoan(5,2);
        $loan8 = $this->statusLoan(5);
        $inv1 = $this->statusInv(1,2);
        $inv2 = $this->statusInv(1);
        $inv3 = $this->statusInv(2,2);
        $inv4 = $this->statusInv(2);
        $inv5 = $this->statusInv(4,2);
        $inv6 = $this->statusInv(4);
        $sav1 = $this->statusSavings(3,2);
        $sav2 = $this->statusSavings(3);


        return view('admin/admindashboard', ['user'=> $qq,'loan'=>$loan,'invest'=>$invest, 'saving'=>$saving, 'loan1'=>$loan1, 
        'loan2'=>$loan2, 'loan3'=>$loan3, 'loan4'=>$loan4, 'loan5'=>$loan5, 'loan6'=>$loan6, 'loan7'=>$loan7, 'loan8'=>$loan8,
        'inv1'=>$inv1, 'inv2'=>$inv2, 'inv3'=>$inv3, 'inv4'=>$inv4, 'inv5'=>$inv5, 'inv6'=>$inv6, 'sav1'=>$sav1, 'sav2'=>$sav2 ]);
    }
}
