@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Pending Applications</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Pending Application</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Client </th> 
                <th>Capital </th> 
                <th>Interest</th>
                <th>Total Return</th>
                <th>Tenure</th>
                <th>Application Date </th>
                <th>Status </th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
                
                <?php 
                $i = 0;
                $e = 0;
                    foreach ($invest as $dat) {
                ?>
              
                <tr>
                    <td><?php echo $user[$i]; $i++;?></td>
                    <td>₦<?php echo number_format($dat->amount,2)?></td>
                    <td>₦<?php echo number_format($dat->interest,2)?></td>
                    <td>₦<?php echo number_format($dat->amount+$dat->interest,2)?></td>
                    <td><?php echo $dat->tenure ?> Days</td>
                    <td><?php echo $dat->created_at; ?></td>
                    <td><?php echo $status[$e]; $e++;?></td>
                    <form action="/ViewInvestDetails" method="POST">
                    @csrf
                    <td><button class="btn btn-outline-primary btn-xs" name="ManageInv" value="<?php echo $dat->ref; ?>">
                      Manage</button></td>
                    </form>
                  </tr>
               
              <?php } ?>              
                </tbody>        
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection