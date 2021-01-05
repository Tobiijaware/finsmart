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
          <h1 class="m-0 text-dark">System Setup</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Admin Permissions</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">System Administrator Permissions</h3>
        </div>
        <?php 
        $iv = '';
        foreach($sql as $row){ 
          $iv .= ','.$row->userid; 
        } 
        $ig = explode(',', $iv);
        $c = count($ig); $i=1;
      ?>
        <div class="card-body">
          
      <div class="col-md-12 table-responsive">
        <td class="text-center"></td>
                   <table class="table table-bordered">
                   <table class="table table-bordered">
                    <tr><th>ADMINISTRATORS </th> 
                    <?php  
                    while($i<$c){ 
                      $e=$i++; ?> 
                      <th style="text-align: center"><?php echo $fin->uName($ig[$e]); ?></th> 
                      <?php } ?> 
                    </tr>
                    <tr><th colspan="<?php echo $c ?>">LOAN PERMISSIONS</th></tr>
                    <tr><td>Submit Loan Applications for clients</th><?php echo $fin->addTd($ig,'l1') ;?>  </tr>
                    <tr><td>Review & Approve Loan Applications</th><?php echo $fin->addTd($ig,'l2') ;?></tr>
                    <tr><td>Receive & Confirm Processing Fee</th><?php echo $fin->addTd($ig,'l3') ;?></tr>
                    <tr><td>Review and disburse Loan</th><?php echo $fin->addTd($ig,'l4') ;?></tr> 
                    <tr><td>Receive Loan Repayment</th><?php echo $fin->addTd($ig,'l5') ;?></tr>

                    <tr><th colspan="<?php echo $c ?>">SAVINGS PERMISSIONS</td></tr>
                    <tr><td>Create Savings Plans for clients</th><?php echo $fin->addTd($ig,'s1') ;?></tr>
                    <tr><td>Receive Savings Deposit</th><?php echo $fin->addTd($ig,'s2') ;?></tr>
                    <tr><td>Liquidate Savings</th><?php echo $fin->addTd($ig,'s3') ;?></tr>

                    <tr><th colspan="<?php echo $c ?>">INVESTMENT PERMISSIONS</th></tr>
                    <tr><td>Create Investment Plans for clients</th><?php echo $fin->addTd($ig,'i1') ;?></tr>
                    <tr><td>Approve Investment Plans</th><?php echo $fin->addTd($ig,'i2') ;?></tr>
                    <tr><td>Receive Investment Deposits</th><?php echo $fin->addTd($ig,'i3') ;?></tr>
                    <tr><td>Liquidate Investments</th><?php echo $fin->addTd($ig,'i4') ;?></tr>

                    <tr><th colspan="<?php echo $c ?>">OTHER PERMISSIONS</th></tr>
                    <tr><td>Manage System Setup</th><?php echo $fin->addTd($ig,'o1') ;?></tr>
                    <tr><td>Manage Financial Reports</th><?php echo $fin->addTd($ig,'o2') ;?></tr>
                    <tr><td>Manage System Dashboard</th><?php echo $fin->addTd($ig,'o3') ;?></tr>
                    <tr><td>Send SMS & Emails to Clients</th><?php echo $fin->addTd($ig,'o4') ;?></tr>
                    <tr><td>Update Client's Data</th><?php echo $fin->addTd($ig,'o5') ;?></tr>
                    <tr><td>Edit Transaction</th><?php echo $fin->addTd($ig,'o6') ;?></tr>
                    </table>
                </div> 
        </div>
    </div>
    </div>  
</div>



@endsection