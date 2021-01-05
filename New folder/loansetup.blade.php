@extends('layouts.adminheadside')
@section('content')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Setup
            <small>Loan Information</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Setup</a></li>
            <li class="active">Loan Setup</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
      
    
          <!-- SELECT2 EXAMPLE -->
          <div class="row">
            <div class="col-md-8">
            <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Loan Information</h3><br><br>
                 <form method="post" enctype="multipart/form-data" action="{{ route('showproducts') }}">
                @csrf
                    <select name="productkey" onchange="submit()" class="form-control"  required >
                      {{-- <option value="" disabled selected>Select Option... </option> --}}
                      <option><?php $prod = session()->has('pro') ? session()->get('pro') : ''?>
                      <?php if($prod){ echo $prod;}else{ echo 'Select Option...'; }
                      ?></option>                      
                          @foreach($products as $product)
                            <option  value="{{$product->id}}">{{$product->product }}</option>
                          @endforeach
                    </select>
                </form>
            </div>
            <!-- /.box-header -->
            <?php $data = session()->get('data');
                 if($data){ ?>
            <div class="box-body  table-responsive">
                  <table class="table">
                  
                    <tr><th>Product Title</th><td>{{$data->product}}</td></tr> 
                    <tr><th>Product Type</th><td>{{$data->type}}</td></tr>
                    <tr><th>Minimum Range</th><td>₦{{number_format($data->min,2)}}<td></tr> 
                    <tr><th>Maximum Range</th><td>₦{{number_format($data->max,2)}}</td></tr>
                    <tr><th>Interest</th><td>{{$data->interest}}%</td></tr> 
                    <tr><th>Processing Fee</th><td>{{$data->profee}}%</td></tr>
                    <tr><th>Penalty for Defaulting</th><td>{{$data->penalty}}%</td></tr> 
                    <tr><th>Require Collateral</th><td>{{$data->collateral}}</td></tr> 
                        
                  </table>
            </div> 
            <?php } ?>                        
          </div>
        </div>
              <!-- /.row -->
          <div class="col-md-4">
           <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Update Loan Information</h3>            
            </div>
            <!-- /.box-header -->
            <div class="box-body">             
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
            
            <div class="box-header with-border">
              <h3 class="box-title">Add New Product</h3>            
            </div>
            <!-- /.box-header -->
            <div class="box-body">   
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
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
   
    </div>
@endsection 