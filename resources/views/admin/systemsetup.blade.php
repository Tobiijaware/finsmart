@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">System Setup</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">System Information</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin Information</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <?php 
                    foreach($cdetails as $details){ ?>
                     <tr><th>Company Name</th><td>{{$details->company}}</td></tr> 
                        <tr><th>Primary Phone Number</th><td>{{$details->phone}}</td></tr> 
                        <tr><th>Alternate Phone Number</th><td>{{$details->phone2}}</td></tr>
                        <tr><th>Support E-mail</th><td>{{$details->email}}</td></tr> 
                        <tr><th>Company Address</th><td>{{$details->address}}</td></tr>
                        <tr><th>Primary Company Banker</th><td>{{$details->bank}}</td></tr> 
                        <tr><th>Primary Account Number</th><td>{{$details->accno}}</td></tr>
                        <tr><th>Primary Account Name</th><td>{{$details->accname}}</td></tr>
                        <tr><th>SMS Sender ID</th><td>{{$details->senderid}}</td></tr>
                    <?php } ?>
                </table>
        </div>
    </div>
    </div>  



    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update System Information</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="/showsetup">
                    @csrf
                      <div class="form-group">
                        <div class="col-sm-12"><label>Setup Field</label>
                            <?php $det = session()->get('val');?>
                          <select name="updateKey2" class="form-control" onchange="submit()" required >
                            <option selected disabled> Select Field...</option>
                            <option value="company" >Company Name</option>
                            <option value="phone"> Primary Phone Number</option>
                            <option value="phone2"> Alternate Phone Number</option>
                            <option value="email"> Support Email</option>
                            <option value="address" > Company Address</option>
                            <option value="accname" >Account Name</option>
                            <option value="bank" > Primary Company Banker</option>
                            <option value="accno"> Primary Bank Account Number</option>
                            <option value="senderid" > SMS Sender ID</option>
                          </select>
                        </div>
                      </div>
                    </form>
                    <form class="form-horizontal" method="post" action="/updatesetup">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                      <div class="form-group">
                     
    
                        <div class="col-sm-12">
                          <input type="text" value="{{session()->get('val') ?? ''}}" class="form-control" name="fieldname" placeholder="Setup Field">
                        </div>
                      </div>
    
                      <div class="form-group">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary btn-block" name="UpdateSetup">Update Profile</button>
                        </div>
                      </div>
    
                    </form>




            </div>
        </div>
        </div>  
    </div>




@endsection