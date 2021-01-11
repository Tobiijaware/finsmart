@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Loan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create Loan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Loan Application</h3>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="/calculate">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Loan Type</label>
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
                      <label>Loan Amount</label>
                      <input type="number"name="amount" id="Text1" class="form-control" placeholder="Enter Loan Amount" required >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Loan Tenure</label>
                        <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
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
                    <button type="submit" name="LoanDetails" class="btn btn-outline-primary btn-block"> Calculate Loan Details
                    </button>
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
                <h3 class="card-title">Loan Details</h3>
            </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-4  table-responsive">
            <h4>LOAN STATISTICS</h4>
            <form action="{{route('submitloan')}}" method="POST">
            @csrf
            <input type="hidden" name="amount" value="{{session()->get('amount')}}">
            <input type="hidden" name="tenure" value="{{session()->get('tenure')}}">
            <table class="table">
                <tr><th>Loan Amount</th><td>₦ {{number_format(session()->get('amount'))}}</td></tr>
                <tr><th>Interest Rate</th><td>{{$data->interest}}%</td></tr>
                <tr><th>Loan Tenure</th><td>{{session()->get('tenure')}} Days</td></tr>
                <tr><th>Penalty Fee</th><td>₦<?php echo number_format($data->penalty*session()->get('amount')/100,2)?></td></tr>
                <tr><th>Interest Value</th><td>₦<?php
                $int = session()->get('amount')*$data->interest*session()->get('tenure')/100/30;
                 echo number_format($int,2) ?></td></tr>
                <tr><th>Expected Repayment</th><td>₦<?php
                $exp = session()->get('amount') + $int;  echo number_format($exp,2) ?></td></tr>
                <tr><th>Monthly Repayment</th><td>₦<?php  echo number_format($exp*30/session()->get('tenure'),2) ?>
                (<?php $tranches = session()->get('tenure')/30;  echo $tranches ?>)</td></tr>
                <tr><th>Processing Fee</th><td><?php $pro = session()->get('amount') *$data->profee/100;
                 echo number_format($pro,2) ?>
                (<?php echo $data->profee ?>%)</td></tr>
            </table>
            </div>
            <div class="col-md-6  table-responsive">
                <h4>REPAYMENT SCHEDULE</h4>
                <table class="table">
                  <tr><th>INSTALMENT</td><th>REPAYMENT</th><th>DUE DATE </td></tr>
                  <?php $i=1 ; $ctime = time();
                  while($i<=$tranches){ $e=$i++; $ctime += 60*60*24*30; ?>
                    <tr><td>Instalment <?php echo $e ?></th><td><?php  echo number_format($exp*30/session()->get('tenure'),2) ?></td><td><?php echo date('jS M, Y',$ctime) ?></td></tr>
             <?php } ?>
                  </tr>
                </table>
              </div>
            </div>
              <div class="col-md-12">
                <button type="submit" style="float: right" class="btn btn-outline-primary btn-md"> SUBMIT APPLICATION</button>
              </div>
            </form>
        </div>
      </div>
    </div>
    <?php } ?>

@endsection
