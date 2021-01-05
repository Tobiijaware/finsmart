<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Category;
use App\Addexpense;

class ManageexpensesController extends Controller
{
    public function manageexpense(){
        $category= Category::all();       
        $usernn= [];
        $repss=[];
        $sumtotal = 0;
        $remark=[];
        $m = session()->has('month1')?session()->get('month1'):date("m");
        $y =  session()->has('year1')?session()->get('year1'):date("y");
        $trno = session()->get('trno');
        $data = DB::select("SELECT * FROM ewallet WHERE type=1 AND mm=$m AND yy=$y");

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
        return view('admin/expenses')->with(['category'=>$category,'datas'=> $data, 'user'=> $usernn, 'rep'=>$repss, 
        'remark'=>$remark, 'trno'=>$trno]);
    }

    public function addcat(Request $request)
    {
        category::create([
            'category' => $request['category'],
            'bid' => auth()->user()->userid,
            'userid' => auth()->user()->userid,
        ]);
          return redirect('manageexpense')->with('success');
    }


    public function addexpend(Request $request)
    {
        Addexpense::create([
            'amount' => $request['amount'],
            'bid' => auth()->user()->bid,
            'userid' => auth()->user()->userid,
            'cat_sn' =>$request['category'],
            'des'=>$request['des'],
            'ctime' => time(),
        ]);
          return redirect('manageexpense')->with('expenses updated succesfully');
    }

    public function addexpenses(Request $request)    {
        $bid =  auth()->user()->bid;
        $userid = auth()->user()->userid;
        $cat = $request['category'];
        $amount = $request['amount'];
        $note =$request['note'];
        $dat = $request['date'];
        $date = strtotime($dat);
        $ctime = time();
        $this->walletprocess($bid, $userid, $amount, 5, 1,$date, $cat, $note);
            return redirect('manageexpense')->with('success', 'Expenses Successfully Submitted');       
    }

    public function addcategory(Request $request)    
    {
        $bid =  auth()->user()->bid;
        $userid = auth()->user()->userid;
        $cat = trim($request['category']);
        
        $sql = DB::select("INSERT INTO category (bid, userid,category) VALUES ('$bid', '$userid','$cat')");        
        return back()->with('success', 'Operation Successful');
    }

    public function getmy(Request $request){
        $month=$request['mm']; session()->put('month1', $month);
        $year=$request['yy']; session()->put('year1', $year);
        return back();
    }

    public function Details(Request $request){
        $trno=$request['Update'];    
        $data = DB::table('ewallet')->get()->where('trno', $trno);
        $trno = session()->put('trno', $data);
        return back();
    }

    public function Updatedetails(Request $request){
        $rep = auth()->user()->userid;
        $cat = $request['category'];
        $amoun = $request['amount'];
        $note =$request['note'];
        $date = strtotime($_POST['date']);
        $datas = session()->get('trno');
        foreach($datas as $data){
            $trno = $data->trno;
        }
        $amount = '-'.$amoun;
        $sql = DB::select("UPDATE ewallet SET cos='$amount',ctime='$date',remark='$note',ref='$cat',rep='$rep' WHERE trno='$trno' ");
        session()->forget('trno');
        return back()->with('success', 'Expenses Successfully Submitted');
    }

    public function expense(Request $request){
        session()->forget('trno');
        return back();
    }

    public function summary(){
        $bid = auth()->user()->bid;
        $catt = [];
        $sql = DB::select("SELECT * FROM category WHERE bid='$bid' ORDER BY category  ASC ");
            foreach($sql as $row){ 
                $cat = $row->sn;
                $catt[] = $cat;
            }
        $year = session()->get('year');
        return view('admin/expensesummary')->with(['sql'=>$sql,'catt'=>$catt,'year'=>$year]);
    }

    public function fetchyear(Request $request){
        $yy = (!empty($request->year)) ? $request->year : date('Y');
        $request->session()->put('year', $yy);
        return back();
    }



}
