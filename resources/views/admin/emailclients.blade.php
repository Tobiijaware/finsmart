@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Email Clients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Send Email To Clients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Email Clients</h3>
        </div>
        <div class="card-body">
            <form method="post"  action="/send-email">
                @csrf
                <div class="form-group">
                    <input type="text" name="subject" class="form-control mb-4" placeholder="E-MAIL SUBJECT"> 
                  
                 </div>
                 <div class="form-group">
                  <textarea rows="5"
                   class="form-control" name="message"
                   placeholder="Enter E-mail message here"></textarea>
                 </div>
                 <div class="box-footer">
                    <button type="submit"  class="btn btn-outline-primary btn-block pull-right">SEND EMAIL TO ALL CLIENTS</button>
                  </div>

                   

            </form>
        </div>
    </div>
    </div>  
    </div>
   

@endsection