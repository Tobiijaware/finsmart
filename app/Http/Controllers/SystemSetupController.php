<?php
namespace App\Http\Controllers;
use DB;
use App\Flexible;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SystemSetupController extends Controller
{
    public function viewsystemsetup(Request $request){
        $userid = auth()->user()->userid;
       
        $data = DB::table('users')->where('userid', $userid)->get('bid');
        foreach($data as $key){
            $bid = $key->bid;
        }
        $cinfo = DB::table('setup')->where('bid', $bid)->get();
        $cdetail = $request->session()->put('cdetail', $cinfo);
        return view('admin/systemsetup')->with(['cdetails' => $cinfo, 'cdetail'=>$cdetail]);
    }

    public function showsetup(Request $request)
    {    
        $prods = session()->get('cdetail');
        session()->put('produ', $prods);
        foreach($prods as $prod){
            $bid = $prod->bid;
            session()->put('bids', $bid);
        }
        $idd = session()->get('bids');
        $key = $request['updateKey2'];
        $request->session()->put('key', $key);
        $val = DB::select("SELECT $key FROM setup WHERE bid = '$bid'");
        foreach($val as $v){
            session()->put('val', $v->$key);
        }             
        return back();          
    }

    public function update(Request $request)
    {  
        $prods = session()->get('cdetail');
        $val = session()->get('val');
        session()->put('produ', $prods);
        foreach($prods as $prod){
            $bid = $prod->bid;
            session()->put('bids', $bid);
        }
        $productkey = session()->get('key');
        $fieldname = $request['fieldname'];       
        $upd = DB::table('setup')->where('bid', $bid)->update([$productkey=>$fieldname]);   
         $request->session()->forget('cdetail');
         $request->session()->forget('val'); 
         if($upd){  
            return back()->with('success', 'Updated Successfully');       
         }else{
            return back()->with('error', 'Update Not Successful'); 
         }
    }

    public function viewsystemadmin(Request $request){
        $bid= auth()->user()->bid;
        $id= auth()->user()->userid;
        $iv = '';
        $ivv = '';
        $sql=DB::select("SELECT * FROM flexible Where bid = '$bid'");
        $ch = $this->adminName($id,'status')==2 ? 'checked' : 'no'; 
        $th = '<td class="text-center"><input type="radio" class="flat-red"'.$ch.' ></td>';
        return view('admin/admin')->with(['th'=> $ch, 'sql'=> $sql]);
    }

   public function addadmin(){
       $bid=auth()->user()->bid;
       $data= DB::select("SELECT * FROM flexible WHERE bid='$bid'");
       $data2 = DB::select("SELECT * FROM users WHERE bid='$bid' and is_admin=1");
       return view("admin.createadmin")->with(['admins'=> $data2, 'permi'=>$data]);
   }

    public function manageadmin(Request $request){
        $userid= $request['ManageAdmin'];
        $bid = Auth::user()->bid;
        $data2 = DB::select("SELECT * FROM users WHERE userid='$userid' AND bid='$bid'");
        $request->session()->put('data', $data2);
        return back();
    }

    public function searchadmin(Request $request){       
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

    public function systemP(Request $request){     
        $bid = $request['UpdateAdmin'];
        $userid = $request['userid'];
        $p = auth()->user()->password;
        $d = DB::table('users')->where('userid', $userid)->get();
        $status = 2;
        $l1 = $request['l1'];
        $l2 = $request['l2'];
        $l3 = $request['l3'];
        $l4 = $request['l4'];
        $l5 = $request['l5'];
        $s1 = $request['s1'];
        $s2 = $request['s2'];
        $s3 = $request['s3'];
        $i1 = $request['i1'];
        $i2 = $request['i2'];
        $i3 = $request['i3'];
        $i4 = $request['i4'];	
        $o1 = $request['o1'];
        $o2 = $request['o2'];
        $o3 = $request['o3'];
        $o4 = $request['o4'];
        $o5 = $request['o5'];
        $o6 = $request['o6'];
        $rep = auth()->user()->userid;
        $total=
        $l1+$l2+$l3+$l4+$l5+$s1 
        +$s2+$s3+$i1+$i2+$i3+$i4+$o1 
        +$o2+$o3+$o4+$o5+$o6; 
        $password = $request['password'];
        $ctime = time();
        if(password_verify($password, $p)){
            if($total !=0){
            $sql = DB::table('flexible')->where(['bid'=>$bid,'userid'=>$userid])->update(['l1'=>$l1, 'l2'=>$l2, 'l3'=>$l3, 'l4'=>$l4, 'l5'=>$l5 ,'s1'=>$s1, 's2'=>$s2, 
            's3'=>$s3, 'i1'=>$i1, 'i2'=>$i2, 'i3'=>$i3, 'i4'=>$i4, 'o1'=> $o1, 'o2'=>$o2, 'o3'=>$o3, 'o4'=>$o4, 'o5'=>$o5, 'o6'=>$o6, 'status'=>$status, 
            'ctime'=>$ctime, 'rep'=>$rep]);
                    if($sql){
                        $request->session()->forget('data');
                        return back()->with('success', 'Operation Successful');
                    }else{
                        return back()->with('error', 'Operation Failed');
                    }
            }
            else{
                $sql = DB::table('flexible')->where('bid', $bid)->update('status', 0);
            }   
        }
        else{
            return back()->with('error', 'Incorrect Password');
        }
    }

    public function addnewAdmin(Request $request){
        $userid = $request['addAdmin'];
        $data = DB::table('users')->where('userid', $userid)->get('bid');
        foreach($data as $key){
            $bid = $key->bid;
        }
        $admin = new Flexible();
        $admin->userid = $userid;
        $admin->bid = $bid;
        $admin->status =2;
        $admin->rep = auth()->user()->userid;
        $admin->ctime = time();
        $adminn= DB::select("SELECT * FROM flexible WHERE userid='$userid' AND bid='$bid'");
        $ad = count($adminn);
        if($ad>0){
            return back()->with('error', 'Admin Already Exists');
        }
        elseif($ad==0){
            $admin->save();
            return back()->with('success', 'Admin Added Successfully');
        }else{
            return back()->with('error', 'Operation Failed');
        }
    }

    public function deleteadmin(Request $request){
        $userid = $request['RemoveAdmin'];
        $password = $request['password'];
        $p = auth()->user()->userid;
        $d = DB::table('users')->where('userid', $p)->get();
        foreach($d as $key){
            $pass = $key->password;
        }
        $d = DB::table('users')->where('userid', $userid)->get();
        foreach($d as $key){
            $bid = $key->bid;
        }
        if(password_verify($password, $pass)){
            $sql = DB::table('flexible')->where(['userid'=> $userid, 'bid'=>$bid])->delete();
            if($sql){
                return back()->with('success', 'Admin Removed Successfully');
            }else{
                return back()->with('error', 'Operation Failed');
            }
        }else{
            return back()->with('error', 'Incorrect Password');
        }
    }


}
