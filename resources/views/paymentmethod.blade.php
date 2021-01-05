@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Link Debit/Credit Cards</h1>

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Link Debit and Credit Cards</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Linked Cards</h3>
              <div style="float:right"><button type="button" class="btn btn-outline-primary"
                style="float:right" data-toggle="modal" data-target="#modal-changep">
                + Link New Debit Card </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Card Type</th>
                      <th>Last Four Digits</th>
                      <th>Bank</th>
                      <th>Expiry</th>
                        <th>Action</th>
                    </tr>
                      </thead>
                      <tbody>
            <?php foreach($data as $key){  ?>
                    <tr>
                        <td>{{$key->cardtype}}</td>
                        <td>{{$key->lastfour}}</td>
                        <td>{{$key->bank}}</td>
                        <td>{{$key->expmonth.'/'.$key->expyear}}</td>
                        <td>
                            <button class="btn btn-outline-danger btn-xs" href="javascript:void(0)" data-toggle="modal" data-target="#del<?php echo $key->sn ; ?>">Delete</button>
                        </td>
                    </tr>


            <div class="modal fade" id="del<?php echo $key->sn; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-danger">Are You Sure You want to Delete?</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">

                                <form method="post" action="/delcards">
                                    @csrf
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default">No, Cancel</button>
                                    <button type="submit" class="btn btn-outline-danger" name="delcard" value="<?php  echo $key->sn ?>">Yes, Delete</button>
                                </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
              <?php }  ?>
                    </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>






<div class="modal fade" id="modal-changep">
    <form method="POST" action="{{ route('paynew') }}" accept-charset="UTF-8">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

        </div>
        <input type="hidden" name="email" value="oluwatobiijaware@gmail.com"> {{-- required --}}
        {{-- <input type="hidden" name="orderID" value="345"> --}}
        <input type="hidden" name="amount" value="5000"> {{-- required in kobo --}}
        {{-- <input type="hidden" name="quantity" value="1">--}}
        <input type="hidden" name="currency" value="NGN">
        @if(!Auth::guest())
        <input type="hidden" name="metadata" value="1"> {{-- For other necessary things you want to add to your payload. it is optional though --}}
        @endif
        {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  --}}
        {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
        {{-- {{ csrf_field() }}  --}}

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="modal-body" style="font-size: 12px;"><center>
         <h4>To access our loan facilities, you are required to link your <br>active debit card for your salary account. You will be charge a fee of <br>NGN 50.00 for card verification</h4>

         </center>
        </div>
        <div class="modal-footer">


          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="LinkNewCard" class="btn btn-outline-primary">Link New Debit Card</button>
        </div>
      </div>
    </div>
    </form>
  </div>
@endsection
