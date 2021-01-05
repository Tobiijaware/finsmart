@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Search Clients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Search Clients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Search Clients</h3>
            <div style="float:right"> 
                <form action="/search" method="POST" role="search">
                  {{ csrf_field() }}

                    <table><tr><td><input name="q" type="search" class="form-control" placeholder="Enter Keyword" required></td><td>
                  </td><td>
                    <button type="submit" class="btn btn-outline-warning"><i class="fa fa-search"></i> Search Client </button>
                  </td></tr></table>
                </form>
                </div>
        </div>
        <div class="card-body">
            <?php 
            $details = session()->get('details');
            if($details){ ?>
            <table id="example1" class="table table-striped">
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
                 @foreach($details as $user)
                 <tr>
                   <td>{{$user->surname}}</td>
                   <td>{{$user->othername}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->accountno}}</td>
                   <form method="post" action="/viewclientdetails">
                   @csrf
                  <input name="viewclientprofile" type="hidden" value="{{$user->userid}}">
                  <td><button class="btn btn-sm btn-outline-primary">Profile</button></td>
                  </form>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>Surname</th>
                  <th>Other Names</th>
                  <th>E-mail</th>
                  <th>Phone No</th>
                  <th>Address</th>
                  <th>Account Number</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
                <?php } ?> 
        </div>
    </div>
    </div>  
</div>

@endsection