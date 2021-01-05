@extends('layouts.adminheadside')
@section('content')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Loans
            <small>Disbursed Loan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Loan</a></li>
            <li class="active">Disbursed Loan</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">        
            <div class="col-xs-12">    
              <div class="box">
                <div class="box-header  table-responsive">
                  <h3 class="box-title">Disbursed Loan</h3>
                 <hr>
              
                  <table id="example2"  class="table  table-striped">
                    <thead>
                    <tr>
                      <th>Client </th> 
                      <th>Loan </th> 
                      <th>Interest</th>
                      <th>Repayment</th>
                      <th>Tenure</th>
                      <th>Monthly Tranch</th>               
                      <th>Activation Date </th>                
                      <th>Cash Paid </th> 
                      <th>Remark </th> 
                      <th>Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action="/ViewUserLoan" method="POST">
                    @csrf
                   @foreach($loans as $dat)
                   <tr>
                      <td>{{$user}}</td>
                      <td>₦{{number_format($dat->amount,2)}}</td>
                      <td>₦{{number_format($dat->interest,2)}}</td>
                      <td>₦{{number_format($dat->amount+$dat->interest,2)}}</td>
                      <td>{{$dat->tenure}} Days</td>
                      <td>₦{{number_format($dat->tranch,2)}}</td>
                      <td>₦{{number_format($dat->profee,2)}}</td>
                      <td>{{ $dat->created_at }}</td>
                      <td><?php echo $status ?></td>
                      <td><button class="btn btn-primary btn-xs" name="ManageLoan" value="{{$dat->ref}}">Manage</button></td>
                    </tr>
                   @endforeach                  
                    </tbody>   
                  </table>
                  </form>   
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
    </div>
</body>
</html>
@endsection  
