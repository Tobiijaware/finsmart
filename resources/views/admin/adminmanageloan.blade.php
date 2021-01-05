@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Loans</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Loans</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
  {{-- <div class="card"> --}}
  {{-- <div class="col-lg-12"> --}}
  <div class="col-lg-12">
    <div class="card">
    <div class="card-header">
      
      <h4>LOAN CLIENT</h4>
      <h6>Loan Details</h6>
      <table id="example1"  class="table table-striped">
        <thead>
        <tr>
          <th>Surname</th>
          <th>Other Names</th>
          <th>E-mail</th>
          <th>Phone No</th>
          <th>Address</th>          
        </tr>
        </thead>
        <tbody>
          @foreach($user as $user)
          <td>{{$user->surname}}</td>
          <td>{{$user->othername}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->phone}}</td>
          <td>{{$user->address}}</td>
        </tr>              
        </tbody>
         @endforeach
      </table>
    </div>
    
  </div>

  </div>
 
  {{-- </div> --}}
  {{-- </div> --}}
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="row">
      <div class="col-md-6  table-responsive">
        <div class="card-header">
          <h4>LOAN STATISTICS</h4>
        </div>
       
               @foreach($loan as $loan)
                 <table class="table">
                    <tr>                 
                    <th>Transaction ID</th>              
                    <td>{{$loan->ref}}</td>                   
                    </tr> 
               
                    <tr>
                    <th>Debit Card Linked</th>
                    <td><?php echo $cardlinked; ?></td>
                    </tr>
                    <tr>
                      <th>Loan Status</th>
                      <td><?php echo $status; ?></td>
                    </tr>
                    <tr>
                      <th>Loan Amount</th>
                      <td>₦{{number_format($loan->amount,2)}}</td>
                    </tr> 
                    <tr>
                      <th>Monthly Interest Rate</th>
                      <td>{{$loan->rate}}%</td>
                    </tr>
                    <tr>
                      <th>Loan Tenure</th>
                      <td>{{$loan->tenure}} Days</td>
                    </tr> 
                    <tr>
                      <th>Interest Value</th>
                      <td>₦{{number_format($loan->interest,2)}}</td>
                    </tr>
                    <tr>
                      <th>Expected Repayment</th>
                      <td>₦{{number_format($loan->interest+$loan->amount,2)}}</td>
                    </tr>
                    <tr>
                      <th>Monthly Repayment</th>
                      <td>₦{{number_format($loan->tranch,2)}}</td>
                    </tr>
                    <tr>
                      <th>Number of Repayments</th>
                      <td>{{$loan->tenure/30}} </td>
                    </tr> 
                    <tr>
                      <th>Processing Fee</th>
                      <td>₦{{number_format($loan->profee,2)}} ({{$loan->prorate}}%)</td>
                    </tr> 
                    <tr>
                      <th>Loan Application Date</th>
                      <td>{{date('jS M, Y', strtotime($loan->created_at))}} </td>
                    </tr>
    
               @if($loan->status>3)
                    <tr>
                      <th>Activation Date</th>
                      <td><?php echo date('jS M, Y', $loan->start) ?></td>
                    </tr>
                    <tr>
                      <th>Expiry Date</th>
                      <td><?php echo date('jS M, Y', $loan->stop) ?> </td>
                    </tr>
                    <tr><th>Payment Due</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>Auto Debit Attempts</th>
                    <td></td>
                    </tr>  
                    <tr>
                    <th>Late Payment Charges</th>
                    <td></td>
                    </tr>
                    <tr>
                      <th>Repayment Received</th>
                      <td>₦<?php $paid = $walletloan; $expected=$loan->interest+$loan->amount; 
                       echo number_format($paid,2); ?>(<?php echo number_format(100*$paid/$expected,2); ?>%) %</td>
                    </tr>
                    <tr>
                      <th>Balance</th>
                      <td>₦<?php echo number_format($expected-$paid,2); ?>
                       (<?php echo number_format(100*($expected-$paid)/$expected,2); ?>%)</td>
                    </tr>
                @endif
                    </table>
                @endforeach   
                <div class="div">
                  <?php if($loan->status <5 AND $admin==1){ ?>
                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#modal-edit"> Edit Loan Data</button>
                 <?php } ?> 
                 <?php if($loan->status <4  AND $admin==1){ ?>
                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete" > DELETE APPLICATION</button> 
                 <?php } ?> 
                 <?php if($loan->status==1  AND $admin2==1){ ?>
                     <button style="float: right" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-approve"> APPROVE APPLICATION</button>
                 <?php } elseif($loan->status==2 AND $admin3==1){ ?>
                     <button style="" class="btn btn-outline-primary mt-1" data-toggle="modal" data-target="#modal-profee"> CONFIRM PROCESSING FEE PAYMENT</button>
                 <?php } elseif($loan->status==3 AND $admin4==1){ ?>
                     <button style="float: right" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-disburse"> DISBURSE LOAN</button>
                 <?php } elseif($loan->status==4 AND $admin5==1){ ?>
                     <button style="float: right" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-payment"> RECEIVE PAYMENT </button>  
               <?php } ?>
                </div>
              </div>
              <div class="col-md-6  table-responsive">
                <div class="card-header">
                  <h4>REPAYMENT SCHEDULE</h4>  
                </div>
                <table class="table">
                  <tr>
                    <th>INSTALMENT</th>
                    <th>REPAYMENT</th>
                    <th>DUE DATE </th>
                    <th>REMARK</th>
                  </tr>
                  <?php $i=1 ; $ctime = $loan->status > 3 ? $loan->start : time();
                        $tranches = $loan->tenure/30; 
                        $pay = 0;  
                        $tran = $loan->tranch;
                    while($i<=$tranches){ $e=$i++; $ctime += 60*60*24*30; $pay += $tran; $paid = $walletloan  ?>
                    <tr>
                      <td>Instalment <?php echo $e ?></td>
                      <td><?php  echo number_format($loan->tranch,2) ?></td>
                      <td><?php echo date('jS M, Y',$ctime) ?></td>
                      <td><?php echo $fin->rem($pay,$tran,$paid) ?>%</td>
                    </tr>
                  <?php } ?> 
                </table><br>
                <?php if(count($ccount)>0){ ?>
                  <h4>Receive Payments </h4>        
                               <table id="example2" class="table  table-striped">
                                 <thead>
                                 <tr>
                                 <th>Date</th>
                                 <th>Payment</th>
                                 <th>Remark</th>
                                 <th>Processed By</th>
                                 <th>Action</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                   <?php 
                                   $sum=0;  
                                   $e=0; 
                                   $i=0;
                                   foreach($ccount as $count){
                                  $e += 1; $sum += $count->cos; ?>         
                                 <tr>
                                 <td><?php echo date('jS M, Y',$count->ctime); ?></td>
                                 <td><?php echo number_format($count->cos,2) ?></td>
                                 <td><?php echo $fin->walletRemark($count->type);?></td>
                                 <td><?php echo $fin->uName($count->rep);?></td>
                                 <form method="post" action="/GoToTransaction">
                                 @csrf
                                 <input type="hidden" name="trno" value="{{$count->trno}}">
                                 <input type="hidden" name="flex" value="1"> 
                                 <td><button type="submit" class="btn btn-sm btn-outline-primary">Edit</a></td>
                                 </form>
                                 </tr>
                                 <?php }  ?>
                                 <tr>
                                 <th colspan="1">Total Payments</td>
                                 <td><?php echo number_format($sum,2); ?></td>
                                 <th colspan="3"></td>
                                 </tr>                                         
                                 </tbody>             
                               </table>
                     <?php } ?>
              </div>
            </div>
              
    </div>
  </div>
</div>


    <div class="modal modal-warning fade" id="modal-delete">
      <form method="post" action="/DelLoan">
        @csrf
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title text-danger">DELETE</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete loan?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-danger">Yes, Delete Loan</button>
          </div>
        </div>
      </div>
    </form>
    </div>

    
        <div class="modal modal-warning fade" id="modal-approve">
          <form method="post" action="/ApproveLoan">
            @csrf
            <input type="hidden" name="_method" value="PUT"> 
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-primary">APPROVE</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to approve loan?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Yes, Approve Loan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


   
            <div class="modal modal-warning fade" id="modal-profee">
              <form method="post" action="/ConfirmProfee">
                @csrf
                <input type="hidden" name="_method" value="PUT"> 
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title text-primary">CONFIRM PROCESSING FEE</h4>
                  </div>
                  <div class="modal-body">
                    <p>Confirm that loan processing fee has been paid</p>
                    <p>
                      <label>Fee Payment Date</label>
                      <input type="date" name="ctime" class="form-control" required>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary" name="ConfirmProfee">Yes, Confirmed Payment</button>
                  </div>
                </div>
              </form>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            
                <div class="modal modal-warning fade" id="modal-disburse">
                  <form method="post" action="/ConfirmDisburse">    
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title text-primary">CONFIRM DISBURSE</h4>
                      </div>
                      <div class="modal-body">
                        <p>Confirm that loan has been disbursed</p>
                        <p>
                          <label>Loan Disbursement Date</label>
                          <input type="date" name="start" class="form-control" required>
                        </p>
                        {{-- <form method="POST" action="{{ route('senduserloan') }}" accept-charset="UTF-8" > --}}
                          {{-- <input type="hidden" name="email" value="oluwatobiijaware@gmail.com"> {{-- required --}}
                          {{-- <input type="hidden" name="amount" value=" {{$loan->profee*100}}"> required in kobo --}}
                         {{-- <input type="hidden" name="quantity" value="1">
                          <input type="hidden" name="currency" value="NGN"> --}}
                          {{-- <input type="hidden" name="metadata" value="{{ json_encode($array =
                           ['userid' => Auth::user()->userid, 'bid'=>auth()->user()->bid, 'paytype'=>2,
                            'ref'=>$loan->ref]) }}" > For other necessary things you want to add to your payload. it is optional though --}}
                        
                          {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> required --}}
                          {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
                          {{-- {{ csrf_field() }} works only when using laravel 5.1, 5.2 --}}
              
                          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">  --}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Yes, Confirmed. Loan Disbursed</button>
                      </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
              
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            
                <div class="modal fade" id="modal-edit">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                         <h4 class="modal-title text-secondary text-uppercase">Modify Loan Information</h4>
                      </div>
                  <?php if($loan->status > 3){  ?>
                    <form method="post" action="/Editloan2">
                    @csrf
                   <input type="hidden" name="_method" value="PUT">  
                  <div class="modal-body"> 
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="number" name="amount" value="<?php echo $loan->amount ?>" class="form-control"
                        placeholder="Enter Loan Amount" required >
                        </div>
                        <div class="form-group">
                        <label>Interest Rate (%)</label>
                        <input type="text" name="rate" id="Text2" class="form-control" value="<?php echo $loan->rate ?>"  placeholder="Interest Rate" required>                
                        </div>
                      <div class="form-group">
                        <label>Loan Tenure</label>
                        <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
                        <option selected value="<?php echo $loan->tenure; ?>"><?php echo $loan->tenure ?> Days</option>
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
                      <div class="form-group">
                        <label>Loan Disbursement Date</label>
                        <input type="text" name="start"  class="form-control" value="<?php echo date('m/d/Y',$loan->start) ?>"  placeholder="Disbursement" required>                
                      </div>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-secondary" value="{{ $loan->ref }}" > Edit Loan Information</button>
                  </div>
                  </form>
                  <?php }else{ ?>
                  <form method="post" action="/Editloan">
                    @csrf
                   <input type="hidden" name="_method" value="PUT">  
                  <div class="modal-body"> 
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="number" name="amount" value="<?php echo $loan->amount ?>" class="form-control"
                        placeholder="Enter Loan Amount" required >
                         </div>
                         <div class="form-group">
                        <label>Interest Rate (%)</label>
                        <input type="text" name="rate" id="Text2" class="form-control" value="<?php echo $loan->rate ?>"  placeholder="Interest Rate" required>                
                        </div>
                        <div class="form-group">
                        <label>Processing Fee (%)</label>
                        <input type="text" name="profee" id="Text2" class="form-control" value="<?php echo $loan->prorate ?>"  placeholder="Interest Rate" required>                
                      </div>
                      <div class="form-group">
                         <label>Loan Tenure</label>
                        <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
                        <option selected value="<?php echo $loan->tenure; ?>"><?php echo $loan->tenure ?> Days</option>
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
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-secondary" value="{{ $loan->ref }}"> Edit Loan Information </button>
                  </div>
                  </form>
                  <?php }?>
              </div>
            </div>
          </form>
          </div>
       
        
             <div class="modal fade" id="modal-payment">
                    <div class="modal-dialog">
                      <form method="post" action="/ReceivePayment">
                        @csrf
                        <input type="hidden" name="_method" value="PUT"> 
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-primary text-uppercase">Loan Repayment  [Balance: <?php echo number_format($walletloan2-$walletloan,2) ?>]</h4>
                        </div>
                        <div class="modal-body  table-responsive">
                            <h4>REPAYMENT SCHEDULE </h4>
                          <table class="table">
                            <tr><th>TICK</th><th>INSTALMENT</td><th>REPAYMENT</th><th>DUE DATE </td><th>REMARK</td></tr>
                            <?php $i=1 ; $ctime = $loan->status>3 ? $loan->start : time(); 
                                  $tranches = $loan->tenure/30;  $pay = 0; 
                                  $tran = $loan->tranch;
                            while($i<=$tranches){ $e=$i++; $ctime += 60*60*24*30; $pay += $tran;
                             $paid = $walletloan;  ?>
                              <tr><td><input type="checkbox" class="iput" style="width: 20px; height: 20px;" 
                              <?php if($fin->rem($pay,$tran,$paid)==100){echo 'disabled' ; } ?> value="<?php  echo 
                               ceil($tranch) ?>"></td><td>Instalment <?php echo $e ?></th>
                               <td><?php  echo number_format($tranch,2) ?></td><td>
                               <?php echo date('jS M, Y',$ctime) ?></td><td><?php echo $fin->rem($pay,$tran,$paid) ?>%
                               </td></tr>
                              <?php } ?>
                        <tr><th colspan="2">Expected Repayment:</th><td><?php  echo number_format($walletloan2,2) ?></td>
                        <th>Payment Received:</th><td><?php echo number_format($walletloan,2) ?></td></tr>
                        </table>
          
                        <label>Amount to Pay</label>
                        <textarea id="total" name="payamount" class="form-control" rows="1" placeholder="Enter Amount" 
                        style="font-size: 20px; padding: 0 12px" required></textarea>
                       
                        <label>Date of payment</label>
                        <input type="date" name="paydate" class="form-control" placeholder="Enter Date" required>
                        </div>
          
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-outline-primary">MAKE PAYMENT</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                  </form>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
              
          
     

@endsection