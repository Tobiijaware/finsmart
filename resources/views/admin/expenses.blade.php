@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Expenses</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <?php $trno = session()->get('trno');
    if($trno){ ?>
    <div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Update Expense</h3>
            <span style="float: right">
                <form action="/expense" method="POST">
                   @csrf
                   <button class="btn btn-default btn-xs">Add New Expenses</button>
                </form>
              </span>
        </div>
        <div class="card-body">
            <form method="post" action="/Updatedetails">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @foreach($trno as $detail)
                  <label> Select Category</label>  
                  <select class="form-control select2" name="category" required>
                  
                   @foreach ($category as $category)
                   <option value="<?php echo $detail->ref ?>"><?php echo $detail->ref ?></option>
                          <option value="{{$category->sn}}">
                                      {{$category->category}}          
                          </option>
                   @endforeach
                  </select>               
                  <label>Expense Date</label>
                  <input type="text" name="date" value="<?php echo date('m/d/Y',$detail->ctime) ?>" class="form-control" required><br>
                  <label>Amount (NGN)</label>
                  <input type="number" name="amount" value="<?php echo abs($detail->cos) ?>" class="form-control" required><br>
                  <label>Transaction Description</label>
                  <textarea name="note" class="form-control" required><?php echo $detail->remark ?></textarea><br>
                  <button class="btn btn-primary btn-block">UPDATE EXPENSES</button>
                @endforeach
                </form>
        </div>
    </div>
    </div>  
<?php }else{ ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Expense</h3>
                <span style="float: right">
                    <button href="#" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#modal-addcat">Add Category</button>
                </span>
            </div>
            <div class="card-body">
                <form method="post" action="/addexpenses">
                    @csrf
                    <label> Select Category</label>             
                    <select class="form-control select2" name="category" required>
                    <option value="">Select Category...</option>
                     @foreach ($category as $category)
                            <option value="{{$category->sn}}">
                                        {{$category->category}}          
                            </option>
                     @endforeach
                    </select>
                    <label>Expense Date</label>
                    <input type="date" name="date" class="form-control" required><br>
                    <label>Amount (NGN)</label>
                    <input type="number" name="amount" class="form-control" required><br>
                    <label>Transaction Description</label>
                    <textarea name="note" class="form-control" required></textarea><br>
                    <button class="btn btn-primary btn-block" name="AddExpense">ADD NEW EXPENSES</button>
                  </form>
            </div>
        </div>
        </div>  
        <?php } ?>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <form method="post" action="/sessionexpense"> 
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
                        <button type="submit" class="btn btn-warning" name="getmonth"><i class="fa fa-search"></i> Search Expenses </button></td></tr></table>  </div>
                        </form>
                </div>
                <div class="card-body">
                    <table id="example1" class="table  table-striped">
                        <thead>
                        <tr>
                          <th>SN</th> 
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Category</th>
                          <th>Remark</th>
                          <th>Processed By</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            //$i=0;
                            $e=0;
                            $n=1;
                            $sum=0;
                            //$q=0;
                            foreach($datas as $key){
                             $sum += $key->cos; ?>
                          <tr>
                            <td>{{$n++}}</td>               
                            <td>{{date('jS M, Y',$key->ctime)}}</td>
                            <td>₦{{number_format(abs($key->cos),2)}}</td>
                            <td><?php echo $fin->catName($key->ref);?></td>  
                            <td><?php echo $key->remark;?></td>
                            <td><?php echo $rep[$e];$e++;?></td>
                            
                             <td>
                                <form action="/Details" method="POST">
                                    @csrf
                                 <button class="btn btn-outline-success btn-xs" name="Update" value="<?php echo $key->trno;?>">Update</button>
                                </form>
                            </td>
                          </tr>
                         
                          <?php } ?>                 
                      
                        </tbody>
                      </table>
                </div>
            </div>
            </div>  



</div>








     <div class="modal fade" id="modal-addcat">
       <div class="modal-dialog">
        <form method="post" action="/addcategory">
            @csrf
         <div class="modal-content">
           <div class="modal-header">
             <h4 class="modal-title text-uppercase">Add Expense Category </h4>
           </div>
           <div class="modal-body">                
           <label>Expense Category</label>
           <input type="text" name="category" class="form-control" placeholder="Enter Category" required>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-outline-primary">ADD CATEGORY</button>
           </div>
         </div>
        </form>
         <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
     </div>
     <!-- /.modal -->
   
@endsection