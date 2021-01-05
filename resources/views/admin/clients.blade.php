@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Clients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Clients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Clients</h3>
            <div style="float:right"> <a href="/displayclients" class="btn btn-outline-warning">
                <i class="fa fa-search"></i> Search Client </a>  <a href="/newclient" 
                class="btn btn-outline-primary">+ Register New Client </a></div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Surname</th>
                      <th>Other Names</th>
                      <th>E-mail</th>
                      <th>Phone No</th>
                      <th>Address</th>
                      <th>Account Number</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach($user as $user){ ?>
                      <tr>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->othername}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->accno}}</td>
                        <td>
                          <form method="post" action="/viewclientdetails">
                            @csrf
                          <input name="viewclientprofile" type="hidden" value="{{$user->userid}}">
                          <button type="submit" class="btn btn-sm btn-outline-primary">Profile</button>
                          </form>
                        </td>
                    </tr> 
                    <?php } ?>
                  
                    </tbody>
              </table>
        </div>
    </div>
    </div>  
    </div>
@endsection