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
            <small>Loan Repayments</small>
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
                  <h3 class="box-title"> Loan Operational Payments Recent Loan Operational Payments</h3>
                <form method="post">  <div style="float:right">
                   <table><tr><td><select class="form-control select2" name="mm">
                       
                <option value=""></option>
               
     </select></td><td>
    <button  class="btn btn-warning"><i class="fa fa-search"></i> Search Repayments </button></td></tr></table>  </div></form>
                </div>
                <!-- /.box-header -->
                <div class="box-body  table-responsive">
                <form method="post">
                 
                  <table id="example2" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>SN</th> 
                      <th>Transaction ID</th>
                      <th>Client Name</th>
                      <th>Payment</th>
                      
                      <th>Date</th>
                      
                      <th>Remark</th>
                      <th>Processed By</th>
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
                    </tr> 
                   
                    echo <tr><th colspan="3">Total Payments</td><td></td><th colspan="4"></td></tr>                   
                   
                <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      <td></td>
                     
                      <td></td>
                       <td></td>
                        <td></td>
                    </tr>
                  
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