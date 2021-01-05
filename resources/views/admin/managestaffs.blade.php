@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Staff</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Staff</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-lg-4">
    <div class="card">
      <?php foreach($staffdata as $key){?>
        <div class="card-header">
            <h3 class="card-title"><b>{{getStaff($key->userid)}}</b></h3>
        </div>
        <div class="card-body">


                    <div>
                        <form method="post" action="/updatestaffdetails">
                            @csrf
                            <label>Add Payment Type</label>
                            <input type="text" class="form-control" name="paytype" required/><br/>

                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" required/><br/>

                            <label>Expected Amount</label>
                            <input type="number" class="form-control" name="exp"/><br/>

                            <label>Date Of Payment</label>
                            <input type="date" class="form-control" name="dateofpay" required/><br/>

                            {{-- <label>Date Of Resumption</label>
                            <input type="date" class="form-control" name="dateofresump" required/><br/> --}}

                            <label>Transaction Type</label>
                            <select name="transactype" class="form-control">
                              <option value="credit">Credit</option>
                              <option value="debit">Debit</option>
                            </select><br/>
                            <button value="{{$key->userid}}" name="Paydetails" class="btn-outline-primary btn btn-sm">Update</button>
                        </form><br>
                    </div>
                    <div style="display: flex!important;jusify-content:space-between!important;">
                    <div class="mr-2">

                            {{-- <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete">Delete Staff</button> --}}


                    </div>
                    <div>
                        <?php if (Status($key->userid)>0){?>
                            <form method="post" action="/deactivatestaff">
                                @csrf
                                <button name="deactivate" value="{{$key->userid}}" class="btn-outline-warning btn btn-sm">Deactivate</button>
                            </form>
                        <?php }elseif(Status($key->userid)<0){?>
                            <form method="post" action="/activatestaff">
                                @csrf
                                <button name="activate" value="{{$key->userid}}" class="btn-outline-success btn btn-sm">Activate</button>
                            </form>
                        <?php } ?>

                    </div>
                </div>




        </div>
        <?php } ?>
    </div>
    </div>


    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payroll Details</h3>
                <?php//  $mm = ($mm) ? $mm : date('ym');
        //echo date("F Y", mktime(0, 0, 0, substr($mm,2,2), 10)); ?>
                <div style="float:right">
                  <table>
                  <tr>
                  <form id="tranx">
                  @csrf
                    <td>
                      <select class="form-control select2" id="mm">
                           <?php
                           $mm = ($mm) ? $mm : date('ym');
                           $cm = date('m')+12;
                           $a = $cm-16;
                           while($a<=$cm){ $b=$a++; $c = date("F Y", mktime(0, 0, 0, $b, 10));
                           $selected = date("ym", mktime(0, 0, 0, $b, 10))==$mm ? 'selected' : '';
                           echo '<option value="'.date("ym", mktime(0, 0, 0, $b, 10)).'" '.$selected.'>'.$c.'</option>';
                           } ?>
                      </select>
                    </td>
                    <td>

                      <input type="hidden" value="{{ csrf_token()}}" id="csrf">
                      <button  id="btnSearch" name="getD" data-value="{{$key->userid}}" class="btn btn-md btn-outline-warning"><i class="fa fa-search"></i> Search Transaction</button>
                    </td>
                 </tr>
                 </form>
                 </table>
                </div>
            </div>
            <div class="card-body">
              <div id="tableData"></div>
            </div>
        </div>
        </div>
</div>

{{-- <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <form method="post" action="/deletestaff">
        @csrf
        <input type="hidden" name="_method" value="PUT">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-danger text-uppercase">DELETE</h4>
        </div>
        <div class="modal-body">
            <h4 class="text-danger">Are You Sure??!!</h4>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="delete" value="{{$key->userid}}" class="btn btn-outline-danger">Delete Staff</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </form>
    <!-- /.modal-dialog -->
  </div> --}}


@endsection
