<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class SearchClientController extends Controller
{
    public function search(Request $request){       
        $q = $request->input('q');
        $user = User::where('surname', 'LIKE', '%'. $q . '%')->orwhere('othername', 'LIKE', '%'. $q . '%')
        ->orwhere('email', 'LIKE', '%'. $q . '%')->orwhere('phone', 'LIKE', '%'. $q . '%')->get();
        if(count($user) > 0)       
           return view('admin/createloan',['Details'=>$user]);
        else
           return view('admin/createloan')->with(['error'=>'No Details found. Try to search again!']);      
    }
}