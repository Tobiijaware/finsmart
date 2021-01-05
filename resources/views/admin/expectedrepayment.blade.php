@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
$tr=''; $tm=''; $tz=''; $ty=''; $tr1='';

if(isset($_GET['trid'])){ $trid = $_GET['trid']; $tr=substr($trid,10,8);}
if(isset($_GET['tmid'])){ $tmid = $_GET['tmid']; $tm=substr($tmid,10,6);   $tr1=substr($tmid,10,8);}
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Repayment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Expected Repayment</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo $year ?? ''; ?> Account Summary</h3>
            <form method="post" action="/fetchyearr">
                @csrf
                  <select name="year" class="form-control" onchange="submit()">
                    <option value="">SELECT YEAR...</option>
                    <option><?php echo date('Y')-1 ?></option>
                    <option><?php echo date('Y') ?></option>
                    <option><?php echo date('Y')+1 ?></option>
                  </select>
                </form>
        </div>
        <div class="card-body">
            <table class="table color-bordered-table purple-bordered-table">
                <thead>
                  <tr>
                    <th>Category</th>
                     <?php 
                     $a=1; 
                     while($a<=12){
                       $b=$a++;
                       $month = date("F", mktime(0, 0, 0, $b, 10)) ;
                       echo '<th>'.strtoupper(substr($month, 0,3)).'</th>'; 
                     } 
                     ?>
                    <th>TOTAL</th>
                  </tr>
                </thead>
                  <tbody>
                   <tr>
                     <th>Expected Repayment</th>
                     <?php 
                     $yy = $year;
                     $e=0;
                     $a=1; 
                     $ytotal=0; 
                     while($a<=12){
                       $b=$a++; 
                       $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                    $bgc = $tr==$bx.$e ? ' style="background-color: yellow"' : ''; ?> 
                    <?php  
                    $ytotal += $fin->monthlyExpected($bx); 
                    echo 
                    '<td'.$bgc.'>
                      <a href="?trid='.rand(1000000000,9999999999).$bx.$e.'">'
                        .number_format($fin->monthlyExpected($bx)).
                      '</a>
                     </td>'; 
                      }
                     $bgc = $ty==$bx.$e ? ' style="background-color: yellow"' : ''; ?>
                    <?php  echo '<td>'.number_format($ytotal).'</td>' ?>
                </tr>

                <tr>
                  <th>Actual Repayment</th>
                    <?php 
                    $a=1; 
                    $ytotal=0; 
                    while($a<=12){
                      $b=$a++; 
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                      $bgc = $tr1==$bx.$e ? ' style="background-color: yellow"' : ''; ?> 
                    <?php  $ytotal += $fin->monthlyActual($bx); 
                    echo 
                    '<td'.$bgc.'>
                       <a href="?tmid='.rand(1000000000,9999999999).$bx.$e.'">'
                       .number_format($fin->monthlyActual($bx)).
                       '</a>
                    </td>'; 
                     }
                     $bgc = $ty==$bx.$e ? ' style="background-color: yellow"' : ''; ?>
                     <?php  echo '<td>'.number_format($ytotal).'</td>' ?>
                </tr>
                                

                  <tr>
                      <th colspan="1">DIFFERENCE</th>
                        <?php 
                        $a=1; 
                        $sum=0; 
                        while($a<=12){
                          $b=$a++; 
                          $bx = $b<10 ? $yy.'0'.$b : $yy.$b;
                        $to = $fin->monthlyActual($bx)-$fin->monthlyExpected($bx);
                        $bg = $to<0 ? ' style="background-color: red; color: white"' :
                        'style="background-color: green; color: white"';?> 
                      <th <?php echo $bg ?> ><?php $sum += $to;  echo number_format($to) ?></th> 
                      <?php }  
                        $bg = $sum<0 ? ' style="background-color: red; color: white"' :'style="background-color: green;
                         color: white"';  ?>
                      <th <?php echo $bg ?> ><?php  echo number_format($sum) ?></th>
                  </tr>
               
              </table>
        </div>
    </div>
    </div>  

    <?php if(isset($_GET['trid'])){ 
        $trid = $_GET['trid']; $type=substr($trid,16,2); $mm = substr($trid,12,4); 
        $tr=substr($trid,10,8);  ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php $title = ' Expected Repayment' ;
                echo date("F Y", mktime(0, 0, 0, substr($mm,2,2), 10)).$title; ?>: <?php echo $fin->walletRemark($type);  ?></h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table  table-striped">
                <thead>
                <tr>
                  <th>SN</th> 
                  <th>Transaction ID</th>
                  <th>Client Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $sum=0; 
                  $e=0; 
                  foreach($sql2 as $ss){
                    if(date('ym',$ss->start)==$mm){
                    $e += 1;
                    $sum += $ss->tranch; ?>
                  <tr>
                    <td><?php echo $e ?></td>
                    <td><?php echo $ss->ref ?></td>
                    <td><?php echo $fin->uName($ss->userid) ?></td>
                    <td>₦<?php echo number_format(abs($ss->tranch),2) ?></td>
                    <td><?php echo date('jS M, Y',$ss->start) ?></td>
                  </tr>
                  <?php } } ?>
                 <tr><th colspan="3">Total </td><td>₦<?php echo number_format(abs($sum),2) ?></td><th colspan="4"></td></tr>                                  
                </tbody>   
              </table>
        </div>
    </div>
</div>  
<?php } ?>

<?php if(isset($_GET['tmid'])){ 
    $tmid = $_GET['tmid']; $type=substr($tmid,16,2); $mm = substr($tmid,12,4); 
    $tm=substr($tmid,10,8);  ?>
 <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php $title = ' Actual Repayment';
                echo date("F Y", mktime(0, 0, 0, substr($mm,2,2), 10)).$title; ?></h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table  table-striped">
                <thead>
                <tr>
                   <th>SN</th> 
                  <th>Transaction ID</th>
                  <th>Client Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Remark</th>
                  <th>Processed By</th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  $sum=0; 
                  $e=0; 
                  foreach($sql3 as $s){
                    if($s->yy.$s->mm ==$mm){
                    $e += 1;
                    $sum += $s->cos; 
                    $rem = $fin->walletRemark($s->type);?>
                  <tr>
                    <td><?php echo $e ?></td>
                    <td><?php echo $s->trno ?></td>
                    <td><?php echo $fin->uName($s->userid) ?></td>
                    <td>₦<?php echo number_format(abs($s->cos),2) ?></td>
                    <td><?php echo date('jS M, Y',$s->ctime) ?></td>
                    <td><?php echo $rem ?></td>
                    <td><?php echo $fin->uName($s->rep) ?></td>
                  </tr>
                  <?php } } ?>
                  <tr><th colspan="3">Total Debit</td><td>₦<?php echo number_format(abs($sum),2) ?></td><th colspan="4"></td></tr>                                 
              </tbody>
              
              </table>
        </div>
    </div>
    </div>  
<?php } ?>
@endsection