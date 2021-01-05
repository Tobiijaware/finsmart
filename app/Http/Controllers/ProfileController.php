<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Guarantor;
use App\Doc;
use Auth;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $userid = auth()->user()->userid;
        $sql = DB::table('ewallet')
        ->where('userid', $userid)
            ->where('bid', bid())
            ->where('type', '<', 21)
            ->sum('cos');
        $sq = DB::table('loan')
        ->where('userid', $userid)
            ->where('bid', bid())
            ->where('status', 4)
            ->sum('amount');
        $que = DB::table('invacc')
        ->where('userid', $userid)
            ->where('bid', bid())
            ->where('status', 3)
            ->sum('amount');
        $sav = DB::table('savings')
             ->where('userid', $userid)
             ->where('bid', bid())
             ->where('status', 2)
             ->where('type', 14)
             ->sum('amount');
        $gua =  DB::table('guarantor')
            ->where('userid', $userid)
            ->where('bid', bid())
            ->get();
        $doc =  DB::table('doc')
            ->where('userid', $userid)
            ->where('bid', bid())
            ->get();
        return view('myprofile')->with(['user'=>$user, 'amt'=> $sql, 'loan'=> $sq,
            'activeinvest' => $que, 'saving'=>$sav,'guarantor'=>$gua,'document'=>$doc ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function Guarantor(Request $request)
    {
        $user = new Guarantor();
        $user->userid = Auth::user()->userid;
        $user->bid = Auth::user()->bid;
        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->note = $request['note'];
        $user->rep = Auth::user()->userid;
        $user->save();
        return redirect('/myprofile')->with('success', 'Guarantor details submitted successfully');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->bank = $request->input('bank');
        $user->accountno = $request->input('accno');
        $user->bvn = $request->input('bvn');
        $user->save();
        return redirect('/myprofile')->with('success', 'Bank details updated successfully');
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:7', 'max:10'],
            'password2' => ['same:password'],
        ]);

        $id = Auth::user()->id;
        $user = User::find($id);
        $password = Auth::user()->password;
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if($user->save()){
            return redirect('/myprofile')->with('success', 'Password Changed Successfully');

        }else{
            return redirect('/myprofile')->with('error', 'Password not Changed Successfully');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload

        if($request->hasFile('image')){
           $filenameWithExt = $request->file('image')->getClientOriginalName();

           //Get file name
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just ext
           $extension = $request->file('image')->getClientOriginalExtension();
           //file name to store
           $fileNameToStore = $filename.'_'.time().'.'.$extension;

           //upload image
           $path = $request->file('image')->storeAs('public/storage', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->userid = auth()->user()->userid;
        $user->photo = $fileNameToStore;
        $user->save();
        //$save=  $user->save();

        if($user->save()){
            return redirect('/myprofile')->with('success','Photo Updated');
        }else{
            return redirect('/myprofile')->with('error','Photo Update Declined');
        }
    }

    public function storeDoc(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'note' => 'nullable',
            'image' => 'image|nullable|max:1999',
        ]);

        //Handle file upload

        if($request->hasFile('image')){
           $filenameWithExt = $request->file('image')->getClientOriginalName();

           //Get file name
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just ext
           $extension = $request->file('image')->getClientOriginalExtension();
           //file name to store
           $fileNameToStore = $filename.'_'.time().'.'.$extension;

           //upload image
           $path = $request->file('image')->storeAs('public/storage', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $user = new Doc();
        $id = Auth::user()->id;
        $user->userid = auth()->user()->userid;
        $user->bid = bid();
        $user->rep = auth()->user()->userid;
        $user->title = $request->input('title');
        $user->note = $request->input('note');
        $user->doc = $fileNameToStore;
        $user->save();
        //$save=  $user->save();

        if($user->save()){
            return redirect('/myprofile')->with('success','Document Updated');
        }else{
            return redirect('/myprofile')->with('error','Document Update Declined');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {
        //
    }
}
