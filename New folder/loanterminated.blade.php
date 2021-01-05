@extends('layouts.adminheadside')
@section('content')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Loans
            <small>Terminated Loans</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Loan</a></li>
            <li class="active">Terminated Loans</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
        <div class="col-xs-12">
    
              <div class="box">
                <div class="box-header  table-responsive">
                  <h3 class="box-title">Terminated Loans</h3>
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
                      <th>Processing Fee</th>
                      <th>Application Date </th>
                      <th>Status </th>
                      <th>Action </th>
                    </tr>
                    </thead>
                    <tbody>
                           
             <form action="/ViewUserLoan" method="POST">
                    @csrf
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td> Days</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>                 
                       <td><button class="btn btn-primary btn-xs" name="ManageLoan" value="">Manage</button></td>
                    </tr>                 
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