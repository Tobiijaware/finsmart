<?php

namespace App\Http\Controllers;
use DB;
use App\Product;
use App\Createloan;
use Validator;
use Illuminate\Http\Request;

class ManageSavingsController extends Controller
{
    public function viewmanagesavings(){
        $product = DB::table('productsetup')->get()->where('type', 2)->where('bid', bid());
        return view('admin/setupsavings')->with(array('products'=> $product));
    }

    public function savingsinformation(Request $request){
        $id = $request->input('productkey');
        $pro = DB::table('productsetup')->where('id', $id)->where('bid', bid())->get();
        $request->session()->put('pro', $pro);
        return back()->with(array('prod'=> $pro) );
    }


    public function newProduct(Request $request){
        $validate =  Validator::make($request->all(), [
            'product' => ['required', 'string'],
            'min' => ['required', 'integer'],
            'max' => ['required', 'integer'],
            'interest' => ['required', 'integer'],
        ])->validate();

        $newproduct = new Product();
        $newproduct->type = 2;
        $newproduct->product = $request->input('product');
        $newproduct->min = $request->input('min');
        $newproduct->max = $request->input('max');
        $newproduct->interest = $request->input('interest');
        $newproduct->rep = auth()->user()->userid;
        $savings->bid = bid();
        $newproduct->save();

        if($newproduct->save()){
            return back()->with('success', 'New Product Added');
        }else{
            return back()->with('error', 'Operation Failed');
        }
    }

    public function showsavingsfields(Request $request)
    {    
        $prods = session()->get('pro');
        session()->put('produ', $prods);
        foreach($prods as $prod){
            $id = $prod->id;
            session()->put('ids', $id);
        }
        $idd = session()->get('ids');
        //return $idd;
        $key = $request['productKey2'];
        $request->session()->put('productkey', $request['productKey2']);
        $val = DB::select("SELECT $key FROM productsetup WHERE id = $id");
        foreach($val as $v){
            session()->put('val', $v->$key);
        }             
        return back();          
    }

    public function updatesavings(Request $request)
    {  
        $prods = session()->get('pro');
        
        $val = session()->get('val');
        session()->put('produ', $prods);
        foreach($prods as $prod){
            $id = $prod->id;
            session()->put('ids', $id);
        }
        $productkey = session()->get('productkey');
        $fieldname = $request['fieldname'];
        DB::table('productsetup')->where('id', $id)->where('bid', bid())->update([$productkey=>$fieldname]);   
         $request->session()->forget('pro');
         $request->session()->forget('val');   
        return back()->with('success', 'Updated Successfully');       
    }
}
