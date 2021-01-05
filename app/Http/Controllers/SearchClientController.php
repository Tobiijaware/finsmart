<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use http\Env\Response;
use App\User;
class SearchClientController extends Controller
{

    public function displayclients(){
        $details = session()->get('details');
        return view('admin/searchclient')->with('details', $details);
    }

    public function searchclient(Request $request){      
      
        $q = $request->input('q');
        $bid = bid(); 
        $user = User::select('*')->where('bid', $bid)->where('surname', 'LIKE', '%'. $q . '%')->orwhere('othername', 'LIKE', '%'. $q . '%')
        ->orwhere('email', 'LIKE', '%'. $q . '%')->orwhere('phone', 'LIKE', '%'. $q . '%')->get();
      
        if(count($user) > 0) {    
            $request->session()->put('details', $user); 
           return redirect()->route('searchclient');  }
        else{
           return back()->with('error', 'No Details found. Try to search again!');   }  
    }
}