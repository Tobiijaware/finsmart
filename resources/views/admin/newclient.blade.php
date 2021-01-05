@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Clients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">Add New Clients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Register New User</h3>
        </div>
        <div class="card-body">
          <form id="form" class="form" method="post" action="{{ route('AddnewUser') }}">
            @csrf
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Basic Information</h3>
       
         
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Surname</label>
                      <input type="text" name="surname" class="form-control" placeholder="Enter Surname" id="surname">
                     
                      {{-- <small><p>Error Message</p></small> --}}
                      
                       
                    </div>
                    </div>
                   <div class="col-md-6">
                   <div class="form-group">
                      <label>Other Names</label>
                      <input type="text" id="othername" name="othername" class="form-control" placeholder="Enter Other Names" required>
                      {{-- <small><p>Error Message</p></small> --}}
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                   
                       <label>Date of Birth:</label>
      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" id="dateofbirth" name="birthday"  class="form-control pull-right"
                          placeholder="Enter Birthday" required>
                         <small></small>
                      </div>
                       
                    </div>
                    </div>
                   <div class="col-md-6">
                   <div class="form-group">
                      <label>Gender</label>
                      <select id="sex" name="sex" class="form-control select2" required>
                      <option>Male</option><option>Female</option>
                      </select>
                       
                    </div>
                  </div>
                  
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
             
            </div>
            <!-- /.box -->
            
            
             <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Contact Information</h3>
      
               
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                       
                    </div>
                    </div>
                   <div class="col-md-6">
                   <div class="form-group">
                      <label>Additional Phone Number</label>
                      <input type="text" id="phone2" name="phone2" class="form-control" placeholder="Enter Second Phone Number" required>
                       
                    </div>
                  </div>
                  
                              <div class="col-md-6">
                   <div class="form-group">
                      <label>Residential Address</label>
                      <input type="text" id="address" name="address" class="form-control" placeholder="Enter Residential Address" required>
                       
                    </div>
                  </div>
                   <div class="col-md-6">
                   <div class="form-group">
                       <label>State of Residence</label>
  
                              <select id="state" class="form-control select2"  name="state" required>
                                  <option value="">Select state...</option>
                                      <option>Abia</option><option>
                                          Adamawa</option><option>
                                          Akwa-Ibom</option><option>
                                          Anambra</option><option>
                                          Bauchi</option><option>
                                          Bayelsa</option><option>
                                          Benue</option><option>
                                          Borno</option><option>
                                          Cross River</option><option>
                                          Delta</option><option>
                                          Ebonyi</option><option>
                                          Edo</option><option>
                                          Ekiti</option><option>
                                          Enugu</option><option>
                                          FCT</option><option>
                                          Gombe</option><option>
                                          Imo</option><option>
                                          Jigawa</option><option>
                                          Kaduna</option><option>
                                          Kano</option><option>
                                          Katsina</option><option>
                                          Kebbi</option><option>
                                          Kogi</option><option>
                                          Kwara</option><option>
                                          Lagos</option><option>
                                          Nasarawa</option><option>
                                          Niger</option><option>
                                          Ogun</option><option>
                                          Ondo</option><option>
                                          Osun</option><option>
                                          Oyo</option><option>
                                          Plateau</option><option>
                                          Rivers</option><option>
                                          Sokoto</option><option>
                                          Taraba</option><option>
                                          Yobe</option><option>
                                          Zamfara</option><option>
                                          Outside Nigeria</option>
                              </select>
                       
                    </div>
                  </div>
                  
                                          <div class="col-md-6">
                   <div class="form-group">
                      <label>City</label>
                      <input type="text" id="city" name="city" class="form-control" placeholder="Enter City of Residence" required>
                       
                    </div>
                  </div>
                   <div class="col-md-6">
                   <div class="form-group">
                       <label>Office Address</label>
                      <input type="text" id="address2" name="address2" class="form-control" placeholder="Enter Office Address" required>
                       
                    </div>
                  </div>
                  
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
              
            </div>
            <!-- /.box -->
            
                  
             <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">User Login Information</h3>
      
                
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter E-mail" >
                       
                    </div>
                    </div>
                   <div class="col-md-6">
                   <div class="form-group">
                      <label>Password</label>
                      <input type="password" id="password" 
                        name="password" class="form-control input-field" placeholder="Enter Password" >
                         {{-- <i class="fa fa-eye" id="eye" onclick="toggle()"></i> --}}
                      
                    </div>
                    
                  </div>
                  {{-- <div class="col-md-4">
                    <div class="form-group">
                       <label>BVN</label>
                       <input type="password" id="password" 
                         name="password" class="form-control input-field" placeholder="Enter Password" >
                          {{-- <i class="fa fa-eye" id="eye" onclick="toggle()"></i> --}}
                       
                     {{-- </div> --}}
                     
                   {{-- </div> --}} 
                  
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
  
              
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-outline-primary btn-md" style="float:right" name="RegisterUser" >Register New Client</button> 
              </div>
            </div>
            <!-- /.box -->
      </form>
          
        </div>
    </div>
    </div>  
    </div>


@endsection