<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Createloan;
use App\Product;
use Illuminate\Http\Request;

class manageloanController extends Controller
{
    public function loansetup()
    {
        $product = DB::table('productsetup')->get()->where('type', 1)->where('bid', bid());  
                 
        return view('admin/loansetup')->with(array('products'=> $product));
    }

    public function showproducts(Request $request)
    {                 
        $id = $request->input('productkey');
        $data = DB::table('productsetup')->where('id', $id)->where('bid', bid())->get();       
        $request->session()->put('data', $data);
        return back()->with(array('dataa'=> $data));
       

      
    }

    public function showfields(Request $request)
    {    
        // $id = $request->input('productkey');
        // $pro = DB::table('productsetup')->where('id', $id)->get();
        // $request->session()->put('pro', $pro);
        // return back()->with(array('prod'=> $pro) );

        $datas = session()->get('data');
        //return $data;
        foreach($datas as $data){
            $id =  $data->id;
            $bid = $data->bid;
        }
        $key = $request['productKey2'];
        
        $request->session()->put('productkey', $request['productKey2']);
        $val = DB::select("SELECT $key FROM productsetup WHERE id = $data->id AND bid='$bid'");
        foreach($val as $v){
            session()->put('val', $v->$key);
        }            
        return redirect()->route('loansetup');          
    }

    public function updateloan(Request $request)
    {  
        $bid = bid();
        $data = session()->get('data');
        $val = session()->get('val');
        foreach($data as $dat){
            $id =  $dat->id;
        }
        $productkey = session()->get('productkey');
        $fieldname = $request['fieldname'];
        DB::table('productsetup')->where('id', $id)->where('bid', $bid)->update([$productkey=>$fieldname]);
        $request->session()->forget('data'); 
        $request->session()->forget('val');       
        return redirect()->route('loansetup')->with('success', 'Updated Successfully');       
    }

    public function createloansetup(Request $request)
    {     
        
         $loanset = new Product();
          $loanset->product = $request['product'];
          $loanset->min = $request['min'];
          $loanset->max = $request['max'];
          $loanset->type = $request['type'];        
          $loanset->profee = $request['profee'];
          $loanset->interest = $request['interest'];
          $loanset->penalty = $request['penalty'];
          $loanset->collateral = $request['collateral'];
          $loanset->rep = auth()->user()->userid;
          $loanset->bid = bid();
          $loanset->save();        
          if($loanset->save()){
              return redirect('/loansetup')->with(['success'=>'Product Successfully Added']);
          }
      }



}
