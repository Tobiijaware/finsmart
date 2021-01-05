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
<div class="row">
  {{-- <div class="card"> --}}
  {{-- <div class="col-lg-12"> --}}
  <div class="col-lg-12">
    <div class="card">
    <div class="card-header">
      
      <h4>Savings Account Details</h4>
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
          <h4>SAVINGS STATISTICS</h4>
        </div>
       
        <table class="table">
            @foreach($saving as $saving)
               <tr>
                 <th>Transaction ID</th>
                 <td>{{$saving->ref}}</td>
               </tr>
               <tr>
                 <th>Savings Status</th>
                 <td><?php echo $status; ?></td>
               </tr>
               <tr>
                 <th>Periodic Amount</th>
                 <td>₦{{number_format($saving->amount,2)}}</td>
               </tr> 
               <tr>
                 <th>Monthly Interest Rate</th>
                 <td>{{$saving->rate}}%</td>
               </tr> 
               <tr>
                 <th>Yearly Interest Rate</th>
                 <td>{{$saving->rate2}}%</td>
               </tr>
               <tr>
                 <th>Periodic Cycle</th>
                 <td>{{$saving->period}} Days</td>
               </tr>              
               <tr>
                 <th>Savings Application Date</th>
                 <td><?php echo date('jS M, Y',strtotime($saving->created_at)) ?></td>
               </tr> 
               <?php if($saving->status >1){ ?>
               <tr>
                 <th>Activation Date</th>
                 <td><?php echo date('jS M, Y',$saving->start) ?></td>
               </tr>
               <?php if($saving->status == 3){ ?>
               <tr>
                 <th>Expiry Date</th>
                 <td><?php echo date('jS M, Y',$saving->stop) ?></td>
               </tr> 
               <?php } ?>             
               <?php if($saving->status == 2){ ?>
               <tr>
                 <th>Account Age</th>
                 <td>{{$expect}} Cycles</td>
               </tr>
               <tr>
                 <th>Expected Payment</th>
                 <td>₦<?php $expected = $expect*$save; echo number_format($expected,2) ?></td>
               </tr>
               <tr>
                 <th>Outstanding Payment</th>
                 <td>₦<?php $paid = $walletloan; echo number_format($expected-$paid,2); ?></td>
               </tr>
               <?php } ?>           
               <tr>
                 <th>Total Deposit Received</th>
                 <td>₦<?php $paid = $walletloan; echo number_format($paid,2); ?></td>
               </tr>
               <tr>
               <th>Total Liquidated</th>
               <td>₦<?php $liq = $walletloan3+$walletloan4;
               echo number_format(abs($liq),2); ?></td>
               </tr>
               <tr>
                 <th>Accrued Interest</th>
                 <td>₦<?php $int = $status==2 ? $total : $walletloan5;
                   echo number_format($int,2); ?></td>
               </tr>
               <tr>
                 <th>Total Value</th>
                 <td><?php $int = $status==2 ? $total : $walletloan2; 
                  echo number_format($paid+$int-abs($liq),2); ?></td>
                </tr>
               <?php } ?>
              @endforeach
               </table>
               
                <div class="div">
                    <?php if($fin->saveName($saving->ref,'status')<3 AND $admin1==1){ ?>
                        <button style="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-edit" >EDIT SAVINGS INFORMATION</button> 
                        <?php } ?>
                        <?php if($fin->saveName($saving->ref,'status')==1 AND $admin1==1){ ?>
                          <button style="" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete" > DELETE SAVINGS ACCOUNT</button> 
                                  <?php } ?> 
                         <?php if($fin->saveName($saving->ref,'status')==2 AND $admin3==1){ ?>
                          <button style="float: right; margin:0 10px" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-terminate"> LIQUIDATE SAVINGS</button> 
                         <?php } ?>
                         <?php if($saving->status>0 AND $admin2==1){ ?>
                          <button  class="btn btn-outline-success mt-3" data-toggle="modal" data-target="#modal-payment"> RECEIVE PAYMENT </button>  
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
                        <th>PROCESSED</th>
                        <th>ACTION</th>
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
                       <form method="post" action="/GoToTransaction">
                        @csrf
                        <input type="hidden" name="trno" value="{{$count->trno}}">
                        <input type="hidden" name="flex" value="2"> 
                        <td><button type="submit" class="btn btn-sm btn-outline-primary">Edit</a></td>
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
            <form method="post" action="/DelSaving">
                @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">DELETE</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete savings account?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger">Yes, Delete Savings Account</button>
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
     
    
        
            <div class="modal fade" id="modal-terminate">
              <div class="modal-dialog">
              
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title text-uppercase">Liquidate Savings</h4>
                  </div>
                  <div class="modal-body">
                    <p>Confirm that you want to liquidate savings by selecting appropriate mode of liquidation</p>               
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-complete">Complete Liquidation</button>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-partial">Partial Liquidation</button>
                  </div>
                </div>
          
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
         

   
        
                    <div class="modal fade" id="modal-payment">
                         <div class="modal-dialog">
                            <form method="post" action="/SavingsPayment">
                                @csrf
                           <div class="modal-content">
                             <div class="modal-header">
                           <h4 class="modal-title text-uppercase">Savings Payment  [Deposit: ₦<?php echo number_format($savedeposit,2) ?>]</h4>
                             </div>
                             <div class="modal-body">
                             <label>Amount to Pay</label>
                             <input type="number" name="payamount" value="{{$saving->amount}}" class="form-control" placeholder="Enter Amount"
                              style="font-size: 20px; padding: 0 12px" required>            
                             <label>Date of payment</label>
                             <input type="date" name="paydate" class="form-control" placeholder="Enter Date" required>
                             </div>
                             <div class="modal-footer">
                               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-outline-primary">MAKE PAYMENT</button>
                             </div>
                           </div>
                        </form>
                           <!-- /.modal-content -->
                         </div>
                         <!-- /.modal-dialog -->
                       </div>
                       <!-- /.modal -->
                
              
                      
            
                  <div class="modal fade" id="modal-edit">
                    <form method="post" action="/EditSavings">
                        @csrf
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title text-uppercase">Modify Savings Information</h4>
                          </div>          
                       <input type="hidden" name="_method" value="PUT">  
                      <div class="modal-body"> 
                          <div class="form-group">
                            <label>Periodic Savings Amount</label>
                            <input type="number" name="amount" id="Text1" class="form-control" 
                            value="{{$saving->amount}}" placeholder="Enter Loan Amount" required >
                             </div>
                             <div class="form-group">
                            <label>Monthly Interest Rate (%)</label>
                            <input type="text" name="rate" id="Text2" class="form-control" value="{{$saving->rate}}" 
                             placeholder="Interest Rate" required>
                             </div>                
                          <div class="form-group">
                            <label>Savings Periodic Cycle</label>
                            <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
                            <option value="{{$saving->period}}">{{$saving->period}} Days</option>
                                  <option value="1">1 Day</option>
                                   <option value="7">7 Days</option>
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
                            <button type="submit" class="btn btn-outline-warning" name="EditSaving" value="{{$saving->ref }}"> Edit Savings Information </button>
                      </div>
                  </div>
                </form>
                </div>
              </div>
            
        
              
                  <div class="modal fade" id="modal-complete">
                    <form method="post" action="/Liquidate1">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title text-uppercase">Complete Savings Liquidation</h4>
                          </div>            
                      <div class="modal-body"> 
                      <div class="form-group">Are you sure you want to liquidate this savings and terminate the contract? <br></div>
                          <div class="form-group">
                            <label>Authenticate Transaction</label>
                            <input type="password" name="validate"  class="form-control" placeholder="Enter Validation Code" required >
                          </div>              
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-warning" name="Complete" value="{{$saving->ref }}"> LIQUIDATE ENTIRE SAVINGS </button>
                      </div>
                  </div>
                </form>
                </div>
              </div>
        
           
                  <div class="modal fade" id="modal-partial">
                      <div class="modal-dialog">
                        <form method="post" action="/Liquidate2">
                            @csrf   
                            <input type="hidden" name="_method" value="PUT">
                        <div class="modal-content">
                          <div class="modal-header">
                           
                             <h4 class="modal-title text-uppercase">Partial Savings Liquidation</h4>
                          </div>            
                      <div class="modal-body"> 
                      <div class="form-group">Are you sure you want to liquidate this savings partially? <br></div>
                          <div class="form-group">
                            <label>Amount to Liquidate</label>
                            <input type="number" name="payamount" value="<?php if($saving->status >1){echo $max = $paid+$int-abs($liq); }?>" 
                            class="form-control" placeholder="Enter Amount" style="font-size: 20px; padding: 0 12px" required>
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
                            <button type="submit" class="btn btn-primary" name="Partial" value="{{$saving->ref}}"> LIQUIDATE SAVINGS PARTIALLY </button>
                      </div>
                  </div>
                </form>
                </div>
              </div>
          
            
     

@endsection