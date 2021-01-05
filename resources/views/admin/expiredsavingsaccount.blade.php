@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Expired Savings Accounts</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Expired Savings Accounts</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Expired Savings Accounts</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Client </th>
                <th>Periodic Amount </th>
               <th>Monthly Rate</th>
               <th>Savings Cycle</th>
               <th>Activation Date</th>
               <th>Expiry Date</th>
               <th>Total Deposit </th>
               <th>Interest </th>
               <th>Status </th>
               <th>Action </th>
            </tr>
            </thead>
            <tbody>
           
           
                <?php
                $e=0;
                $y=0;
                $i=0;
                $m=0;
                foreach($expiredsavings as $dat){
              ?>
               <tr>
            <td><?php echo $user[$i]; $i++;?></td>
            <td>₦<?php echo number_format($dat->amount,2)?></td>
            <td><?php echo number_format($dat->rate,2)?>%</td>
            <td><?php echo $dat->period?> Days</td>
            <td><?php echo date('jS M, Y',$dat->start)?></td>
            <td><?php echo date('jS M, Y',$dat->stop)?></td>
            <td>₦<?php echo number_format($wallet[$e],2); $e++;?></td>
            <td>₦<?php echo number_format($wallet2[$y],2); $y++?></td>
            <td id="td"><?php echo $status[$m];$m++; ?></td> 
            <td> 
                <form action="/ViewSavingsDetails" method="POST">
                @csrf
                <button class="btn btn-outline-primary btn-xs" name="ManageSavings" value="<?php echo $dat->ref?>">Manage</button>
                </form>
                </td>
            </tr>
          <?php } ?>
          
        </tbody>      
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  <script>
      let newtd = document.getElementById('td');
      newtd.style.fontSize = '12px';
  </script>
@endsection