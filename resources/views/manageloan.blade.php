@extends('layouts.sapp')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Loan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Loan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?php
function rem($total,$tranch,$paid){
  if($paid>=$total){$res = 100;}
  elseif($total-$paid<$tranch){$res =  100-(100*($total-$paid)/$tranch);}
  else{$res=0;}
  return number_format($res,2);
}

?>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Loan Details</h3>
        </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-4  table-responsive">
        <h4>LOAN STATISTICS</h4>
        @foreach($loan as $loan)
        <table class="table">
           <tr>
           <th>Transaction ID</th>
           <td>{{$loan->ref}}</td>
           </tr>
           <tr>
             <th>Loan Status</th>
             <td><?php echo $status; ?></td>
           </tr>
           <tr>
             <th>Loan Amount</th>
             <td>₦{{number_format($loan->amount,2)}}</td>
           </tr>
           <tr>
             <th>Monthly Interest Rate</th>
             <td>{{$loan->rate}}%</td>
           </tr>
           <tr>
             <th>Loan Tenure</th>
             <td>{{$loan->tenure}} Days</td>
           </tr>
           <tr>
             <th>Interest Value</th>
             <td>₦{{number_format($loan->interest,2)}}</td>
           </tr>
           <tr>
             <th>Expected Repayment</th>
             <td>₦{{number_format($loan->interest+$loan->amount,2)}}</td>
           </tr>
           <tr>
             <th>Monthly Repayment</th>
             <td>₦{{number_format($loan->tranch,2)}}</td>
           </tr>
           <tr>
             <th>Number of Repayments</th>
             <td>{{$loan->tenure/30}} </td>
           </tr>
           <tr>
             <th>Processing Fee</th>
             <td>{{number_format($loan->profee,2)}} ({{$loan->prorate}}%)</td>
           </tr>
           <tr>
             <th>Loan Application Date</th>
             <td>{{date('jS M, Y', strtotime($loan->created_at))}} </td>
           </tr>

      @if($loan->status>3)
           <tr>
             <th>Activation Date</th>
             <td><?php echo date('jS M, Y', $loan->start) ?></td>
           </tr>
           <tr>
             <th>Expiry Date</th>
             <td><?php echo date('jS M, Y', $loanExpiry) ?> </td>
           </tr>
           <tr>
             <th>Repayment Received</th>walletloan
             <td>₦<?php $paid = $walletloan; $expected=$loan->interest+$loan->amount;
              echo number_format($paid,2); ?>(<?php echo number_format(100*$paid/$expected,2); ?>%) %</td>
           </tr>
           <tr>
             <th>Balance</th>
             <td>₦<?php echo number_format($expected-$paid,2); ?>
              (<?php echo number_format(100*($expected-$paid)/$expected,2); ?>%)</td>
           </tr>
       @endif
           </table>
       @endforeach
        </div>
        <div class="col-md-6  table-responsive">
            <h4>REPAYMENT SCHEDULE</h4>
            <table class="table">
                <tr>
                  <th>INSTALMENT</th>
                  <th>REPAYMENT</th>
                  <th>DUE DATE </th>
                  <th>REMARK</th>
                </tr>
                <?php $i=1 ; $ctime = $loan->status > 3 ? $loan->start : time();
                      $tranches = $loan->tenure/30;
                      $pay = 0;
                      $tran = $loan->tranch;
                  while($i<=$tranches){ $e=$i++; $ctime += 60*60*24*30; $pay += $tran; $paid = $walletloan  ?>
                  <tr>
                    <td>Instalment <?php echo $e ?></td>
                    <td><?php  echo number_format($loan->tranch,2) ?></td>
                    <td><?php echo date('jS M, Y',$ctime) ?></td>
                    <td><?php echo rem($pay,$tran,$paid) ?>%</td>
                  </tr>
                <?php } ?>
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        @if($loan->status==1)
           <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete">DELETE APPLICATION
           </button>
        @endif
{{--        @if($loan->status==2)--}}
{{--          <form method="POST" action="{{ route('paynew') }}" accept-charset="UTF-8">--}}
{{--        <input type="hidden" name="email" value="{{Auth::user()->email}}"> --}}{{-- required --}}

{{--        <input type="hidden" name="amount" value="{{$loan->profee}}">--}}{{-- required in kobo --}}
{{--        --}}{{-- <input type="hidden" name="quantity" value="1"> --}}
{{--        <input type="hidden" name="currency" value="NGN">--}}
{{--        <input type="hidden" name="metadata" value="2">--}}{{-- For other necessary things you want to add to your payload. it is optional though --}}

{{--        <input type="hidden" name="refer" value="{{$loan->ref}}">--}}{{-- required --}}
{{--        --}}{{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
{{--        --}}{{-- {{ csrf_field() }} works only when using laravel 5.1, 5.2 --}}

{{--        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--        <button type="submit" style="float: right" class="btn btn-outline-primary" name="PayProFee">--}}
{{--         PAY {{ number_format($loan->profee,2) }} PROCESSING FEE </button>--}}
        {{--@else--}}
                @if($loan->status==4)
           <button style="float: right" class="btn btn-outline-success" data-toggle="modal"
            data-target="#modal-payment"> MAKE REPAYMENT </button>
        @endif
       </form>

        <div class="modal modal-warning fade" id="modal-delete">
            <form method="post" action="{{ route('DeleteLoan')}}">
                @csrf
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="text-align: center;">
                <h4 class="modal-title">Warning!!!</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete loan?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" value="{{$loan->ref}}" class="btn btn-outline-danger" name="DeleteLoan">Yes, Delete Loan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
            </form>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


                <div class="modal fade" id="modal-payment">


                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="text-align: center;">
                                    <h4 class="modal-title text-uppercase">REPAY LOAN</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/repayloan">

                                        <input class="form-control" type="hidden" name="email" value="{{Auth::user()->email}}"/>
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount Only No Commas"><br/>
                                        <input type="hidden" name="currency" value="NGN">
                                        @if(!Auth::guest())
                                            <input type="hidden" name="metadata" value="6">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit" value="{{$loan->ref}}" class="btn btn-outline-success" name="refer">Repay Loan</button>
                                </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>

                    <!-- /.modal-dialog -->
                </div>


    {{-- <script type="text/javascript">
      let total = 0;
    [...document.getElementsByClassName('iput')].forEach(function(item) {
      item.addEventListener('change', function(e) {
        if (e.target.checked) {
          total += parseInt(e.target.value, 10)
        } else {
          total -= parseInt(e.target.value, 10)
        }
        document.getElementById('total').innerHTML = total
      })

    })
    </script> --}}
    </div>
</div>
</div>





@endsection
