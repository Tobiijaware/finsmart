@extends('layouts.app')
@section('content')
@php
use App\Http\Controllers\Controller;
$fin = new Controller;
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Expenses </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Manage Expenses</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title" style="margin-bottom: 7px!important;"><?php echo $year ?? ''; ?> EXPENSES</h3>
      <form method="post" action="/fetchyear">
        @csrf
          <select name="year" class="form-control" onchange="submit()">
            <option value="">SELECT YEAR...</option>
            <option><?php echo date('Y')-1 ?></option>
            <option><?php echo date('Y') ?></option>
            <option><?php echo date('Y')+1 ?></option>
          </select>
        </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table color-bordered-table purple-bordered-table">
            <thead>
              <tr>
                <th>S/N</th>
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
              <?php
              $yy = $year;
              $sum = 0 ;
              $i = 0;
              foreach($sql as $count){
              $mtotal=0; 
              $cat = $count->sn ?>
                <tr>
                  <td><?php echo $catt[$i];$i++; ?></td>
                  <td><?php echo $fin->catName($count->sn) ?></td>
                  <?php 
                     $a=1; 
                     $ytotal=0;
                    while($a<=12){
                      $b=$a++; 
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; ?>                          
                    <td><?php  $ytotal += $fin->monthlyExp($cat,$bx);  
                               echo number_format($fin->monthlyExp($cat,$bx)); 
                        ?>
                    </td>
                    <?php } ?>
                    <th><?php  echo number_format($ytotal) ?></td>
                </tr>
                <?php } ?>
                <tr>
                  <th colspan="2">TOTAL</th>
                   <?php 
                   $a=1; 
                   $sum=0;
                    while($a<=12){
                      $b=$a++;
                      $bx = $b<10 ? $yy.'0'.$b : $yy.$b; ?> 
                  <th>
                    <?php $sum += $fin->yearlyExp($bx);  echo number_format($fin->yearlyExp($bx)) ?>
                  </th>
                    <?php } ?>
                  <th>
                    <?php  echo number_format($sum) ?>
                  </th>
              </tr>
           
          </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection