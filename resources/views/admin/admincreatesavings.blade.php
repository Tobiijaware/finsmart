@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Savings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Create New Savings Account</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Search Client</h3>
            <div style="float:right"> 
                <form method="POST" action="/searchsavings">
                    @csrf
                <table>
                  <tr><td><input type="search" name="q" class="form-control" placeholder="Enter Keyword" required></td>
                  <td><button type="submit" class="btn btn-outline-warning"><i class="fa fa-search"></i> Search Client </button></td>
                  </tr>
                </table>
                </form>
                </div>
        </div>
        <?php 
        $details = session()->get('details');
        if($details){
        ?>
        <div class="card-body">
            <table id="example4" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Surname</th>
                      <th>Other Names</th>
                      <th>E-mail</th>
                      <th>Phone No</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                 
                    @foreach($details as $user)
                    <tr>
                      <td>{{$user->surname}}</td>
                      <td>{{$user->othername}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->address}}</td>
                      <td>
                        <form method="post" action="/searchsavingsform"> 
                            @csrf
                          <button class="btn btn-outline-primary btn-xs" value="{{$user->userid}}" name="CreateNew">Create New</button>
                        </form>
                    </td>
                    </tr>  
                      @endforeach           
                    </tbody>
            </table>
        </div>
    <?php } ?>
    </div>
    </div>  
    </div>
    @if(count($data) > 0)
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Clients</h3>
                <div style="float:right">
                    <form method="post" action="/viewclientdetails">
                      @csrf
                      <input name="viewclientprofile" type="hidden" value="{{$user->userid}}">
                      <button type="submit" class="btn btn-sm btn-outline-success">Profile</button>
                    </form> 
                   </div>
            </div>
            <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Surname</th>
                            <th>Other Names</th>
                            <th>Phone No</th>
                            <th>Address</th>          
                          </tr>
                    
                    </thead>
                    @foreach($data as $info)
                    <tbody>
                       
                        <tr>
                            <td>{{$info->surname}}</td>
                            <td>{{$info->othername}}</td>
                            <td>{{$info->phone}}</td>
                            <td>{{$info->address}}</td>         
                          </tr> 
                         
                    </tbody>
                    @endforeach 
                    
                  </table>
              
            </div>
        </div>
        </div>  
    </div>
    <div>
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Client Savings History</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Periodic Amount</th> 
                            {{-- <th>Savings Cycle</th> --}}
                            <th>Application Date</th>
                            <th>Activation Date</th>
                            <th>Status </th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?$savings ='';?>
                     
                            @foreach($savings as $dat)
                            <tr>
                              <td>₦{{number_format($dat->amount,2)}}</td>
                            {{-- <td>{{$dat->period}} Days</td> --}}
                            <td>{{date('jS M Y',strtotime($dat->created_at))}}</td>
                            <td>{{(strtotime($dat->start))}}</td>
                            <td><?php echo $status ?></td>        
                             <td>
                                <form method="post" action="{{ route('ViewUserSavings') }}"> 
                                    @csrf
                                 <button class="btn btn-primary btn-xs" name="Managesavings" value="{{$dat->ref}}">Manage</button>
                                </form>
                                </td>
                          </tr> 
                          @endforeach                 
                          </tbody>   
                  </table>
            </div>
        </div>
        </div>  
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Savings Application</h3>
            </div>
            <div class="card-body display_form">
                <form method="post" enctype="multipart/form-data" action="/submitsavings">
                    @csrf
                    <div class="row">

                    
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>Savings Type</label>
                                <select name="productkey" class="form-control" required >
                                  <option value="" disabled selected> Select Option...</option>
                                      @foreach($products as $product)
                                  <option  value="{{$product->id}}">{{$product->product}}</option>
                                      @endforeach
                                </select>
                            </div>
                          </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Savings Amount</label>
                            <input type="number" name="amount" id="Text1" class="form-control" placeholder="Enter savings Amount" required >
                          </div>
                      </div> 
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Interest Rate (%)</label>
                            <input type="text" name="rate" id="Text2" class="form-control" value=""  placeholder="Interest Rate" required>                    
                          </div>
                      </div>    
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Savings Tenure</label>
                              <select name="tenure" class="form-control select2" id="Text3" onchange="add_number()" required>
                              <option value="">Select Tenure...</option>
                              <option value="1">1 Day</option>
                              <option value="30">30 Days</option>
                              <option value="60">60 Days</option>
                              <option value="90">90 Days</option>
                              <option value="120">120 Days</option>
                              <option value="150">150 Days</option>
                              <option value="180">180 Days</option>
                              <option value="210">210 Days</option>
                              <option value="240">240 Days</option>
                              <option value="270">270 Days</option>
                              <option value="300">300 Days</option>
                              <option value="330">330 Days</option>
                              <option value="360">360 Days</option>
                              </select>                       
                          </div>
                      </div>
                      <div class="col-md-9"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="btn btn-outline-primary btn-block">Create Savings
                          </button>
                        </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
        </div>  
    
    @endif

@endsection