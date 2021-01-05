@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Investment Deposits</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Investment Deposits</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Investment Deposits</h3>
      <form method="post" action="/sessionmonth"> 
        @csrf
        <div style="float:right">
        <table><tr><td><select class="form-control select2" name="mm" required>
          <?php $mth = session()->has('month1')?session()->get('month1'):date("m");  ?>
        <option selected="selected" value="{{$mth}}">{{date("F",mktime(0,0,0, $mth))}}</option>
            <?php  for ($i=1; $i <13 ; $i++) { if($i==$mth){continue;}   ?>
                <option value="{{$i}}">{{date("F",mktime(0,0,0, $i))}}</option>
            <?php } ?>
        </select></td><td><select name="yy" class="form-control select2" required>
          <?php $cy = session()->has('year1')?session()->get('year1'):date("y");  ?>
          <option selected="selected" value="{{$cy}} " selected>{{$cy}} </option>
            <?php  $prev2 = date("y")-1;
            for($year=date("y") ;$year>=$prev2;$year--){
                if($year == $cy){ continue;}else { ?>
                  <option value="{{$year}} ">{{$year}} </option>
            <?php } } ?>
        </select></td><td>
        <button type="submit" class="btn btn-outline-warning" name="getmonth"><i class="fa fa-search"></i> Search Deposits </button></td></tr></table>  </div>
        </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
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
           
           
                <?php 
                    $i=0;
                    $e=0;
                    $n=1;
                    $sum=0;
                     $q=0;
                    foreach($datas as $key){
                $sum += $key->cos; ?>
                 <tr>
                    <td>{{$n++}}</td>
                    <td>{{$key->trno}}</td>
                    <td><?php echo $user[$i];$i++;?></td>
                  <td>₦{{number_format($key->cos,2)}}</td>
                  <td>{{date('jS M, Y',$key->ctime)}}</td>
                    <td><?php echo $remark[$q]; $q++;?></td>
                    <td><?php echo $rep[$e];$e++;?></td>
                    <?php } ?>
                  </tr>
         
        </tbody>      
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







