@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Savings Setup</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Savings Setup</li>
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
                <h3 class="card-title">Savings Information</h3>
            </div>
            
        </div>
        <div class="card-header">
           
          <form method="post" action="/savingssetup">
            @csrf
            <select name="productkey" class="form-control" onchange="submit()" id="displaybtn" required >
              <option value="" disabled selected> Select Option...</option>
                  @foreach($products as $product)
              <option  value="{{$product->id}}">{{$product->product }}</option>
                  @endforeach
            </select>
          </form>
        </div>
        <?php $prod = session()->get('prod'); ?>
            @if($prod)
        <div class="card-body">
          <table class="table">
                  
            @foreach($prod as $pro)
        
          <tr><th>Product Title</th><td>{{$pro->product}}</td></tr> 
             <tr><th>Product Type</th><td>{{$pro->type}}</td></tr>
             <tr><th>Minimum Range</th><td>₦{{$pro->min}}</td></tr> 
             <tr><th>Maximum Range</th><td>₦{{$pro->max}}</td></tr>
             <tr><th>Monthly Interest Rate</th><td>{{$pro->interest}}%</td></tr> 
           @endforeach
          
          </table>

        </div>
        @endif
    </div>
    </div>  
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Savings Information</h3>
                
            </div>
            <div class="card-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('showsavingsfields') }}">
                @csrf
                  <div class="form-group">
                    
                    <div class="col-sm-12"><label>Setup Field</label>
                      <select name="productKey2" class="form-control" onchange="submit()" required >
                        <?php $details = session()->get('val');?>
                        <?php 
                    $pro = session()->has('productkey') ? session()->get('productkey') : ''?>
                    
                        <option value=""> Select Field...</option>
                        <option value="product" <?php echo $pro=='product'?$details:'' ?>> Product Title</option>
                        <option value="min" <?php echo $pro=='min'?$details:'' ?>> Minimum Range</option>
                        <option value="max" <?php echo $pro=='max'?$details:'' ?>> Maximum Range</option>            
                        <option value="interest" <?php echo $pro=='interest'?$details:'' ?>>Monthly Interest Rate</option>                       
                      </select>
                    </div>
                  </div>
                </form>
                <form class="form-horizontal" method="post" action="/updatesavings">
                  @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" value="{{session()->get('val') ?? ''}}" class="form-control" name="fieldname" placeholder="Setup Field">
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
                <h3 class="card-title">Update Savings Information</h3>
            </div>
            <div class="card-body">
              <form method="post" action="/addnewsavingsproduct">
                @csrf
                <label>Product Title</label>
                  <input type="text" name="product" placeholder="Product Title" class="form-control">
                  <br>
                  <input type="hidden" name="type" value="2">
                  <label>Minimum Range Amount</label>
                  <input type="number" name="min" placeholder="Minimum Amount" class="form-control">
                  <br>
                   <label>Maximum Range Amount</label>
                  <input type="number" name="max" placeholder="Maximum Amount" class="form-control">
                  <br>
                  <label>Monthly Interest Rate (%)</label>
                  <input type="text" name="interest" placeholder="Interest" class="form-control">
                 <br>
                
                  <button type="submit" class="btn btn-primary btn-block" name="AddProduct">Add New Product</button>
              </form>
            </div>
        </div>
        </div>  
</div>
   


@endsection