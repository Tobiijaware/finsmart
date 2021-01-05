<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

class StaffsController extends Controller
{


    public function viewstaffsetup(){
        return view('admin/staffs');
    }

    public function searchstaffs(Request $request){       
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

    public function addStaffs(Request $request){
        $userid = $request['addStaff'];
        $staffrole = strtoupper($request['role']);
        $payroll = $request['payroll'];
        $bid = bid();
        $rep = Auth::user()->userid;
        $check = DB::select("SELECT * from staffs where userid = '$userid' AND bid = '$bid'");
        if(count($check)>0){
            return back()->with('error', 'Staff Already exists');
        }else{
        $newstaff = DB::select("INSERT INTO staffs (userid,bid,rep,staffrole,payroll,status) VALUES ('$userid','$bid','$rep','$staffrole','$payroll',1)");
        return back()->with('success', 'Operation Successful');
        }
       
    }

    public function reset(Request $request){
       $new = session()->get('details');
       $request->session()->forget('details');
       return back()->with('success', 'Details cleared');


    }


    public function allstaffs(){
        $bid = bid();
        $staffs = DB::select("SELECT * FROM staffs WHERE bid = '$bid' ");
        return view('admin/allstaffs')->with('staffs', $staffs);
    }

    public function managestaffs(Request $request){
        $mm = session()->get('month');
        $userid = $request['ManageStaffs'];
        $bid = bid();

        $data = DB::select("SELECT * FROM users WHERE userid='$userid' AND bid='$bid'");
        return view('admin/managestaffs')->with(['staffdata'=> $data, 'mm'=>$mm]);


    }

    public function update(Request $request){
        $userid = $request['Paydetails'];
        $paytype = strtoupper($request['paytype']);
        $amount = $request['amount'];
        $transactype = $request['transactype'];
        $dateofpay = strtotime($request['dateofpay']);
        $exp = $request['exp'];
        $mm = date('ym');
        // $dateofresump = strtotime($request['dateofresump']);

        $bid = bid();
        $rep = Auth::user()->userid;
        // $query1 = DB::select("SELECT paytype FROM Pay WHERE bid='$bid' AND userid='$userid'");
        // foreach($query1 as $key){
        //     $check = $key->paytype;
        // }
        // if($paytype==$check){
        //     return back()->with('error', 'Payment Type Already Exists For This User');
        // }else{
        $query = DB::select("INSERT INTO pay (bid,userid,dateofpay,mm,paytype,amount,expt,typeoftran,rep) VALUES ('$bid','$userid','$dateofpay','$mm','$paytype','$amount','$exp','$transactype','$rep')");
        return redirect('allstaffs')->with('success', 'Operation Successful');
       // }

    }

    public function deactivate(Request $request){
        $userid = $request->input('deactivate');
        $bid = bid();
        //$status = 0;

        $query = DB::select("UPDATE staffs SET status=0 WHERE userid='$userid' AND bid='$bid'");
        return redirect('allstaffs')->with('success', 'Operation Successful');

    }

    public function activate(Request $request){
        $userid = $request->input('activate');
        $bid = bid();
        //$status = 0;

        $query = DB::select("UPDATE staffs SET status=1 WHERE userid='$userid' AND bid='$bid'");
        return redirect('allstaffs')->with('success', 'Operation Successful');

    }

    public function delete(Request $request){
        $userid = $request->input('delete');
        $bid = bid();
        $query = DB::select("DELETE FROM staffs WHERE userid='$userid' AND bid='$bid'");
        return redirect('allstaffs')->with('success', 'Operation Successful');

    }

    public function fetchpaydetails(Request $request){
        $bid = bid();
        $userid = $request['userid'];
        $mm = $request['mm'];
        $query = DB::select("SELECT * FROM pay WHERE userid='$userid' AND bid='$bid' AND mm='$mm'");

        return response()->json([
            'data'=> $query
        ], 200);

       
        
    }
   
}
