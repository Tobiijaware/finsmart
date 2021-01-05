@extends('layouts.sapp')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Investment Account</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Investment Account Details </h3>
        </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-4  table-responsive">
        <h4>INVESTMENT STATISTICS </h4>
        @foreach($invest as $data)
             <table class="table">
             <tr><th>Transaction ID</th><td>{{$data->ref}}</td></tr>
             <tr><th>Investment Status</th><td>@php echo $status @endphp</td></tr>
                <tr><th>Investment Amount</th><td>₦{{number_format($data->amount,2)}}</td></tr> 
                <tr><th>Investment Tenure</th><td>{{$data->tenure}} Days</td></tr>
                 @if($data->status==3)
              <tr><th>Investment Age</th><td>{{$data->start}} Days</td></tr>
                 @endif 
                <tr><th> Interest Value</th><td>₦{{number_format($data->interest,2)}}</td></tr>
                 <tr><th>Total Return</th><td>₦<?php $exp = $data->amount+$data->interest; 
                 echo number_format($exp,2) ?></td></tr>              
                  <tr><th>Application Date</th><td><?php echo date('jS M, Y',strtotime($data->created_at)) ?> </td></tr>
                @if($data->status>2)
                  <tr><th>Activation Date</th><td>{{date('jS M, Y',$data->start) }}</td></tr>                 
                  <tr><th>Expiry Date</th><td>{{date('jS M, Y', $data->stop) }}</td></tr>
                  @if($data->status==4)
                  <tr><th>Termination Date</th><td>{{$termination}}</td></tr> 
                   @endif
                  <tr><th>Accrued Interest</th><td>₦<?php $int = $data->status==3 ? $totalinv : 
                  $walletLoan;  echo number_format($int,2); ?></td></tr>
                @endif
              @endforeach
                </table> 
        </div>
        <div class="col-md-6  table-responsive">
            <h4>TRANSACTION HISTORY</h4>
            <table class="table">
                <tr>
                  <th>SN</th>
                  <th>DEPOSIT</th>
                  <th>PAYMENT DATE </th>
                  <th>PROCESSED BY</th>
                </tr>
              <?php   
                 $e=0; 
                 foreach($ccount as $count){                  
                 $e++
              ?>         
              <tr>
                <td><?php echo $e; ?></td>
                <td><?php echo number_format($count->cos,2) ?></td>
                <td><?php echo date('jS M, Y',$count->ctime); ?></td>   
                <td><?php echo $fin->uName($count->rep);?></td>
              </tr>
               <?php } ?>
            </table>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        @if($data->status==1)
        <button class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-edit" > EDIT INVESTMENT INFORMATION</button>
        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete" > DELETE INVESTMENT ACCOUNT</button> 
       @endif 
       @if($data->status==2)
          <button style="float: right" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-payment"> PAY INVESTMENT DEPOSIT </button>  
       @endif
    </div>
</div>
</div> 



     <div class="modal modal-warning fade" id="modal-delete">
        <form method="post" action="{{ route('DeleteInvestment')}}">
            @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Warning!!!</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete investment account?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-danger" name="DeleteInvestment" value="{{$data->ref}}">
                Yes, Delete</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    

    
   
        <div class="modal fade" id="modal-payment">
            <form method="POST" action="{{ route('paynew') }}" accept-charset="UTF-8" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Investment Payment  </h4>
                </div>
                <div class="modal-body">
            <input type="hidden" name="email" value="oluwatobiijaware@gmail.com"> {{-- required --}}
            {{-- <input type="hidden" name="quantity" value="1">--}}
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="metadata" value="4" >{{-- For other necessary things you want to add to your payload. it is optional though --}}
          
            <input type="hidden" name="refer" value="{{ $data->ref }}"> {{-- required --}}
            {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
            {{-- {{ csrf_field() }} works only when using laravel 5.1, 5.2 --}}
  
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <input type="hidden" name="amount" value="<?php echo $data->amount*100 ?>" class="form-control" 
                 placeholder="Enter Amount" style="font-size: 20px; padding: 0 12px" readonly required>
                 <input type="text" value="<?php echo $data->amount ?>" class="form-control" 
                style="font-size: 20px; padding: 0 12px" readonly required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-primary" name="MyInvPayment">MAKE PAYMENT</button>
                </div>
            </form> 
              </div>
            </div>
          </div>
         
         
          <div class="modal fade" id="modal-edit">
            <form method="post" action="{{ route('updateinvestment') }}">
                @csrf
                @method('PUT')
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                   <h4 class="modal-title">Modify Investment Information</h4>
                </div>
            <input type="hidden" name="_method" value="PUT">  
            <div class="modal-body"> 
                <div class="form-group">
                  <label>Periodic Savings Amount</label>
                  <input type="number" name="amount" id="Text1" class="form-control" placeholder="Enter Savings Amount" required value="{{ $data->amount }}">                
                </div>
                
                <div class="form-group">
                  <label>Savings Periodic Cycle</label>
                  <select name="tenure" class="form-control select2" id="Text3" required>
                  <option value="{{ $data->tenure }}">{{ $data->tenure }} Days</option>
                  <option value="90">90 Days</option>
                  <option value="180">180 Days</option>
                  <option value="270">270 Days</option>
                  <option value="360">360 Days</option>               
                  </select>                 
                </div>
            </div>
            <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-warning" value="{{ $data->ref }}" name="Editinvestment"> Edit Investment Information </button>
            </div>
        </div>
    </form>
      </div>
    </div>
  
  
@endsection