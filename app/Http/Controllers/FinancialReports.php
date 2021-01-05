<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use App\Loan;


class FinancialReports extends Controller
{
    public function getdetails(Request $request){
        $month=$request['mm']; session()->put('month1',$month);
        return back();
    }

    public function operationaltransaction(Request $request){
        $mm = session()->get('month');
        $bid = Auth::user()->bid;
       // ->where('bid', $bid)
        return view('admin/operationaltransaction')->with(['mm'=> $mm]);
    }

    public function operationcredit(Request $request){
        $usernn= [];
        $repss=[];
        $sumtotal = 0;
        $bid = auth()->user()->bid;
        $m = session()->has('month1')?session()->get('month1'):date("m");
        $data = DB::select("SELECT * FROM ewallet WHERE type BETWEEN 11 AND 20 AND mm=$m AND bid='$bid'");
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
        return view('admin/operationalcredit')->with(['datas'=> $data, 'user'=> $usernn, 'rep'=>$repss]);
    }

    public function operationdebit(Request $request){
        $usernn= [];
        $repss=[];
        $sumtotal = 0;
        $bid = auth()->user()->bid;
        $m = session()->has('month1')?session()->get('month1'):date("m");
        $data = DB::select("SELECT * FROM ewallet WHERE type BETWEEN 1 AND 10 AND mm=$m AND bid='$bid'");
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
        return view('admin/operationaldebit')->with(['datas'=> $data, 'user'=> $usernn, 'rep'=>$repss]);
    }

    public function reportssetup(){
        $bid = bid();
        $data = DB::select("SELECT * FROM reports WHERE bid = '$bid'");
        return view('admin/reportscontrol')->with('data', $data);
    }

    public function activatereport(Request $request){
        $bid = bid();
        $sn = $request['active'];

        $query = DB::select("UPDATE reports SET active=1 WHERE bid='$bid' AND sn='$sn'");
        return back()->with('success', 'Operation Successful');
    }

    public function deactivatereport(Request $request){
        $bid = bid();
        $sn = $request['deactive'];
        $query = DB::select("UPDATE reports SET active=0 WHERE bid='$bid' AND sn='$sn'");
        return back()->with('success', 'Operation Successful');
    }



    public function addfinreport(Request $request){
        $title = ucfirst($request['title']);
        $sms = $request['sms'];
        $active = 0;
        $type = 1;
        $bid = bid();

        if(empty($title)){
            return back()->with('error', 'title cannot be empty');
        }else{
            $query = DB::select("INSERT INTO reports (title,bid,sms,type,active) VALUES ('$title','$bid','$sms','$type','$active')");
            return back()->with('success', 'Operation Successful');
        }
    }

    public function expectedrepayment(){
        $bid = auth()->user()->bid;
        $catt = [];
        $sql = DB::select("SELECT * FROM category ORDER BY category ASC ");
            foreach($sql as $row){
                $cat = $row->sn;
                $catt[] = $cat;
            }
        $year = session()->get('year');
        $sql2= DB::select("SELECT * FROM loantranch WHERE bid='$bid' ORDER BY start " );
        $sql3 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' AND (type=11 OR type=16) ");

        return view('admin/expectedrepayment')->with(['sql'=>$sql,'catt'=>$catt,'year'=>$year, 'sql2'=>$sql2, 'sql3'=>$sql3]);
    }

    public function fetchyearr(Request $request){
        $yy = (!empty($request->year)) ? $request->year : date('Y');
        $request->session()->put('year', $yy);
        return back();
    }

    public function accountsummary(){
        $bid = auth()->user()->bid;
        $catt = [];
        $sql = DB::select("SELECT * FROM category ORDER BY category ASC ");
            foreach($sql as $row){
                $cat = $row->sn;
                $catt[] = $cat;
            }
        $year = session()->get('year');
        $sql2 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' ");
        $sql3 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' AND type BETWEEN 11 AND 20 ");
        $sql4 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' AND type<11 " );

        return view('admin/accountsummary')->with(['sql'=>$sql,'catt'=>$catt,'year'=>$year, 'sql2'=>$sql2, 'sql3'=>$sql3,
         'sql4'=>$sql4]);
    }

    public function accountsummaryq(){
        $bid = auth()->user()->bid;
        $catt = [];
        $sql = DB::select("SELECT * FROM category ORDER BY category ASC ");
            foreach($sql as $row){
                $cat = $row->sn;
                $catt[] = $cat;
            }
        $year = session()->get('year');
        $start = session()->get('start') ?? '';
        $stop = session()->get('stop') ?? '';

        $sql2 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' ");
        $sql3 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' AND type BETWEEN 11 AND 20 ");
        $sql4 = DB::select("SELECT * FROM ewallet WHERE bid='$bid' AND type<11 " );

        return view('admin/accountsummaryq')->with(['sql'=>$sql,'catt'=>$catt,'year'=>$year, 'sql2'=>$sql2, 'sql3'=>$sql3,
         'sql4'=>$sql4, 'start'=>$start, 'stop'=>$stop]);
    }

    public function fetchmonth(Request $request){
        $startt = $request['start'];
        $stopp = $request['stop'];
        $start = strtotime($startt);
        $stop = strtotime($stopp);

        if($start>$stop || date('Y',$start) != date('Y',$stop)){
            return back()->with('error', 'You have entered an incorrect date range. Check and try again');
        }else{
            $request->session()->put('start', $start);
            $request->session()->put('stop', $stop);
            return back();
        }
    }

    public function fetchtransact(Request $request){
        $mm = (!empty($request->mm)) ? $request->mm : date('ym');
        $request->session()->put('month', $mm);
        return back();
    }




    public function editreport(Request $request){
        $bid = bid();
        $sn = $request['editreport'];
        $title = ucfirst($request['title']);
        $sms = ucfirst($request['sms']);

        $query = DB::select("UPDATE reports SET title='$title',sms='$sms' WHERE bid='$bid' AND sn='$sn' ");
        return back()->with('success', 'Update Successful');
    }












}
