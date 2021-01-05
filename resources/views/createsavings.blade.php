@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Savings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create Savings</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Savings Application</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('submitsaving')}}">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Savings Type</label>
                          <select name="productkey" class="form-control" required >
                            <option value="" disabled selected> Select Option...</option>
                                @foreach($products as $product)
                            <option  value="{{$product->id}}">{{$product->product }}</option>
                                @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Periodic Savings Amount</label>
                      <input type="number" name="amount" id="Text1" class="form-control" placeholder="Enter Savings Amount" required >                
                    </div>
                  </div>
          
                  <div class="col-md-4">
                   <div class="form-group">
                      <label>Savings Periodic Cycle</label>
                      <select name="tenure" class="form-control select2" id="Text3" required>
                      <option value="">Select Option...</option>
                      <option value="1">1 Day</option>
                      <option value="7">7 Days</option>
                      <option value="30">30 Days</option>                
                      </select>                 
                    </div>
                </div>
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <div class="form-group">            
                      <button type="submit" class="btn btn-outline-primary btn-block"> Create New Savings Plan</button>                
                    </div>
                  </div>
            </div>
            </form>
        </div>
    </div>
    </div>  
    </div>

@endsection