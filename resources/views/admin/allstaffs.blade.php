@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">All Staffs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Staffs</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">All Staffs</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sn</th> 
            <th>Name</th> 
            <th>Role</th>
            <th>Payroll</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
                
              <?php 
              $i=1;
               foreach($staffs as $key){
                  ?>
                  <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo getStaff($key->userid); ?></td>
                <td><?php echo Role($key->userid); ?></td>
                <td><?php echo Payroll($key->userid); ?></td>
                <td><?php echo Status($key->userid); ?></td>
              
                 <td>
                  <form action="/managestaffs" method="POST">
                      @csrf
                     <button class="btn btn-outline-primary btn-xs" name="ManageStaffs" value="{{$key->userid}}">Manage</button>
                  </form>
                  </td>
              </tr>
              <?php } ?>     
                </tbody>        
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection