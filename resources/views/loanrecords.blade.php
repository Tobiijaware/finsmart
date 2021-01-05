@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Loan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create Loan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Loan Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Loan </th> 
                      <th>Interest</th>
                      <th>Repayment</th>
                      <th>Tenure</th>
                      <th>Monthly Tranch</th>
                      <th>Processing Fee</th>
                      <th>Application Date </th>
                      <th>Status </th>
                      <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=0;
                    foreach($loans as $loandata){ $e=$i++;?>
                    <tr>
                      <td>₦{{number_format($loandata->amount,2)}}</td>
                      <td>₦{{number_format($loandata->interest,2)}}</td>
                      <td>₦{{number_format($loandata->amount + $loandata->interest,2)}}</td>
                      <td>{{$loandata->tenure}} Days</td>
                      <td>₦{{number_format($loandata->tranch,2)}}</td>
                      <td>₦{{number_format($loandata->profee,2)}}</td>
                      <td>{{$loandata->created_at}}</td>
                      <td><?php echo $status ?></td>
                    <form action="/viewloan" method="POST">
                    @csrf
                      <input type="hidden" name="ref" value="{{$loandata->ref}}">
                      <td><button type="submit" class="btn btn-sm btn-outline-primary">Manage</button></td>
                    </tr>
                    </form>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>








@endsection