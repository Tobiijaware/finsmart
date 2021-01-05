@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">SMS Clients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">SMS Clients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sms Clients</h3>
        </div>
        <div class="card-body">
            <form method="post" action="/sendsmstoallusers">
              @csrf
            <div class="col-md-12">
                <div class="form-group">
                  <textarea class="form-control" name="sms" placeholder="Enter E-mail message here"></textarea>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit"  name="sendToAllSms" class="btn btn-outline-primary btn-block">SEND SMS TO ALL CLIENTS</button>
            </div>
            </form>
        </div>
    </div>
    </div>  
    </div>


@endsection