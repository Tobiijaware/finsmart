@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
$tr=''; $tm=''; $tz=''; $ty='';
if(isset($_GET['trid'])){ $trid = $_GET['trid']; $tr=substr($trid,10,8);  }
if(isset($_GET['tmid'])){ $tmid = $_GET['tmid']; $tm=substr($tmid,10,6);  $tz=substr($tmid,16,2);   }
if(isset($_GET['tnid'])){ $tnid = $_GET['tnid']; $tn=substr($tnid,10,6);  $ty=substr($tnid,10,8);   }

@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Account Summary</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Account Summary</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
</div><!-- /.container-fluid -->
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="margin-bottom: 8px!important;"><?php echo $year ?? ''; ?> Account Summary</h3>
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
            <table id="example2" class="table color-bordered-table purple-bordered-table">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>TRANSACTION CATEGORY</th>
                     <?php 
                     $a=1; 
                     while($a<=12){
                       $b=$a++;
                       $month = date("F", mktime(0, 0, 0, $b, 10)) ;
                       echo '<th>'.strtoupper(substr($month, 0,3)).'</th>'; 
                     }  ?>
                    <th>TOTAL</th>
                  </tr>
                 </thead>
                 <tbody>
                  <tr>
                    <th></th>
                    <th colspan="14">CASH CREDIT</th>
                   </tr>
                      <?php 
                      $yy = $year;
                          $sum = 0 ;  $x=1;
                          $i = 11; $mtotal=0;
                        while($i<=20){   
                            $e = $i++; $title = $fin->walletRemark($e);
                          if(!empty($title)){ $y=$x++; ?>
                  <tr>
                      <td><?php  echo $y ?></td>
                      <td><?php  echo ucwords($title) ?></td>
                      <?php 
                         $a=1; $ytotal=0; 
                        while($a<=12){
                      $b=$a++; 
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                      $bgc = $tr==$bx.$e ? ' style="background-color: yellow"' : ''; ?> 
                      <?php  $ytotal += $fin->monthlyExp2($e,$bx); echo '<td'.$bgc.'><a href="?trid='.
                      rand(1000000000,9999999999).$bx.$e.'">'.number_format($fin->monthlyExp2($e,$bx)).'</a></td>';  }
                      $bgc = $ty==$bx.$e ? ' style="background-color: yellow"' : ''; ?>
                      <?php  echo '<td'.$bgc.'><a href="?tnid='.rand(1000000000,9999999999).$bx.$e.'">'
                      .number_format($ytotal).'</a></td>' ?>
                  </tr>
                  <?php }  } ?>
                  <tr>
                      <th></th><th colspan="1">TOTAL CREDIT</th>
                          <?php $a=1; $sum=0; while($a<=12){$b=$a++;
                          $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                          $bgc = ($tm==$bx AND $tz==20) ? ' style="background-color: yellow"' : '';
                          $sum += $fin->yearlyExp2($bx);  echo '<th'.$bgc.'><a href="?tmid='.rand(1000000000,9999999999).$bx.$e.'">
                          '.number_format($fin->yearlyExp2($bx)).'</th>'; } ?>
                      <th ><?php  echo number_format($sum) ?></th>
                  </tr>
                  
                  <tr>
                    <th></th>
                    <th colspan="14">CASH DEBIT</th>
                  </tr>
                  <?php $sum = 0 ; 
                      $i = 1; $mtotal=0;  $x=1;
                  while($i<=10){   $e = $i++; $title = $fin->walletRemark($e);
                      if(!empty($title)){ $y=$x++;
                      ?>
                  <tr>
                      <td><?php echo $y ?></td>
                      <td><?php echo ucwords($title) ?></td>
                      <?php $a=1; $ytotal=0; while($a<=12){$b=$a++; 
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                      $bgc = $tr==$bx.$e ? ' style="background-color: yellow"' : ''; 
                      $ytotal += $fin->monthlyExp2($e,$bx); echo '<td'.$bgc.'><a href="?trid='.rand(1000000000,9999999999).$bx.$e.'">'
                      .number_format($fin->monthlyExp2($e,$bx)).'</a></td>';  }                           
                      $bgc = $ty==$bx.$e ? ' style="background-color: yellow"' : ''; ?>
                      <?php  echo '<td'.$bgc.'><a href="?tnid='.rand(1000000000,9999999999).$bx.$e.'">'.number_format($ytotal).'</a></td>' ?>
                  </tr>
              <?php }  } ?>

               <tr>
                  <th></th>
                  <th colspan="1">TOTAL DEBIT</th>
                      <?php $a=1; $sum=0; while($a<=12){$b=$a++;
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; 
                      $bgc = ($tm==$bx AND $tz==10) ? ' style="background-color: yellow"' : '';
                      $sum += $fin->yearlyExp1($bx);  echo '<th'.$bgc.'><a href="?tmid='.rand(1000000000,9999999999).$bx.$e.'">'
                      .number_format($fin->yearlyExp1($bx)).'</th>'; } ?>
                  <th ><?php  echo number_format($sum) ?></th>
              </tr>
              
               <tr>
                  <th></th>
                  <th colspan="14"></th>
               </tr>
               <tr>
                  <th></th>
                  <th colspan="1">PROFIT/LOSS</th>
                      <?php $a=1; $sum=0;
                       while($a<=12){
                          $b=$a++; 
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b;
                      $to = $fin->yearlyExp2($bx)-$fin->yearlyExp1($bx);
                      $bg = $to<0 ? ' style="background-color: red; color: white"' :'style="background-color: green; color: white"';
                      ?> <th <?php echo $bg ?> ><?php $sum += $to;  echo number_format($to) ?></th> <?php }  

                      $bg = $sum<0 ? ' style="background-color: red; color: white"' :'style="background-color: green; color: white"';  ?>
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
            <h3 class="card-title"><?php $title = $type>10 ? ' Operational Credit' : ' Operational Debit';
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
                  <th>Remark</th>
                  <th>Processed By</th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  $sum=0; 
                  $e=0;
                  foreach($sql2 as $s){
                    if($s->yy.$s->mm ==$mm && $s->type == $type){
                    $e += 1;
                    $sum += $s->cos; 
                    $rem = $s->type==1 ? $s->remark : $fin->walletRemark($s->type);?>
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


    <?php if(isset($_GET['tmid'])){ 
        $tmid = $_GET['tmid']; $type=substr($tmid,16,2); $mm = substr($tmid,12,4); 
        $tm=substr($tmid,10,8);  ?>
 <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php $title = $type>10 ? ' Operational Credit' : ' Operational Debit';
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
                  if($type>10){
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
                  <?php }else{ 
                   foreach($sql4 as $s){
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
                  <?php } } }?>
                  <tr><th colspan="3">Total Debit</td><td>₦<?php echo number_format(abs($sum),2) ?></td><th colspan="4"></td></tr>                                                 
              </tbody>              
              </table>
        </div>
    </div>
    </div>  



<?php } ?>


<?php if(isset($_GET['tnid'])){ 
    $tnid = $_GET['tnid']; $type=substr($tnid,16,2); $yy = substr($tnid,12,2); 
    $tn=substr($tnid,10,8);  ?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php $title = $type>10 ? ' Operational Credit' : ' Operational Debit';
                echo '20'.$yy.' '.$title; ?>: <?php echo $fin->walletRemark($type);  ?></h3>
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
                   foreach($sql2 as $s){
                    if($s->yy ==$yy AND $s->type==$type){
                    $e += 1;
                    $sum += $s->cos; 
                    $rem = $s->type ==1 ? $s->remark : $fin->walletRemark($s->type); ?>
                  <tr>
                    <td><?php echo $e ?></td>
                    <td><?php echo $s->trno ?></td>
                    <td><?php echo $fin->uName($s->userid) ?></td>
                    <td>₦<?php echo number_format(abs($s->cos),2) ?></td>
                    <td><?php echo date('jS M, Y',$s->ctime) ?></td>
                    <td><?php echo $rem ?></td>
                    <td><?php echo $fin->uName($s->rep) ?></td>
                  </tr>
                  <?php  } }?>

                  <tr><th colspan="3">Total Debit</td><td>₦<?php echo number_format(abs($sum),2) ?></td><th colspan="4"></td></tr> 
                                                
              </tbody>
              
              </table>
        </div>
    </div>
    </div>  




    <?php } ?>






    </div>





@endsection