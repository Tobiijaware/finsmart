<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Investment;
use App\Savings;
use App\Loan;
use App\Doc;
use App\Guarantor;
use Auth;
use DB;
class ClientsController extends Controller
{
    public function viewclients(){
        $bid = auth()->user()->bid;
        $user = User::all()->where('bid', $bid)->where('is_user',1);
        return view('admin/clients')->with('user', $user);
    }

    public function addnewclient(){
        return view('admin/newclient');
    }

    public function displayclients(){
        return view('admin/searchclient');
    }

    public function clientsgroup(){
        return view('admin/clientsgroup');
    }

    public function smsclients(){
        return view('admin/smsclients');
    }

    public function emailclients(){
        return view('admin/emailclients');
    }

    public function viewclientdetails(Request $request){
        $id = $request['viewclientprofile'];
        $data = DB::table('users')->where('userid', $id)->get();
        $request->session()->put('userid', $id);
        $request->session()->put('datas', $data);
        return redirect('viewclientprofile');
    }

    public function viewclientprofile(Request $request){
        $amt=0;
        $ref = 0;
        $sref = 0;
        $stat = 0;
        $istat = 0;    
        $data = session()->get('datas');
       foreach($data as $key){
           $userid = $key->userid;
           $bid = $key->bid;
       }
        $user = DB::table('users')
            ->where(['userid'=> $userid, 'bid'=>$bid])->get();
        $loan = DB::table('loan')
        ->where(['userid'=> $userid, 'bid'=>$bid])->get();
        $invest = DB::table('invacc')
        ->where(['userid'=> $userid, 'bid'=>$bid])->get();
        $saving = DB::table('savings')
        ->where(['userid'=> $userid, 'bid'=>$bid])->get();
        $sql = DB::table('ewallet')
        ->where('userid', $userid)
        ->where('bid', $bid)
        ->where('type', '<', 21)
        ->sum('cos');
        $sq = DB::table('loan')
        ->where('userid', $userid)
        ->where('bid', $bid)
        ->where('status', 4)
        ->sum('amount');
        $que = DB::table('invacc')
        ->where('userid', $userid)
        ->where('bid', $bid)
        ->where('status', 3)
        ->sum('amount');
        $sav = DB::table('savings')
             ->where('userid', $userid)
             ->where('bid', $bid)
             ->where('status', 2)
             ->where('type', 14)
             ->sum('amount');
        $doc = DB::table('doc')->where(['bid'=>$bid,'userid'=>$userid])->get(['doc','title','note']);
        $guarantor = DB::table('guarantor')->where(['bid'=>$bid,'userid'=>$userid])->get(['name','phone','email','note']);
        
        foreach ($loan as $loanref) {
            $ref = $loanref->ref;
            $stat = $loanref->status;
        }
       
        foreach($invest as $investref){
            $iref = $investref->ref;
            $istat = $investref->status;
        }

        foreach($saving as $savingref){
            $sref = $savingref->ref;
            $sstat = $savingref->status;
        }
      
        $walletLoan = $this->walletLoa($user,$ref,11);
        $swalletLoan = $this->walletLoa($user,$sref,14);
        $status = $this->loanStatus($stat);
        $istatus = $this->loanStatus($istat);
        $sstatus = $this->loanStatus($stat);

     session()->put('data', $user);
    return view('admin/clientprofile')->with(['data'=> $user, 'loandata' =>
        $loan, 'walletLoan' => $walletLoan, 'status'=>$status, 'investdata' => $invest, 'istat'=> $istatus, 'sstat' =>
        $sstatus, 'savings' => $saving, 'swallet' => $swalletLoan, 
        'amt'=> $sql, 'loan'=> $sq, 'activeinvest' => $que, 'saving'=>$sav,'doc'=>$doc,'gua'=> $guarantor  ]);
    }

    public function showuserfields(Request $request)
    {    
        $datas = session()->get('data');
        session()->put('dataa', $datas);
        foreach($datas as $prod){
            $id = $prod->id;
            session()->put('ids', $id);
        }
       
        $idd = session()->get('ids');
        $key = $request['updateKey'];
        $request->session()->put('productkey', $request['updateKey']);
        $val = DB::select("SELECT $key FROM users WHERE id = $id");
        foreach($val as $v){
            session()->put('val', $v->$key);
        } 
        return back();          
    }


    public function updateclientinfo(Request $request)
    {  
       $data = session()->get('dataa');
       //return $data;
       $bid = Auth::user()->bid;
        $val = session()->get('val');
        session()->put('produ', $data);
       
        foreach($data as $key){
            $userid = $key->userid;
           
        }
        $productkey = session()->get('productkey');
        $fieldname = $request['fieldname'];
        DB::table('users')->where('userid', $userid)->where('bid',$bid)->update([$productkey=>$fieldname]);   
         $request->session()->forget('data');
         $request->session()->forget('val');   
        return back()->with('success', 'Updated Successfully');       
    }

    public function clearalltransac(Request $request){
        $userid =  $request['cleartransact'];
        $id = Auth::user()->userid;
        $bid = Auth::user()->bid;
        $password = $request['password'];
        $data = DB::table('users')->where('bid',$bid)->where('userid',$id)->get();
        foreach($data as $key){
            $pass = $key->password;
        }
        if(password_verify($password,$pass)){
            $sql1 = DB::select("DELETE FROM loan WHERE userid='$userid' AND bid ='$bid'");
            $sql2 = DB::select("DELETE FROM savings WHERE userid='$userid' AND bid ='$bid'");
            $sql3 = DB::select("DELETE FROM invacc WHERE userid='$userid' AND bid ='$bid'");
            return back()->with('success', 'Operation Successful');
        }else{
            return back()->with('error', 'Incorrect Password');
        }

    
        

    }


    public function deleteclient(Request $request){
        $userid = $request['DeleteClient'];
        $bid = Auth::user()->bid;
        $id = Auth::user()->userid;
        $password = $request['password'];
        $data = DB::table('users')->where('bid',$bid)->where('userid',$id)->get();
        foreach($data as $key){
            $pass = $key->password;
        }
        if(password_verify($password,$pass)){
            $sql = DB::select("DELETE FROM users WHERE userid='$userid' AND bid ='$bid'");
            if($sql){
                return redirect('admindashboard')->with('success', 'Client Successfully Deleted');
            }
        }else{
            return back()->with('error', 'Incorrect Password');
        }
       
    }

    public function adminstore(Request $request)
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
        $userid = $request->input('UploadDoc');
        $datas = DB::table('users')->where('userid', $userid)->get('bid');
        foreach($datas as $data){
            $bid = $data->bid;
        }
        $user->userid = $userid;
        $user->bid = $bid;
        $user->rep = auth()->user()->userid;
        $user->title = $request->input('title');
        $user->note = $request->input('note');
        $user->doc = $fileNameToStore;
        $user->save();
        if($user->save()){
            return redirect('viewclientprofile')->with('success','Document Uploaded');
        }else{
            return redirect('viewclientprofile')->with('error','Document Upload Declined');
        }       
    }

    public function adminGuarantor(Request $request)
    {
        $user = new Guarantor();
        $userid = $request->input('AddGuarantor'); 
        $datas = DB::table('users')->where('userid', $userid)->get('bid');
        foreach($datas as $data){
            $bid = $data->bid;
        }
        $user->userid = $userid;
        $user->bid = $bid;
        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->note = $request['note'];
        $user->rep = Auth::user()->userid;   
        $user->save();
        return redirect('viewclientprofile')->with('success', 'Guarantor details submitted successfully');
    }


    public function showclientinfo(Request $request){
        $id = $request->input('updateKey');
        $pro = DB::table('user')->where('id', $id)->get();
        $request->session()->put('pro', $pro);
        return back()->with(array('prod'=> $pro) );
    }



}
