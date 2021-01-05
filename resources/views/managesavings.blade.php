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
          <h1 class="m-0 text-dark">Savings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Savings Account</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Savings Account Details </h3>
        </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-4  table-responsive">
        <h4>SAVINGS STATISTICS </h4>
        <table class="table">
            @foreach($savings as $data)
              <tr><th>Transaction ID</th><td>{{$data->ref}}</td></tr>
              <tr><th>Savings Status</th><td><?php echo $status ?></td></tr>
              <tr><th>Periodic Amount</th><td>₦{{number_format($data->amount, 2)}}</td></tr>                 
              <tr><th>Yearly Interest Rate</th><td>{{$data->rate}}%</td></tr>
              <tr><th>Periodic Cycle</th><td>{{$data->period}} Days</td></tr>                 
              <tr><th>Savings Application Date</th><td>{{date('jS M, Y', strtotime($data->created_at))}}</td></tr>
                @if($data->status>1)
                <tr><th>Activation Date</th><td><?php echo date('jS M, Y',$data->start) ?> </td></tr>
                @if($data->status == 3)
                <tr><th>Expiry Date</th><td><?php echo date('jS M, Y',$data->stop) ?> </td></tr>
                @endif
                @if($data->status ==2)
                <?php $expect = ceil(abs(time()-$data->start)/(60*60*24*$data->period)) ?>
              <tr><th>Account Age</th><td>{{ $expect }} Cycles</td></tr>
              <tr><th>Expected Payment</th><td>₦<?php $expected = $fin->expectedCycles($data->ref)*$fin->saveNam($data->ref);
               echo number_format($expected,2) ?></td></tr>
              <tr><th>Outstanding Payment</th><td>₦<?php $paid = $fin->walletLoan($data->userid,$data->ref,14); echo number_format($expected-$paid,2); ?> </td></tr>
               @endif
                <tr>
                <th>Total Liquidated</th>
                <td>₦<?php $liq = $fin->walletLoan($data->userid,$data->ref,5)+$fin->walletLoan($data->userid,$data->ref,9);
                echo number_format(abs($liq),2); ?> </td>
                </tr>
                <tr><th>Total Deposit Received</th><td>₦<?php $paid = $fin->walletLoan($data->userid,$data->ref,14); echo number_format($paid,2); ?> </td></tr>
                <tr><th>Accrued Interest</th><td>₦<?php $int = $data->status==2 ? $fin->totalSavInt
                ($data->ref) : $fin->walletLoan($data->userid,$data->ref,17);  echo number_format($int,2); ?> </td></tr>
                <tr>
                <th>Total Value</th>
                <td><?php $int = $data->status==3 ? $fin->totalInvInt($data->ref) : $fin->walletLoan($data->userid,$data->ref,17);; 
               echo number_format($paid+$int-abs($liq),2); ?> </td>
               </tr>
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
                <th>REMARK</th>
                <th>RECEIVED BY</th>
              </tr>
            <?php   
               $e=0; 
               foreach($ccount as $count){                  
               $e++
            ?>         
            <tr>
              <td><?php echo $e; ?></td>
              <td><?php echo number_format(abs($count->cos),2) ?></td>
              <td><?php echo date('jS M, Y',$count->ctime); ?></td>
              <td><?php echo $fin->walletRemark($count->type);?></td>
              <td><?php echo $fin->uName($count->rep);?></td>
              </tr>
             <?php } ?>
          </table>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php if($data->status <3){ ?>
        <button class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-edit" > EDIT SAVINGS INFORMATION</button>
        <?php } ?>

        <?php if($data->status==1 ){ ?>
        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete" > DELETE SAVINGS ACCOUNT </button> 
        <?php } ?> 

        <?php if($data->status<3){ ?>
          <?php   $data1 = session()->get('amount');
          if($data1){   ?>
        <form method="POST" action="{{ route('paynew') }}" accept-charset="UTF-8" >
          <input type="hidden" name="email" value="oluwatobiijaware@gmail.com">{{-- required --}}
              
          <input type="hidden" name="amount" value=" {{$data1}}"> {{-- required in kobo --}}
          {{-- <input type="hidden" name="quantity" value="1"> --}}
          <input type="hidden" name="currency" value="NGN">
          <input type="hidden" name="metadata" value="3">{{-- For other necessary things you want to add to your payload. it is optional though --}}
        
          <input type="hidden" name="refer" value="{{$data->ref}}">{{-- required --}}
          {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
          {{-- {{ csrf_field() }} works only when using laravel 5.1, 5.2 --}}

          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          <button style="float: right" class="btn btn-outline-success" type="submit">Proceed to Paystack</button>
          </form>
        <?php }else{ ?>
        <button style="float: right" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-payment">MAKE SAVINGS PAYMENT </button>  
        <?php } } ?>   
    </div>
</div>
</div> 


      <div class="modal modal-warning fade" id="modal-delete">
        <form method="post" action="{{ route('DeleteSavings')}}">
            @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Warning!!!</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete savings account?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             <button type="submit" value="{{$data->ref}}" class="btn btn-outline-danger" name="DeleteSavings">Yes, Delete Savings Account</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        </form>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    
         <div class="modal fade" id="modal-payment">
            <form method="post" action="/getreadytopay" accept-charset="UTF-8">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                     <h4 class="modal-title">Savings Payment  [Deposit: ₦{{ number_format($data->amount,2)}}]</h4>
                    </div>
                    <div class="modal-body">
                     
                    <label>Amount to Pay</label>
                    <input type="number" name="payamount" value="" 
                    class="form-control" placeholder="Enter Amount" 
                    style="font-size: 20px; padding: 0 12px" required>
                   
                  
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" value="{{$data->ref}}" class="btn btn-outline-primary" name="CardSavingsPayment">MAKE PAYMENT</button>
                    </div>
                  </div>
                </form>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
      
             
             <div class="modal fade" id="modal-edit">
                <form method="post" action="{{ route('updatesavings') }}">
                    @csrf
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title">Modify Savings Information</h4>
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
                     <option value="{{ $data->period }}">{{ $data->period }} Days</option>
                     <option value="7">7 Days</option>
                     <option value="30">30 Days</option>                
                     </select>                 
                   </div>
               </div>
               <div class="modal-footer">
                     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-outline-warning" value="{{ $data->ref }}" name="Editsavings"> Edit Savings Information </button>
               </div>
           </div>
        </form>
         </div>
       </div>
     



@endsection