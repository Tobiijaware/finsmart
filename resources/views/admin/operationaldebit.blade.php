@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Debit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Operational Debit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Operational Debit</h3>
      <form method="post" action="/getdetails"> 
        @csrf 
    <div style="float:right">
       <table><tr><td>
           <select class="form-control select2" onchange="submit()" name="mm" required>
        <?php $mth = session()->has('month1')?session()->get('month1'):date("m");  ?>
      <option selected="selected" value="{{$mth}}">{{date("F",mktime(0,0,0, $mth))}}</option>
          <?php  for ($i=1; $i <13 ; $i++) { if($i==$mth){continue;}   ?>
              <option value="{{$i}}">{{date("F",mktime(0,0,0, $i))}}</option>
          <?php } ?>
      </select></td><td>
    {{-- <button  class="btn btn-warning"><i class="fa fa-search"></i> Search Deposits</button> --}}
</td></tr></table></div></form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table  table-striped">
            <thead>
            <tr>
              <th>SN</th> 
              <th>Transaction ID</th>
              <th>Client Name</th>
              <th>Deposit</th>
              <th>Date</th>
              <th>Remark</th>
              <th>Processed By</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php 
                    $i=0;
                    $e=0;
                    $n=1;
                    $sum=0;
                    foreach($datas as $key){
                $sum += $key->cos; ?>
                    <tr>
                    <td>{{$n++}}</td>
                    <td>{{$key->trno}}</td>
                    <td><?php echo $user[$i];$i++;?></td>
                    <td>₦{{number_format($key->cos,2)}}</td>
                    <td>{{date('jS M, Y',$key->ctime)}}</td>
                    <td>{{$key->remark}}</td>
                    <td><?php echo $rep[$e];$e++;?></td>
                    <?php } ?>
                    </tr>
                   
                                   
                </tr>
           
                           
            
          
            </tbody>
          
          </table>
    <table>
        <tr><td colspan="3">Total Deposits</td><td>₦{{number_format($sum,2)}}</td><td colspan="4"></td></tr>
    </table>
    </div>
    <!-- /.card-body -->
  </div>

  <script>
      let newtd = document.getElementById('td');
      console.log(newfont);
      newtd.style.fontSize = '12px';
  </script>
@endsection