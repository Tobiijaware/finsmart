@extends('layouts.adminheadside')
@section('content')
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Loans
            <small>Expected Loan  Repayments</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Loan</a></li>
            <li class="active">Loan Repayments</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
    
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Expected Loan Repayments Due Today</h3>
                
                </div>
                <!-- /.box-header -->
                <div class="box-body  table-responsive">
                <form method="post">
                 
                  <table id="example2" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>SN</th> <th>Transaction ID</th>
                      <th>Client Name</th>
                      <th>Total Loan</th>
                      <th>Monthly Repayment </th>
                      <th>Instalment</th>
                      <th>Due Date</th>
                      <th>Card Linked </th>
                       <th>Due</th>
                      <th>Remark</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                       <td></td> 
                        <td></td>
              <td><button class="btn btn-default btn-xs" value="" name="ManageLoan">Manage</button></td>
                    </tr>
                   
                    <tr><td colspan="4">Expeected Repayments</td><td></td><td colspan="6"></td></tr> 
                    <tr><td colspan="4">Received Repayments</td><td></td><td colspan="6"></td></tr> 
                    <tr><td colspan="4">Unpaid Balance</td><td></td><td colspan="6"></td></tr> 
                        
                   
                  
                    </tbody>
                  
                  </table>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
    </div>
</body>
</html>
@endsection  