@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create Investment</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Investment Applications</h3>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{ route('calculateInvest') }}">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Investment Package</label>
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
                      <label>Investment Amount</label>
                      <input type="number" min="" max="" name="amount" id="Text1" class="form-control" placeholder="Enter Amount" required >

                    </div>
                    </div>
                  <div class="col-md-4">
                   <div class="form-group">
                      <label>Investment Tenure</label>
                      <select name="tenure" class="form-control select2"  required>
                      <option value="">Select Tenure...</option>
                          <option value="30">30 Days</option>
                          <option value="60">60 Days</option>
                          <option value="90">90 Days</option>
                          <option value="120">120 Days</option>
                          <option value="150">150 Days</option>
                          <option value="180">180 Days</option>
                          <option value="210">210 Days</option>
                          <option value="240">240 Days</option>
                          <option value="270">270 Days</option>
                          <option value="300">300 Days</option>
                          <option value="330">330 Days</option>
                          <option value="360">360 Days</option>
                      </select>

                    </div>
                  </div>
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-outline-primary btn-block">Calculate Investment Details</button>
                    </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>

    <?php $data = session()->get('data');
    if($data){ ?>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Investment Details</h3>
            </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-4  table-responsive">
            <h4>INVESTMENT STATISTICS</h4>
            <form method="post" enctype="multipart/form-data" action="{{route('submit')}}">
                @csrf
                <input type="hidden" name="amount" value="{{session()->get('amount')}}">
                <input type="hidden" name="tenure" value="{{session()->get('tenure')}}">
                <table class="table">
                    <tr><th>Investment Tenure</th><td>{{session()->get('tenure')}} Days</td></tr>
                    <tr><th>Monthly Interest Rate</th><td><?php echo $data->interest ?>%</td></tr>
                    <tr><th>Yearly Interest Rate</th><td><?php echo $data->interest*12 ?>%</td></tr>
                    <tr><th>Interest Value</th><td>₦<?php
                      $int = session()->get('amount')*$data->interest*session()->get('tenure')/100/30;
                       echo number_format($int,2) ?></td></tr>
                    <tr><th>VAT on Investment Interest</th><td><?php $vat = $int*$data->vat/100;   echo number_format($vat,2) ?> (<?php echo $data->vat ?>%)</td></tr>
                     <tr><th>Total Return</th><td><?php $exp = session()->get('amount')+$int-$vat; echo number_format($exp,2) ?></td></tr>
                  </table>
            </div>

            </div>
            <div class="col-md-12">
                <button style="float: right" class="btn btn-outline-primary btn-md" type="submit">
                    SUBMIT INVESTMENT APPLICATION</button>
              </div>
            </form>
        </div>
    </div>
    </div>
    <?php } ?>

@endsection
