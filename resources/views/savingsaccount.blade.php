@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Savings Account</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Savings Account</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Savings Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>SN</th> 
                       <th>Periodic Amount </th>
                      <th>Yearly Rate</th>
                      <th>Savings Cycle</th>
                      <th>Application Date</th>               
                      <th>Status </th>
                       <!--  <th>Reference </th> -->
                      <th>Action </th>
                    </tr>
                    </thead>
                    <tbody>
                       
                        <?php 
                        $i=1;
                        foreach($savings as $savingsdata){ $e=$i++;?>
                        <tr>
                          <td>{{$e}}</td>
                          <td>₦{{number_format($savingsdata->amount,2)}}</td>
                          <td>{{number_format($savingsdata->rate*12,2)}}%</td>
                          <td>{{$savingsdata->period}} days</td>
                          <td>{{$savingsdata->created_at}} </td>
                          <td><?php echo $status ?></td>
                          <form action="{{route('viewsavings')}}" method="POST">
                            @csrf
                          <input type="hidden" name="ref" value="{{$savingsdata->ref}}">
                          <td><button type="submit" class="btn btn-sm btn-outline-primary">Manage</button></td>
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