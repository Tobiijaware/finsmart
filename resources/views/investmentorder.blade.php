@extends('layouts.sapp')
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
            <li class="breadcrumb-item active">Investment Applications</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Investment Accounts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
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
                    $i=0;
                      foreach($data as $invdata){ $e=$i++;?>
                      <tr>
                      <td>{{number_format($invdata->amount,2)}}</td>
                        <td>{{number_format($invdata->interest,2)}}</td>
                        <td>{{number_format($invdata->amount+$invdata->interest,2)}}</td>
                        <td>{{($invdata->tenure)}} Days</td>
                        <td>{{($invdata->created_at)}}</td>
                        <td><?php echo $fin->invStatus($invdata->status)?></td>
                        <form action="/viewinvestment" method="POST">
                          @csrf
                        <input type="hidden" name="ref" value="{{$invdata->ref}}">
                      <td><button class="btn btn-sm btn-outline-primary">Manage Investment</button></td>
                        </form>
                      </tr>
                    <?php } ?>
                    </tbody>
                   
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>








@endsection