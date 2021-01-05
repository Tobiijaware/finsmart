<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionData(request $request){
        $request->session()->has('amount');
        $request->session()->has('rate');
        $request->session()->has('tenure');
        $request->session()->has('profee');
        $request->session()->has('advisory');
        $request->session()->has('insurance');
    }

    public function storeSessionData(request $request){
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('rate', $request['rate']);
        $request->session()->put('tenure', $request['tenure']);
        $request->session()->put('profee', $request['profee']);
        $request->session()->put('advisory', $request['advisory']);
        $request->session()->put('insurance', $request['insurance']);  
        return redirect('/createloan2');
    }

}
