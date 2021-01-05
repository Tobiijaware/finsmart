@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Active Savings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Active Savings</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Savings Applications</h3>
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
              <th>Application Date</th>
              <th>Activation Date</th>
              <th>Total Deposit </th> 
              <th>Status </th>
              <th>Action </th>
            </tr>
            </thead>
            <tbody>
            <tr>
           
              <?php
              $e=0;
              $s=0;
                $i=0;
            foreach($activesavings as $dat ){
            
            $active = $status > 1 ? date('jS M, Y',$dat->start) : '';
            //  $deposit = $walletloan ?? '';
            ?>
            <td><?php echo $user[$i]; $i++;?></td>
            <td>₦<?php echo number_format($dat->amount,2);?></td>
            <td><?php echo number_format($dat->rate,2);?>%</td>
            <td><?php echo $dat->period;?> Days</td>
            <td><?php echo $dat->created_at;?></td>
            <td><?php echo $active; ?></td>  
            <td>₦<?php echo number_format($wallet[$s],2);$s++; ?></td>
            <td id='td'><?php echo $status[$e];$e++; ?></td> 
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