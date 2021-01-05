<?php

namespace App\Http\Controllers;
use DB;
use App\Product;
use App\Createloan;
use Validator;
use Auth;
use Illuminate\Http\Request;

class ManageInvestmentController extends Controller
{
    public function viewmanageinvestment(){
        $product = DB::table('productsetup')->get()->where('type', 3)->where('bid', bid());
        return view('admin/investmentsetup')->with(array('products'=> $product));
    }

    public function investmentinformation(Request $request){
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
            'penalty' => ['required', 'integer'],
            'vat' => ['required', 'integer'],
        ])->validate();

        $newproduct = new Product();
        $newproduct->product = $request->input('product');
        $newproduct->type = 3;
        $newproduct->min = $request->input('min');
        $newproduct->max = $request->input('max');
        $newproduct->interest = $request->input('interest');
        $newproduct->penalty = $request->input('penalty');
        $newproduct->vat = $request->input('vat');
        $newproduct->rep = auth()->user()->userid;
        $newproduct->bid = bid();
        $newproduct->save();

        if( $newproduct->save()){
            return back()->with('success', 'New Product Added');
        }else{
            return back()->with('error', 'Operation Failed');
        }
    }

    public function showinvestmentfields(Request $request)
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

    public function updateinvestment(Request $request)
    {  
        $prods = session()->get('pro');
        session()->put('produ', $prods);
        foreach($prods as $prod){
            $id = $prod->id;
            session()->put('ids', $id);
        }
        $productkey = session()->get('productkey');
        $fieldname = $request['fieldname'];
        DB::table('productsetup')->where('id', $id)->update([$productkey=>$fieldname]);       
        return back()->with('success', 'Updated Successfully');       
    }
}
