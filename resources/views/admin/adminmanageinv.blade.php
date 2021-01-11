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
<div class="row">
  {{-- <div class="card"> --}}
  {{-- <div class="col-lg-12"> --}}
  <div class="col-lg-12">
    <div class="card">
    <div class="card-header">

      <h4>Investment Account Details</h4>
      <table id=""  class="table table-striped">
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
          <h4>INVESTMENT STATISTICS</h4>
        </div>

        <table class="table">
            @foreach($invacc as $invacc)
              <tr>
              <th>Transaction ID</th>
              <td>{{$invacc->ref}}</td>
              </tr>
              <tr>
              <th>Investment Status</th>
              <td><?php echo $status ?></td>
              </tr>
              <tr>
              <th>Investment Amount</th>
              <td>₦{{number_format($invacc->amount,2)}}</td>
              </tr>
              <tr>
              <th>Investment Tenure</th>
              <td>{{$invacc->tenure}} Days</td>
              </tr>
               <?php if($invacc->status ==3){ ?>
              <tr>
              <th>Investment Age</th>
              <td><?php $time=$invacc->start; echo floor(abs(time()-$time)/(60*60*24)) ?> Days</td>
              </tr>
              <?php } ?>
              <tr>
              <th>Monthly Interest Rate</th>
              <td>{{$invacc->rate}}% (<?php echo $invacc->rate*12 ?>% Yearly)</td>
              </tr>
              <tr>
              <th> Interest Value</th>
              <td>₦<?php $interest = $invacc->amount* $invacc->rate* $invacc->tenure/100/30;
               echo number_format($interest,2) ?></td>
              </tr>
              <tr>
              <th>VAT on Investment Interest</th>
              <td>₦<?php $vat = $interest*$setname/100; echo number_format($vat,2); ?>
               (<?php echo $setname; ?>%)</td>
               </tr>
               <tr>
               <th>Total Return</th><td>₦<?php $exp = $invacc->amount+$interest-$vat;
                echo number_format($exp,2) ?></td>
                </tr>
                <tr>
                <th>Application Date</th>
                <td><?php echo date('jS M, Y',strtotime($invacc->created_at)) ?> </td>
                </tr>
                <?php if($invacc->status >2){ ?>
                <tr>
                <th>Activation Date</th>
                <td><?php  echo date('jS M, Y', $invacc->start) ?> </td>
                </tr>
                <tr>
                <th>Expiry Date</th>
                <td><?php echo date('jS M, Y',$invacc->stop) ?></td>
                </tr>
                <?php if($invacc->status ==4){ ?>
                <tr>
                <th>Termination Date</th>
                <td><?php echo date('jS M, Y',$terminate); ?></td>
                </tr>
               <?php } ?>
                 <tr>
                <th>Total Deposit Received</th>
                <td>₦<?php $paid = $walletloan; echo number_format($paid,2); ?></td>
                </tr>
                <tr>
                <th>Total Liquidated</th>
                <td>₦<?php $liq = $walletloan3+$walletloan4;
                echo number_format(abs($liq),2); ?> </td>
                </tr>
              <tr>
                <th>Accrued Interest</th>
                <td>₦<?php $int = $status==3 ? $total : $walletloan5;
                  echo number_format($int,2); ?> </td>
              </tr>
              <tr>
                <th>Total Value</th>
                <td><?php $int = $status==3 ? $total : $walletloan2;
               echo number_format($paid+$int-abs($liq),2); ?> </td>
               </tr>
              <?php } ?>
              @endforeach
           </table>

    <div class="div">
        <?php if($invacc->status <3 AND $admin1 ==1){ ?>
            <button style="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-edit"> EDIT INVESTMENT INFORMATION</button>
            <?php } ?>
                <?php if($invacc->status ==1 AND $admin1==1){ ?>
                    <button style="" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete" > DELETE INVESTMENT ACCOUNT</button> <?php } ?>
                    <?php if($invacc->status ==1 AND $admin2 ==1){ ?>
                    <button style="float: right" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-approve"> APPROVE INVESTMENT </button>
                    <?php } ?>
            <?php if($invacc->status ==3 AND $admin4 ==1){ ?>
            <button style="float: right; margin:0 10px" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-terminate"> LIQUIDATE INVESTMENT</button>
            <?php } ?>
            <?php if($invacc->status ==2 AND $admin3 ==1){ ?>
            <button style="float: right" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-payment"> RECEIVE PAYMENT </button>
            <?php } ?>
    </div>
              </div>
              <div class="col-md-6  table-responsive">
                <div class="card-header">
                  <h4>TRANSACTION HISTORY</h4>
                </div>
                <table class="table">
                    <tr>
                        <th>SN</th>
                        <th>DEPOSIT</th>
                        <th>PAYMENT DATE </th>
                        <th>REMARK</td>
                        <th>RECEIVED BY</th>
                        <th>ACTION</th>
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
                        <td><?php echo $fin->walletRemark($count->type);?></td>
                        <td><?php echo $fin->uName($count->rep);?></td>
                        <form method="post" action="/GoToTransaction">
                      @csrf
                      <input type="hidden" name="trno" value="{{$count->trno}}">
                      <input type="hidden" name="flex" value="3">
                      <td><button type="submit" class="btn btn-primary">Edit</a></td>
                      </form>
                      </tr>
                      <?php } ?>
                   </table>


              </div>
            </div>

    </div>
  </div>
</div>





        <div class="modal modal-warning fade" id="modal-delete">
          <div class="modal-dialog">
            <form method="post" action="/Deleteinv">
                @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">DELETE</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete investment account?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger">Yes, Delete Account</button>
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


                   <div class="modal modal-warning fade" id="modal-approve">
                     <div class="modal-dialog">

                    <form method="post" action="/Approveinv">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h4 class="modal-title text-uppercase">Approve Investment</h4>
                         </div>
                         <div class="modal-body">
                           <p>Are you sure you want to approve Investment?</p>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-outline-primary">Yes, Approve Investment</button>
                         </div>
                       </div>
                       <!-- /.modal-content -->
                     </div>
                     <!-- /.modal-dialog -->
                   </div>
                   <!-- /.modal -->
                 </form>






                        <div class="modal fade" id="modal-edit">
                            <div class="modal-dialog">
                                <form method="post" action="/EditInv">
                                    @csrf
                                      <input type="hidden" name="_method" value="PUT">
                              <div class="modal-content">
                                <div class="modal-header">
                                   <h4 class="modal-title text-uppercase">Modify Investment Information</h4>
                                </div>
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Investment Amount</label>
                                  <input type="number" name="amount" id="Text1" class="form-control"
                                  placeholder="Enter Loan Amount"  value="{{$invacc->amount}}"  required >
                                   </div>
                                   <div class="form-group">
                                  <label>Monthly Interest Rate (%)</label>
                                  <input type="text" name="rate" id="Text2" class="form-control" value="{{$invacc->rate}}"
                                   placeholder="Interest Rate" required>
                                   </div>
                                <div class="form-group">
                                  <label>Investment Tenure</label>
                                  <select name="tenure" class="form-control select2"  required>
                                  <option value="{{$invacc->tenure}}">{{$invacc->tenure}} Days</option>
                                  <option value="90">90 Days</option>
                                  <option value="180">180 Days</option>
                                  <option value="270">270 Days</option>
                                  <option value="360">360 Days</option>
                                  </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-outline-warning" name="EditInv" value="{{$invacc->ref }}"> Edit Savings Information </button>
                            </div>
                        </div>
                    </form>
                      </div>
                    </div>


                        <div class="modal fade" id="modal-terminate">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title text-uppercase">Liquidate Investment</h4>
                              </div>
                              <div class="modal-body">
                                <p>Confirm that you want to liquidate investment by selecting appropriate mode of liquidation</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-complete">Complete Liquidation</button>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-partial">Partial Liquidation</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>





                              <div class="modal fade" id="modal-payment">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                        <form method="post" action="/MakeInvPayment">
                                            @csrf
                                         <div class="modal-header">
                                           <h4 class="modal-title text-uppercase">Investment Payment  [Deposit: ₦<?php echo number_format($deposit,2) ?>]</h4>
                                         </div>
                                         <div class="modal-body">

                                         <label>Amount to Pay</label>
                                         <input type="number" name="payamount" value="{{$invacc->amount}}" class="form-control" placeholder="Enter Amount"
                                          style="font-size: 20px; padding: 0 12px" readonly required>

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



                                      <div class="modal fade" id="modal-complete">
                                          <div class="modal-dialog">
                                            <form method="post" action="/LiquidateInv1">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                 <h4 class="modal-title text-uppercase">Complete Investment Liquidation</h4>
                                              </div>
                                          <div class="modal-body">
                                          <div class="form-group">Are you sure you want to liquidate this investment and terminate the contract?<br></div>
                                              <div class="form-group">
                                                <label>Authenticate Transaction</label>
                                                <input type="password" name="validate"  class="form-control" placeholder="Enter Validation Code" required >
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-warning" name="Complete" value="{{$invacc->ref }}"> LIQUIDATE ENTIRE INVESTMENT </button>
                                          </div>
                                      </div>
                                    </form>
                                    </div>
                                  </div>




      <div class="modal fade" id="modal-partial">
        <form method="post" action="/LiquidateInv2">
            @csrf
            <input type="hidden" name="_method" value="PUT">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title text-uppercase">Partial Investment Liquidation</h4>
              </div>
          <div class="modal-body">
          <div class="form-group">Are you sure you want to liquidate this investment partially?<br></div>
              <div class="form-group">
                <label>Amount to Liquidate</label>
                <input type="number" name="payamount" value="<?php if($invacc->status >1){
                  $liq = $walletloan3 + $walletloan4; $paid = $walletloan; $int = $status==3 ? $total : $walletloan2;
                  echo $max = $paid + $int - abs($liq); }?>" class="form-control" placeholder="Enter Amount"
                             style="font-size: 20px; padding: 0 12px" required>
              </div>

              <div class="form-group">
                <label>Date of Liquidation</label>
                <input type="date" name="paydate" class="form-control" placeholder="Enter Date" required>
              </div>
              <div class="form-group">
                <label>Authenticate Transaction</label>
                <input type="password" name="validate"  class="form-control" placeholder="Enter Validation Code" required >
              </div>

          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary" name="Partial" value="{{$invacc->ref }}"> LIQUIDATE INVESTMENT PARTIALLY </button>
          </div>
      </div>
    </form>
    </div>
  </div>



@endsection
