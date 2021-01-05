@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
$index = $_GET['index'];
$type = substr($index,40,2);
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Transaction
                <small><?php echo $fin->walletRemark($type) ?></small>
              </h1>

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li><a href="#">Transaction</a></li>
            <li class="active"><?php echo $fin->walletRemark($type) ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title"><?php  $mm = ($mm) ? $mm : date('ym');
        echo date("F Y", mktime(0, 0, 0, substr($mm,2,2), 10)).' '.$fin->walletRemark($type); ?></h3>
         <div style="float:right">
            <table>
            <tr>
            <form method="post" action="/fetchtransact">
            @csrf
              <td>
                <select class="form-control select2" name="mm">
                     <?php
                     $cm = date('m')+12;
                     $a = $cm-16;
                     while($a<=$cm){ $b=$a++; $c = date("F Y", mktime(0, 0, 0, $b, 10));
                     $selected = date("ym", mktime(0, 0, 0, $b, 10))==$mm ? 'selected' : '';
                     echo '<option value="'.date("ym", mktime(0, 0, 0, $b, 10)).'" '.$selected.'>'.$c.'</option>';
                     } ?>
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-outline-warning"><i class="fa fa-search"></i> Search Transaction </button>
              </td>
           </tr>
           </form>
           </table>
          </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example2" class="table  table-striped">
              <thead>
              <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Client Name <?php //echo $mm; ?></th>
                <th>Amount</th>
                <th>Remark</th>
                <th>Processed By</th>
              </tr>
              </thead>
              <tbody>
             <?php
               $sum=0;
               $e=0;
               foreach($fin->operations($mm,$type) as $s){
                   $e += 1;
                   $sum += $s->cos;
                   $rem = $s->type==1 ? $s->remark : $fin->walletRemark($s->type) ?>
                <tr>
                  <td><?php echo $e ?></td>
                  <td><?php echo date('jS M, Y',$s->ctime) ?></td>
                  <td><?php echo $s->trno ?></td>
                  <td><?php echo $fin->uName($s->userid) ?></td>
                  <td><?php echo number_format(abs($s->cos),2) ?></td>
                  <td><?php echo $rem ?></td>
                  <td><?php echo $fin->uName($s->rep) ?></td>
                </tr>
              <?php } ?>
            </table>
              <tr><th colspan="4">Total Value </td><td><?php echo number_format(abs($sum),2) ?></td><th colspan="3"></td></tr>
              </tbody>

    </div>
    <!-- /.card-body -->
  </div>

  <script>
      let newtd = document.getElementById('td');
      console.log(newfont);
      newtd.style.fontSize = '12px';
  </script>
@endsection
