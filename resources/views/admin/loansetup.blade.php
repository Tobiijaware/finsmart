@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Loan Setup</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Loan Setup</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="row">
    <div class="col-8">
    <div class="card">
        <div class="card-header">
            <div class="mb-3" style="margin-bottom: 5px!important;">
                <h3 class="card-title">Loan Information</h3>
            </div>
            
        </div>
        <div class="card-header">
            <form method="post" enctype="multipart/form-data" action="{{ route('showproducts') }}">
                @csrf
                <select name="productkey" onchange="submit()" class="form-control"  required >
                  <option value="" disabled selected>Select Option... </option> 
                                        
                      @foreach($products as $product)
                        <option  value="{{$product->id}}">{{$product->product }}</option>
                      @endforeach
                </select>
            </form>
        </div>
        <?php $data = session()->get('dataa');
        if($data){ ?>
        <div class="card-body">
            <table class="table">
                @foreach($data as $dat)
                 <tr><th>Product Title</th><td>{{$dat->product}}</td></tr>
                 <tr><th>Product Type</th><td>{{$dat->type}}</td></tr>
                 <tr><th>Minimum Range</th><td>₦{{number_format($dat->min,2)}}<td></tr> 
                 <tr><th>Maximum Range</th><td>₦{{number_format($dat->max,2)}}</td></tr>
                 <tr><th>Interest</th><td>{{$dat->interest}}%</td></tr> 
                 <tr><th>Processing Fee</th><td>{{$dat->profee}}%</td></tr>
                 <tr><th>Penalty for Defaulting</th><td>{{$dat->penalty}}%</td></tr> 
                 <tr><th>Require Collateral</th><td>{{$dat->collateral}}</td></tr> 
                @endforeach   
               </table>

        </div>
    <?php } ?>
    </div>
    </div>  
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Loan Information</h3>
                
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('showfields') }}">
                    @csrf
                        <div class="form-group">
                         <div class="col-sm-12"><label>Setup Field</label>
                           <select name="productKey2" class="form-control" onchange="submit()" required >
                             <?php 
                             $pro = session()->has('productkey') ? session()->get('productkey') : ''?>
                             <?php //if($pro){ echo $pro;}else{ echo 'Select Field'; }
                             ?><option>Select Field</option> 
                             <option value="product" <?php echo $pro=='product'?'selected':'' ?>> Product Title</option>
                             <option value="min" <?php echo $pro=='min'?'selected':'' ?>> Minimum Range</option>
                             <option value="max" <?php echo $pro=='max'?'selected':'' ?>> Maximum Range</option>                          
                             <option value="interest" <?php echo $pro=='interest'?'selected':'' ?>> Interest</option>
                             <option value="profee" <?php echo $pro=='profee'?'selected':'' ?>> Processing Fee</option>
                             <option value="penalty" <?php echo $pro=='penalty'?'selected':'' ?>> Default Penalty</option>                          
                             <option value="collateral" <?php echo $pro=='collateral'?'selected':'' ?>>Request Collateral</option>
                           </select>
                         </div>
                       </div>
                   </form>
                   <form class="form-horizontal" method="post" action="{{route('updateloan')}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <input type="text"
                         value="<?php $keyval = session()->has('val') ? session()->get('val') : '';
                         if($keyval){ echo $keyval ;}?>"
                         class="form-control" name="fieldname" placeholder="Setup Field">
                      </div>
                    </div>
      
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block" name="UpdateProductSetup">Update Profile</button>
                          </div>
                        </div>
                    </form>
                   
                
    
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Loan Information</h3>
            </div>
            <div class="card-body">
                <form method="post" action="\createloansetup">
                    @csrf
                      <label>Product Title</label>
                        <input type="text" name="product" placeholder="Product Title" class="form-control">
                        <br>
                        <input type="hidden" name="type" value="1">   
                        <label>Minimum Range Amount</label>
                        <input type="number" name="min" placeholder="Minimum Amount" class="form-control">
                        <br>
                         <label>Maximum Range Amount</label>
                        <input type="number" name="max" placeholder="Maximum Amount" class="form-control">
                        <br>
                         <label>Interest (%)</label>
                        <input type="text" name="interest" placeholder="Interest" class="form-control">
                        <br>
                         <label>Processing Fee (%)</label>
                        <input type="text" name="profee" placeholder="Processing Fee" class="form-control">
                        <br>
                         <label>Default Penalty(%)</label>
                        <input type="text" name="penalty" placeholder="Penalty Fee" class="form-control">
                        <br>                 
                        <label>Require Collateral</label>
                                <select name="collateral" class="form-control" required >
                                  <option value=""> Select Option...</option>
                                  <option >NO</option>
                                  <option >YES</option>                          
                                </select><br>               
                        <button type="submit" class="btn btn-primary btn-block">
                        Add New Product</button>
                    </form>
            </div>
        </div>
        </div>  
</div>
   


@endsection