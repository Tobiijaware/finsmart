<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Savings;
use App\Product;
use App\User;
use Auth;
use App\Createloan;
use http\Env\Response;
use Illuminate\Http\Request;

class AdminCreateSavingsController extends Controller
{
    public function activatesavings(Request $request){
        $product = DB::table('productsetup')->get()->where('type', 2)->where('bid', bid());  
        $uid = session()->get('uid');
        $data = DB::table('users')->get()->where('userid', $uid); 
        $data2 = DB::table('savings')->get()->where('userid', $uid);  
        foreach($data2 as $stat){
            $userstatus = $stat->status;
            //$deposit = $this->walletLoan($user,$refs,14);
        } 
        $status = $this->savingsStatus($userstatus ?? '') ; 
        $request->session()->put('data', $data);   
        return view('admin/admincreatesavings',['data'=>$data,'savings'=>$data2, 'status'=>$status,
        'products'=>$product]);
    }

    public function searchsavings(Request $request){       
        $q = $request->input('q');
        $bid = Auth::user()->bid; 
        $user = User::select('*')->where('bid', $bid)->where(function ($query) use ($q) {
         $query->where('surname', 'LIKE', '%'.$q.'%')
            ->orWhere('othername', 'LIKE', '%'.$q.'%')
            ->orWhere('email', 'LIKE', '%'.$q.'%')
            ->orWhere('phone', 'LIKE', '%'.$q.'%');
        })->get();
        //return $user;
      if(empty($user)){
        return back()->with('error', 'No Details found. Try to search again!');
      }
       elseif(count($user) > 0) {    
            $request->session()->put('details', $user); 
           return back();  }
        else{
           return back()->with('error', 'No Details found. Try to search again!');   }  
    }

    public function searchsavingsform(Request $request){  
        $userstatus = '';     
        $userid = $request->input('CreateNew');
        $request->session()->put('uid', $userid);
        return redirect('activatesavings');
    }

    public function ViewUserSavings(Request $request)
    {   
        $refs = $request->input('ManageSavings'); 
        $data = DB::table('savings')->get()->where('ref', $refs);        
        $request->session()->put('savings', $data);
        $request->session()->put('ref', $request->input('Managesavings'));
        return redirect('adminmanagesavings');    
    }

    public function ViewSavingsDetails(Request $request)
    {   
        $refs = $request->input('ManageSavings'); 
        $data = DB::table('savings')->get()->where('ref', $refs);        
        $request->session()->put('savings', $data);
        $request->session()->put('ref', $request->input('ManageSavings'));
        return redirect('savingsmanaging');    
       
    }

    public function savingsmanaging(Request $request){
        $userstatus = '';
        $savings = session()->get('savings');
        $refs = session()->get('ref');
        $data = DB::table('savings')->get()->where('ref', $refs);
        $userid = $this->saveName($refs,'userid');
        $data2 = DB::table('users')->get()->where('userid', $userid);     
          foreach($data as $stat){
              $userstatus = $this->saveName($refs,'status');
           } 
          $status = $this->savingsStatus($userstatus);
        // $loanExpiry = $this->savingsExpiryDate($refs);
          $walletloan= $this->walletLoan($userid,$refs,14);
          $walletloan2= $this->walletLoan($userid,$refs,17);
          $walletloan3= $this->walletLoan($userid,$refs,5);
          $walletloan4= $this->walletLoan($userid,$refs,9);
          $walletloan5= $this->walletLoan($userid,$refs,8);
           $id = auth()->user()->userid;
           $adminpermit = $this->adminName($id,$col='s1');
           $adminpermit2 = $this->adminName($id,$col='s2');
           $adminpermit3 = $this->adminName($id,$col='s3');
           $adminpermit4 = $this->adminName($id,$col='l4');
           $expected = $this->expectedCycles($refs);
           $save = $this->saveName($refs,'amount');
           $total = $this->totalSavInt($refs);
           $saveDeposit = $this->savingsDeposit($refs);
           $walletremark = $this->walletRemark($this->saveName($refs,'type'));

           $sql=DB::select("SELECT * FROM ewallet WHERE ref='$refs' " );
    
        return view('admin/adminmanagesavings')->with(['saving'=>$data, 'user'=>$data2, 'status'=>$status,
         'admin1'=>$adminpermit, 'admin2'=>$adminpermit2, 'admin3'=>$adminpermit3, 'expect'=>$expected, 
         'save'=>$save, 'walletloan'=>$walletloan, 'walletloan2'=>$walletloan2, 'walletloan3'=>$walletloan3,
          'walletloan4'=>$walletloan4,'walletloan5'=>$walletloan5, 'total'=>$total, 'ccount'=>$sql,
         'savedeposit'=>$saveDeposit,'remark'=>$walletremark ]);    
    }

    public function inactivesavings(){
        $usernn = [];
        $user = '';
        $userstatus = '';
        $statuss=[];
        $bid = Auth::user()->bid;
        $data = DB::select("SELECT * FROM savings WHERE status=1 AND bid = '$bid'" );
        foreach($data as $user){
            $user= $user->userid;
            $usern = $this->uName($user);
            $usernn[] = $usern;
        }
        foreach($data as $stat){
            $status = $stat->status;
            $stats =  $this->savingsStatus($status);
            $statuss[] = $stats;
        }
        return view('admin/inactivesavingsaccount')->with(['inactivesavings'=> $data, 'user' => $usernn,
         'status'=>$statuss]);
    }

    public function adminsavingsaccount(){
        $usernn = [];
        $user = '';
        $bid = Auth::user()->bid;
        $userstatus = '';
        $statuss=[];
        $wallet=[];
        $data = DB::select("SELECT * FROM savings WHERE status=2 AND bid = '$bid'");
      
        foreach($data as $user){
            $user= $user->userid;
            $usern = $this->uName($user);
            $usernn[] = $usern;
        }
        foreach($data as $stat){
            $status = $stat->status;
            $stats =  $this->savingsStatus($status);
            $statuss[] = $stats;
        }
        foreach($data as $sav){
            $user = $sav->userid;
            $refs = $sav->ref;
            $walletloan= $this->walletLoan($user,$refs,14);
            $wallet[] = $walletloan;
        }
        //$refs = $user->ref;
        //$walletloan= $this->walletLoan($user,$refs,14);
        //$walletloan= $this->walletLoan($user,$refs,14);
       
        return view('admin/adminsavingsaccount')->with(['activesavings'=> $data, 'user'=> $usernn, 'status'=>$statuss, 
        'wallet'=>$wallet
       ]);

    }

    public function expiredsavingsaccount(){
        $usernn = [];
        $user = '';
        $statuss=[];
        $wallet=[];
        $wallet2=[];
        $bid = Auth::user()->bid;
        $data = DB::select("SELECT * FROM savings WHERE status=3 AND bid = '$bid'");

        foreach($data as $user){
            $user= $user->userid;
            $usern = $this->uName($user);
            $usernn[] = $usern;
        }
        foreach($data as $refs){
            $ref= $refs->ref;
            $refss[] = $ref; 
        }
        foreach($data as $stat){
            $status = $stat->status;
            $stats =  $this->savingsStatus($status);
            $statuss[] = $stats;
        }
        foreach($data as $sav){
            $user = $sav->userid;
            $refs = $sav->ref;
            $walletloan= $this->walletLoan($user,$refs,14);
            $wallet[] = $walletloan;
        }
        foreach($data as $sav){
            $user = $sav->userid;
            $refs = $sav->ref;
            $walletloan2 = $this->walletLoan($user,$refs,8);
            $wallet2[] = $walletloan2;
        }       
       return view('admin/expiredsavingsaccount')->with(['expiredsavings'=> $data, 'user'=> $usernn, 'status'=>$statuss, 
       'wallet'=>$wallet, 'wallet2'=>$wallet2]);
    }

    public function getmy(Request $request){
        $month=$request['mm']; session()->put('month1', $month);
        $year=$request['yy']; session()->put('year1', $year);
        return back();
    }

    public function savingsdeposits(){
        $usernn= [];
        $repss=[];
        $sumtotal = 0;
        $remark=[];
        $bid = Auth::user()->bid;
        $m = session()->has('month1')?session()->get('month1'):date("m");
        $y =  session()->has('year1')?session()->get('year1'):date("y");
       // return $y;
        
        $data = DB::select("SELECT * FROM ewallet WHERE type=14 AND mm=$m AND yy=$y AND bid='$bid'");

        foreach($data as $dat){
            $user =$dat->userid;
            $usern = $this->uName($user);
            $usernn[] = $usern;
        }
        foreach($data as $datt){
            $reps =$datt->rep;
            $rep = $this->uName($reps);
            $repss[] = $rep;
        }
        foreach($data as $rem){
            $remm =$rem->type;
            $remar = $this->walletRemark($remm);
            $remark[] = $remar;
        }
        
        return view('admin/savingsdeposits')->with(['datas'=> $data, 'user'=> $usernn, 'rep'=>$repss, 'remark'=>$remark]);
    }


    public function submitsavings(Request $request)
    {
        $savings = new Savings();
        $savings->userid = session()->get('uid');
        $savings->bid = auth()->user()->bid;
        $savings->ref = $this->win_hash(10);
        $savings->amount = $request['amount'];
        $savings->period = $request['tenure'];
        $savings->type = $request['productkey'];
        $savings->rep = auth()->user()->userid;
        $data = Createloan::find($request['productkey']);
        $savings->rate = $data->interest;
        $savings->rate2 = $data->interest*2;
        $min = number_format($data->min);
        $max = number_format($data->max);
        $userid = auth()->user()->userid;
        $check = DB::table('savings')->get()->where('userid', $userid)->where('status', 1)->count();
        if($request['amount']<$data->min or $request['amount']>$data->max)
        {
        return redirect('activatesavings')->with('error', 'Invalid amount, choose between ₦'.$min.' and ₦'.$max);
        }           
        elseif($check > 0)
          {
            return redirect('activatesavings')->with('error', 'You currently have a similar savings account. Liquidate it to create a new one');
          }
        else{
          $savings->save();      
          if($savings->save()){
            return redirect('inactivesavingsaccount')->with('success', 'New Savings Plan Created');
          }
       }
  }

  public function DelSaving(Request $request){
    $reffs = $request['DeleteSaving'];
    $refs = session()->get('ref');
    $sql = DB::table('savings')
         ->where('ref', $refs)
         ->delete();
    $request->session()->forget('ref');
     return redirect('activatesavings')->with('success', 'Loan Application Deleted Successfully');
    }

    public function EditSavings(Request $request)
    {   
        $repp = Auth::user()->userid;
        $refs = $request->input('EditSaving');
        $data = DB::table('savings')->get()->where('ref', $refs);
        
        foreach($data as $rep){
            $id = $rep->id;
            $type = $rep->type;
        }
        
        $amount = $request->input('amount');
        $rate = $request->input('rate');
        $rate2 = $rate*12;
        $tenure = $request->input('tenure');
        $data2 = Createloan::find($type);
        if($amount<$data2->min or $amount>$data2->max)
          {
          return redirect('savingsmanaging')->with('error', 'Invalid amount, choose between ₦'.$data2->min.' and ₦'.$data2->max);
          }
          else{
               $sqll = DB::select("UPDATE savings SET amount='$amount',rate='$rate',rate2='$rate2', period='$tenure',
                 rep='$repp'  WHERE id='$id' "); 
        return redirect('savingsmanaging')->with('success', 'Loan Application Updated Successfully'); 
          }          
    }

    public function SavingsPayment(Request $request){
        $repp = auth()->user()->userid;
        $ctime = time();
        $refs = session()->get('ref');
        $amount = $request->input('payamount');
        $paydate = $request->input('paydate') ? strtotime($request->input('paydate')) : $ctime;
        $data = DB::table('ewallet')->get()->where('ref', $refs);   
        foreach($data as $rep){
            $lastime = $rep->ctime;

        }
        $date = $paydate;
        $mm = date('ym',$date);
        $id = $this->saveName($refs,'userid'); 
        $bid = $this->saveName($refs,'bid');
          
        if($amount>0){
            $this->walletProcess($bid,$id,$amount,5,14,$date,$refs); //deposit
           if($this->saveName($refs,'status')==1){
                $sql = DB::table('savings')
                ->where('ref',$refs)
                ->update([
                    'status'=>2,
                    'start'=>$date,
                    'mm'=>$mm,
                    'rep'=>$repp,
                ]);
                return back()->with(array('success'=>' Savings Account successfully Activated')); 
            }
            return redirect('savingsmanaging')->with('success', 'Savings payment submitted Successfully'); 
        }          
        else{ 
            return redirect('savingsmanaging')->with('error', 'Invalid amount entered, confirm and try again'); 
        }
                  
    }

    public function Liquidate1(Request $request)
    {   
        $rep = Auth::user()->userid;
        $refs = $request->input('Complete');
        $userid = $this->saveName($refs,'userid');
        $bid = $this->saveName($refs,'bid');
        $deposit = $this->walletLoan($userid,$refs,14)-$this->walletLoan($userid,$refs,5);
        $interest = $this->totalSavInt($refs);
        $ctime = time();
        $password = $_POST['validate'];
        $pass = $this->uName($rep,'password');
      
      if(password_verify($password, $pass)){     
      $sq=DB::select("SELECT * FROM ewallet WHERE ref='$refs' AND type=9 ");
        if(count($sq)==0){
           $this->walletProcess($bid,$userid,$deposit,5,9,$ctime,$refs);//liquidate savings          
           $this->walletProcess($bid,$userid,$interest,5,8,$ctime,$refs);//liquidate savings interest
           DB::select("UPDATE savings SET status=3,rep='$rep',stop='$ctime' WHERE ref='$refs' ");
        }
        return redirect('savingsmanaging')->with('success', 'Savings Account successfully Liquidated'); 
      }
      else{
          return redirect('savingsmanaging')->with('error', 'You have entered an incorrect validation code');
      } 
    }

    public function Liquidate2(Request $request)
    {   
        $rep = Auth::user()->userid;
        $refs = $request->input('Partial');
        $userid = $this->saveName($refs,'userid');
        $bid = $this->saveName($refs,'bid');
        $amount1 = $this->saveName($refs,'amount');
        $rate = $this->saveName($refs,'rate');
        $rate2 = $this->saveName($refs,'rate2');
        $period = $this->saveName($refs,'period');
        $type = $this->saveName($refs,'type');
        $date = strtotime($request->input('paydate'));
        $amount = $request->input('payamount');
        $mm = date('ym',$date);
        $password = $_POST['validate'];
        $pass = $this->uName($rep,'password');            
      if(password_verify($password, $pass)){   
           $this->walletProcess($bid,$userid,$amount,5,5,$date,$refs);//sav part liquidation record
           return redirect('savingsmanaging')->with('success', 'Operation Successful. Your savings has been partially liquidated.'); 
      }
      else{
          return redirect('savingsmanaging')->with('error', 'You have entered an incorrect validation code');
      } 

    } 



    
}
