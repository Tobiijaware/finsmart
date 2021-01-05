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
          <h1 class="m-0 text-dark">System Setup</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create And Manage Admins</li>
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
                <form method="POST" action="/searchadmin" role="search">
                 {{ csrf_field() }}
                <table>
                  <tr><td><input type="search" name="q" class="form-control" placeholder="Enter Keyword" required></td>
                  <td><button type="submit" class="btn btn-outline-warning"><i class="fa fa-search"></i> Search Client </button></td>
                  </tr>
                </table>
                </form>
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
                    <form method="post" action="/addAdmin"> 
                        @csrf
                      <button class="btn btn-outline-primary btn-xs" name="addAdmin" value="{{$user->userid}}" 
                        name="CreateNew">Create Admin</button>
                    </form>
                    </td>
                </tr>  
                  @endforeach           
                </tbody>
               
              </table>
             
        </div>
        <?php } ?>
    </div>
    </div>  












    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">System Administrators</h3>
            </div>
            <div class="card-body">
                <table  class="table" id="example1">
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
                      
                        <?php foreach($admins as $admin){?>
                    <tr>
                     
                      <td>{{$admin->surname}}</td>
                      <td>{{$admin->othername}}</td>
                      <td>{{$admin->email}}</td>
                      <td>{{$admin->phone}}</td>
                      <td>{{$admin->address}}</td>
                    
                      <td>
                        <form method="post" action="/manageadmin">
                            @csrf
                          <button class="btn btn-outline-primary btn-sm" value="{{$admin->userid}}" 
                            name="ManageAdmin">Manage Admin</button>
                        </form>
                        </td>            
                    </tr>
                   
                    <?php } ?>
                    
                    </tbody>
    
                  </table>
            </div>
        </div>
        </div>  







        <?php $data = session()->get('data'); 
        //return json_encode($data);
        if($data){
        ?>

        <div class="col-md-12">
            <?php 
            $useridd = '';
            $bid = '';
            foreach($data as $key ){
              $bid =  bid();
              $useridd = $key->userid;
            }
            
            
            ; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Set System Administrator Permissions for: <?php echo $yes->uName($useridd); ?></h3>
                    <div style="float:right"> 
                        <form method="post" action="/viewclientdetails">
                          @csrf
                        
                        <input name="viewclientprofile" type="hidden" value="{{$useridd}}">
                        <button type="submit" class="btn btn-outline-success btn-sm">Profile</a>
                        </form>
                        </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/setpermission">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                                  <div class="col-md-12  table-responsive">
                                   <table class="table">
                                    <tr><th colspan="3">LOAN PERMISSIONS</td></tr>
                                    <tr><td>Submit Loan Applications for clients</th>
                                      <td><label><input type="radio" class="flat-red" name="l1" value="1" <?php if($yes->adminName($useridd,'l1')==1){echo 'checked'; } ?>> YES </label></td>
                                      <td><label><input type="radio" class="flat-red" name="l1" value="0" <?php if($yes->adminName($useridd,'l1')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Review & Approve Loan Applications</th>
                                      <td><label><input type="radio" class="flat-red" name="l2" value="1" <?php if($yes->adminName($useridd,'l2')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="l2" value="0" <?php if($yes->adminName($useridd,'l2')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Receive & Confirm Processing Fee</th>
                                      <td><label><input type="radio" class="flat-red" name="l3" value="1" <?php if($yes->adminName($useridd,'l3')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="l3" value="0" <?php if($yes->adminName($useridd,'l3')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Review and disburse Loan</th>
                                      <td><label><input type="radio" class="flat-red" name="l4" value="1" <?php if($yes->adminName($useridd,'l4')==1){echo 'checked'; } ?> > YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="l4" value="0" <?php if($yes->adminName($useridd,'l4')==0){echo 'checked'; } ?>> NO </label> </td></tr> 
                                    <tr><td>Receive Loan Repayment</th>
                                      <td><label><input type="radio" class="flat-red" name="l5" value="1" <?php if($yes->adminName($useridd,'l5')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="l5" value="0" <?php if($yes->adminName($useridd,'l5')==0){echo 'checked'; } ?>> NO </label> </td></tr> 
                
                                    <tr><th colspan="3">SAVINGS PERMISSIONS</td></tr>
                                    <tr><td>Create Savings Plans for clients</th>
                                      <td><label><input type="radio" class="flat-red" name="s1" value="1" <?php if($yes->adminName($useridd,'s1')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="s1" value="0" <?php if($yes->adminName($useridd,'s1')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Receive Savings Deposit</th>
                                      <td><label><input type="radio" class="flat-red" name="s2" value="1" <?php if($yes->adminName($useridd,'s2')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="s2" value="0" <?php if($yes->adminName($useridd,'s2')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Liquidate Savings</th>
                                      <td><label><input type="radio" class="flat-red" name="s3" value="1" <?php if($yes->adminName($useridd,'s3')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="s3" value="0" <?php if($yes->adminName($useridd,'s3')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    
                                  
                                    <tr><th colspan="3">INVESTMENT PERMISSIONS</td></tr>
                                    <tr><td>Create Investment Plans for clients</th>
                                      <td><label><input type="radio" class="flat-red" name="i1" value="1"<?php if($yes->adminName($useridd,'i1')==1){echo 'checked'; } ?> > YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="i1" value="0" <?php if($yes->adminName($useridd,'i1')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Approve Investment Plans</th>
                                      <td><label><input type="radio" class="flat-red" name="i2" value="1" <?php if($yes->adminName($useridd,'i2')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="i2" value="0" <?php if($yes->adminName($useridd,'i2')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Receive Investment Deposits</th>
                                      <td><label><input type="radio" class="flat-red" name="i3" value="1" <?php if($yes->adminName($useridd,'i3')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="i3" value="0" <?php if($yes->adminName($useridd,'i3')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Liquidate Investments</th>
                                      <td><label><input type="radio" class="flat-red" name="i4" value="1" <?php if($yes->adminName($useridd,'i4')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="i4" value="0" <?php if($yes->adminName($useridd,'i4')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    
                                  
                                    <tr><th colspan="3">OTHER PERMISSIONS</td></tr>
                                    <tr><td>Manage System Setup</th>
                                      <td><label><input type="radio" class="flat-red" name="o1" value="1" <?php if($yes->adminName($useridd,'o1')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o1" value="0" <?php if($yes->adminName($useridd,'o1')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Manage Financial Reports</th>
                                      <td><label><input type="radio" class="flat-red" name="o2" value="1" <?php if($yes->adminName($useridd,'o2')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o2" value="0" <?php if($yes->adminName($useridd,'o2')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Manage System Dashboard</th>
                                      <td><label><input type="radio" class="flat-red" name="o3" value="1" <?php if($yes->adminName($useridd,'o3')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o3" value="0" <?php if($yes->adminName($useridd,'o3')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Send SMS & Emails to Clent</th>
                                      <td><label><input type="radio" class="flat-red" name="o4" value="1" <?php if($yes->adminName($useridd,'o4')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o4" value="0" <?php if($yes->adminName($useridd,'o4')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Update Client's Data</th>
                                      <td><label><input type="radio" class="flat-red" name="o5" value="1" <?php if($yes->adminName($useridd,'o5')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o5" value="0" <?php if($yes->adminName($useridd,'o5')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                    <tr><td>Edit Transaction</th>
                                      <td><label><input type="radio" class="flat-red" name="o6" value="1" <?php if($yes->adminName($useridd,'o6')==1){echo 'checked'; } ?>> YES </label> </td>
                                      <td><label><input type="radio" class="flat-red" name="o6" value="0" <?php if($yes->adminName($useridd,'o6')==0){echo 'checked'; } ?>> NO </label> </td></tr>
                                   
                                  
                                    </table>
                                </div>
                                            <div class="col-md-5"><i>
                                              Last updated on</i>
                                            </div>
                                              <div class="col-md-2">
                                                <br>
                                         <input type="password" name="password" class="form-control" required placeholder="Authenticate">
                                            </div>
                                            <div class="col-md-3">
                                 <br>
                                            <input type="hidden" name="userid" value="<?php echo $useridd ?>">
                                            <button type="submit" name="UpdateAdmin" value="{{$bid}}" class="btn btn-outline-primary"> UPDATE ADMIN PERMISSIONS</button>
                                  </div><br>
                                </form>
                                <form method="post" action="/deleteadmin">
                                    
                                    <div class="col-md-2">
                                    
                               <input type="password" name="password" class="form-control" required placeholder="Authenticate">
                                  </div>
                        <div class="col-md-2">
                                   <br>
                                 
                  
                               
                                  @csrf  
                        <button type="submit" value="{{$useridd}}" name="RemoveAdmin" class="btn btn-outline-danger">REMOVE ADMIN</button>
                                </form>    
                </div>
            </div>
            </div>  
        <?php } ?>
    </div>


@endsection