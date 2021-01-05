<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Dashboard;
use Auth;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user()->userid;
        $q = DB::table('ewallet')
             ->where('userid', $user)
             ->where('type', '<', 21)
            ->where('bid', bid())
             ->sum('cos');
        $qq = DB::table('loan')
             ->where('userid', $user)
             ->where('status', 4)
            ->where('bid', bid())
             ->sum('amount');
        $inv = DB::table('invacc')
             ->where('userid', $user)
             ->where('status', 3)
            ->where('bid', bid())
             ->sum('amount');
        $sav = DB::table('savings')
             ->where('userid', $user)
             ->where('status', 2)
             ->where('type', 14)
            ->where('bid', bid())
             ->sum('amount');
        $recenttransactions = DB::table('ewallet')
            ->where('userid', $user)
            ->where('bid', bid())
            ->get();
        return view('dashboard', ['amt'=> $q, 'loan'=>$qq, 'invest'=>$inv, 'saving'=>$sav, 'recent'=> $recenttransactions]);
    }

    public function show($id)
    {
        $user = Auth::user()->userid;
    }






}
