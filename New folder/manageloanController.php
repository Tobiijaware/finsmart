<?php

namespace App\Http\Controllers;
use DB;
use App\Createloan;
use App\Product;
use Illuminate\Http\Request;

class manageloanController extends Controller
{
    public function loansetup()
    {
        $product = DB::table('productsetup')->get()->where('type', 1);  
                 
        return view('admin/loansetup',['products'=>$product]);
    }

    public function showproducts(Request $request)
    {                 
        $data = Createloan::find($request['productkey']);
        $product = $data->product;
        session()->put('pro', $product);        
        $request->session()->put('data', $data);
        return redirect()->route('loansetup')->with('message',$data);          
    }

    public function showfields(Request $request)
    {    
        $data = session()->get('data');
        $key = $request['productKey2'];
        $request->session()->put('productkey', $request['productKey2']);
        $val = DB::select("SELECT $key FROM productsetup WHERE id = $data->id");
        foreach($val as $v){
            session()->put('val', $v->$key);
        } 
             
        return redirect()->route('loansetup');          
    }

    public function updateloan(Request $request)
    {  
        $data = session()->get('data');
        $productkey = session()->get('productkey');
        $fieldname = $request['fieldname'];
        DB::table('productsetup')->where('id', $data->id)->update([$productkey=>$fieldname]);       
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
          $loanset->save();        
          if($loanset->save()){
              return redirect('/loansetup')->with(['success'=>'Product Successfully Added']);
          }
      }



}
