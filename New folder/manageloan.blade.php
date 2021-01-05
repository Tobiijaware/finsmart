@extends('layouts.adminheadside')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Loan
        <small>Manage Loan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Loan</a></li>
        <li class="active">Manage Loan</li>
      </ol>
    </section>
    <?php 
        function rem($total,$tranch,$paid){
            if($paid>=$total){$res = 100;} 
            elseif($total-$paid<$tranch){$res =  100-(100*($total-$paid)/$tranch);}
            else{$res=0;}
            return number_format($res,2);
        }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header  table-responsive">
              <h3 class="box-title">Loan Details </h3><hr>
              <h4>LOAN CLIENT</h4>
        <table  class="table  table-striped">
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

     <div class="col-md-6  table-responsive">
        <h4>LOAN STATISTICS</h4>
               @foreach($loan as $loan)
                 <table class="table">
                    <tr>                 
                    <th>Transaction ID</th>              
                    <td>{{$loan->ref}}</td>                   
                    </tr>
                    <tr>
                    <th>Debit Card Linked</th>
                    <td></td>
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
                      <td><?php echo date('jS M, Y', $loanExpiry) ?> </td>
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
                      <th>Repayment Received</th>walletloan
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
              </div>
      <div class="col-md-6  table-responsive">
        <h4> REPAYMENT SCHEDULE</h4>        
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
                <td><?php echo rem($pay,$tran,$paid) ?>%</td>
              </tr>
            <?php } ?> 
          </table>
      </div>

@if($loan->status==4) 
    <a style="float: right" class="btn btn-success btn-xs" href="loanholiday.php">
     Process Loan Holiday</a>  
 @endif
<br>
<?php if(count($ccount)>0){
            foreach($sql as $count){ ?>
 <h4>Receive Payments </h4>
    <form method="post">            
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

                </tbody>
              
              </table>
              </form>
    <?php } ?>
  <?php } ?>
            </div> 
            <form method="post">
<div class="col-md-12">
  <?php if($loan->status <5 AND $admin==1){ ?>
     <button type="submit" class="btn btn-warning" name="StartEditLoan"> Edit Loan Data</button>
  <?php } ?> 
  <?php if($loan->status<4  AND $admin==1){ ?>
     <a style="" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" > DELETE APPLICATION</a> 
  <?php } ?> 
  <?php if($loan->status==1  AND $admin2==1){ ?>
      <a style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#modal-approve"> APPROVE APPLICATION</a>
  <?php } elseif($loan->status==2 AND $admin3==1){ ?>
      <a style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#modal-profee"> CONFIRM PROCESSING FEE PAYMENT</a>
  <?php } elseif($loan->status==3 AND $admin4==1){ ?>
      <a style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#modal-disburse"> DISBURSE LOAN</a>
  <?php } elseif($loan->status==4 AND $admin5==1){ ?>
      <a style="float: right" class="btn btn-success" data-toggle="modal" data-target="#modal-payment"> RECEIVE PAYMENT </a>  
<?php } ?>
</form>

 <form method="post">
        <div class="modal modal-warning fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning!!!</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete loan?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" name="DeleteLoan">Yes, Delete Loan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

 <form method="post">
        <div class="modal modal-warning fade" id="modal-approve">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning!!!</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to approve loan?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" name="ApproveLoan">Yes, Approve Loan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>

 <form method="post">
        <div class="modal modal-warning fade" id="modal-profee">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning!!!</h4>
              </div>
              <div class="modal-body">
                <p>Confirm that loan processing fee has been paid</p>
                <p>
                  <label>Fee Payment Date</label>
                  <input type="date" name="ctime" class="form-control" required>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" name="ConfirmProfee">Yes, Confirmed Payment</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>


 <form method="post">
        <div class="modal modal-warning fade" id="modal-disburse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning!!!</h4>
              </div>
              <div class="modal-body">
                <p>Confirm that loan has been disbursed</p>
                <p>
                  <label>Loan Disbursement Date</label>
                  <input type="date" name="start" class="form-control" required>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" name="ConfirmDisburse">Yes, Confirmed. Loan Disbursed</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>




 <form method="post">
   <div class="modal fade" id="modal-payment">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Loan Repayment  [Balance: <?php echo number_format($walletloan2-$walletloan,2) ?>]</h4>
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
                    <?php if(rem($pay,$tran,$paid)==100){echo 'disabled' ; } ?> value="<?php  echo 
                     ceil($tranch) ?>"></td><td>Instalment <?php echo $e ?></th>
                     <td><?php  echo number_format($tranch,2) ?></td><td>
                     <?php echo date('jS M, Y',$ctime) ?></td><td><?php echo rem($pay,$tran,$paid) ?>%
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
                <button type="submit" class="btn btn-primary" name="MakePayment">MAKE PAYMENT</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </form>


<script type="text/javascript">
  let total = 0;
[...document.getElementsByClassName('iput')].forEach(function(item) {
  item.addEventListener('change', function(e) {
    if (e.target.checked) {
      total += parseInt(e.target.value, 10)
    } else {
      total -= parseInt(e.target.value, 10)
    }
    document.getElementById('total').innerHTML = total
  })

})
</script>


          </div>
         
            
            
            <!-- /.col -->
          </div>     
</div>


   <form method="post">
                <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Modify Loan Information</h3><hr>
</div> 
<div class="box-body">

    <?php if($loan->status>3){  ?>
              <div class="col-md-3">
              <div class="form-group">
                <label>Loan Amount</label>
                <input type="number" name="amount" value="<?php echo $loan->$ref ?>" class="form-control" placeholder="Enter Loan Amount" required >
                 
              </div>
              </div>
             <div class="col-md-3">
             <div class="form-group">
                <label>Interest Rate (%)</label>
                <input type="text" name="rate" id="Text2" class="form-control" value="<?php echo $loan->rate ?>"  placeholder="Interest Rate" required>                
              </div>
            </div>
           
            <div class="col-md-3">
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

            <div class="col-md-3">
             <div class="form-group">
                <label>Loan Disbursement Date</label>
                <input type="text" name="start"  class="form-control" value="<?php echo date('m/d/Y',$loan->start) ?>"  placeholder="Disbursement" required>                
              </div>
            </div>
                        
            <div class="col-md-3 float-right">
              <div class="form-group">
              <br>
                <button type="submit" name="EditLoan2" class="btn btn-warning btn-block"> Edit Loan</button>                
              </div>
              </div>
            </div>
          <?php }else{ ?>

            <div class="col-md-3">
              <div class="form-group">
                <label>Loan Amount</label>
                <input type="number" name="amount" value="<?php echo $loan->ref; ?>" class="form-control" placeholder="Enter Loan Amount" required >                 
              </div>
              </div>
             <div class="col-md-3">
             <div class="form-group">
                <label>Interest Rate (%)</label>
                <input type="text" name="rate" id="Text2" class="form-control" value="<?php echo $loan->rate ?>"  placeholder="Interest Rate" required>                 
              </div>
            </div>
             <div class="col-md-3">
             <div class="form-group">
                <label>Processing Fee (%)</label>
                <input type="text" name="profee" id="Text2" class="form-control" value="<?php echo $loan->prorate ?>"  placeholder="Interest Rate" required>                
              </div>
            </div>
            <div class="col-md-3">
             <div class="form-group">
                <label>Loan Tenure</label>
                <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
                <option selected value="<?php echo $loan->tenure ?>"><?php echo $loan->tenure ?> Days</option>
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
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
              <div class="form-group">
             
                <button type="submit" name="EditLoan" class="btn btn-warning btn-block"> Edit Loan</button>
                 
              </div>
              </div>
            </div>
             <?php } ?>
        
</div>
</div>
</form>


     <form method="post">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Modify Loan Repayment Dates</h3><hr>
            </div> 
          <div class="box-body">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
              <div class="form-group"><br>
             
                <button type="submit" name="ModifyDates" class="btn btn-warning btn-block"> Modify Repayment Dates</button>
                 
              </div>
              </div>
            </div>
        </div>
      </div>
    </form>
     </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection
