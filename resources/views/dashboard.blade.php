@extends('layouts.sapp')
@section('content')



<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{penaltyfee()}}
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>₦{{ $amt }} </h3>
            <p>Wallet Balance</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>₦{{ $loan }} </h3>
            <p>Active Loans</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background: grey;">
          <div class="inner">
            <h3>₦{{ $saving }} </h3>
            <p>Active Savings</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
        </div>
      </div>


      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background: orangered;">
          <div class="inner">
            <h3>₦{{ $invest }} </h3>
            <p>Active Investment</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
        </div>
      </div>
    </div>


      <div class="card">
          <div class="card-header">
              <h3 class="card-title"><b>Recent Transactions</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <td>Date</td>
                      <td>Amount</td>
                      <td>Reference Number</td>
                      <td>Processed By</td>
                      <td>Remark</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($recent as $key){?>
                  <tr>
                      <td><?php echo date('jS M Y', $key->ctime) ?></td>
                      <td>₦<?php echo  $key->cos ?></td>
                      <td><?php echo  $key->trno ?></td>
                      <td><?php echo  uName($key->rep) ?></td>
                      <td><?php echo $key->remark ?></td>
                  </tr>

                  <?php } ?>
                  </tbody>
              </table>
          </div>
          <!-- /.card-body -->
      </div>
  </div>


</section>




@endsection
