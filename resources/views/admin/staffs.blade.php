@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$yes = new Controller;
@endphp 
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Staffs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Staff Setup</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Search  Clients</h3>
            <div style="float:right"> 
                <form method="POST" action="/searchstaffs" role="search">
                 {{ csrf_field() }}
                <table>
                  <tr><td><input type="search" name="q" class="form-control" placeholder="Enter Keyword" required></td>
                  <td><button type="submit" class="btn btn-outline-warning"><i class="fa fa-search"></i>Search Client </button></td>
                </form>
                <td>
                <form method="post" action="/reset">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Reset</button>
                </form>
                </td>
                  </tr>

                  
                </table>
               
               
               
                  
                    
             
                   
                </div>
        </div>
        <?php 
        $details = session()->get('details');
        if($details){
    ?>
        <div class="card-body">
            <table id="example1" class="table  table-striped">
                <thead>
                <tr>
                  <th>Surname</th>
                  <th>Other Names</th>
                  <th>E-mail</th>
                  <th>Phone No</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($details as $user)
                <tr>
                  <td>{{$user->surname}}</td>
                  <td>{{$user->othername}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->address}}</td>
                
                  <td>
                   
                        <button class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#modal-create">Create Staff</button>
                   
                    </td>
                </tr>  
                  @endforeach           
                </tbody>
              </table>


              <div class="modal fade" id="modal-create">
                <div class="modal-dialog">
                  <form method="post" action="/addstaffs">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="PUT">  --}}
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-primary text-uppercase">Create Staff</h4>
                    </div>
                    <div class="modal-body">
                        
                     
        
                    <label>Staff Role/Office</label>
                    <input name="role" class="form-control" required/>
                   
                    <label>Staff Payroll</label>
                    <input type="number" name="payroll" class="form-control" required>
                    </div>
        
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" value="{{$user->userid}}" name="addStaff" class="btn btn-outline-primary">Create Staff</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
              </form>
                <!-- /.modal-dialog -->
              </div>
        




             
        </div>
        <?php } ?>
    </div>
    </div> 





   















</div>




@endsection