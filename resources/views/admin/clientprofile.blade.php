@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=".">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    <div class="col-lg-4 col-md-4">
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title"></h3>
        </div> --}}
        <div class="card-body">
            
                @foreach($data as $user)  
                <div class="text-center">
                    <img class="profile-user-img img-responsive img-circle" src="/storage/storage/{{$user->photo}}" alt="User profile picture">
                </div>
              
    
                  <h3 class="profile-username text-center">{{ $user->surname.' '.$user->othername}}</h3>
                @endforeach
                  <p class="text-muted text-center"></p>
    
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                    <b>Account Balance</b> <a class="pull-right">₦{{ number_format($amt,2)}}</a>
                    </li>
                    <li class="list-group-item">
                    <b>Active Investment</b> <a class="pull-right">₦{{ number_format($activeinvest,2)}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Active Savings</b> <a class="pull-right">₦{{ number_format($saving,2)}}</a>
                    </li>
                    <li class="list-group-item">
                    <b>Active Loans</b> <a class="pull-right">₦{{ number_format($loan,2)}}</a>
                    </li>
                  </ul>
    
                  <hr>
                  
          <form method="post" action="/deleteclient">
            @csrf
                    <div class="col-md-6" style="margin: 0; padding: 0">
                      <?php if(!checktransaction($user->userid)) {?>          
                <input type="password" name="password" class="form-control" required placeholder="Authenticate">
                      <?php } ?>
                    </div>
                           
          <div class="col-md-6"  style="margin-bottom: 5px!important; padding: 0">
               <?php if(!checktransaction($user->userid)) {?>
                    <button type="submit" value="{{$user->userid}}" name="DeleteClient" class="btn btn-outline-danger btn-block"> DELETE CLIENT</button>
                    <?php }  ?>   
                  </div>
                    
          </form> 
          
            <div class="col-md-12"  style="margin: 0; padding: 0">
              <br>
              <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-transac">CLEAR ALL TRANSACTIONS</button>
         </div>
       
         
     
                  
               
              
        </div>
    </div>
    </div>  







    <div class="col-lg-8 col-md-8">
      <div class="card">
        <div class="nav-tabs-custom card-header">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Profile Data</a></li>
            <li><a href="#timeline" data-toggle="tab">Transactions</a></li>
            <li><a href="#settings" data-toggle="tab">Update Profile</a></li>
            <li><a href="#sms" data-toggle="tab">SMS & Emails</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
            <div class="post">
                <!-- /.user-block -->
                <h4>Client's Profile Information</h4>
                @foreach($data as $user)  
                  <table class="table">
                  <tr><th>Surname</th><td>{{$user->surname}}</td></tr>   
                  <tr><th>Other Names</th><td>{{$user->othername}}</td></tr>
                  <tr><th>Date of Birth</th><td>{{$user->birthday}}</td></tr>   
                  <tr><th>Gender</th><td>{{$user->sex}}</td></tr>
                  <tr><th>Primary Phone Number</th><td>{{$user->phone}}</td></tr>
                  <tr><th>Alternate Phone Number</th><td>{{$user->phone2}}</td></tr>
                  <tr><th>Residential Address</th><td>{{$user->address}}</td></tr>
                  <tr><th>State</th><td>{{$user->state}}</td></tr>
                  <tr><th>City</th><td>{{$user->city}}</td></tr>
                  <tr><th>Office  Address</th><td>{{$user->address2}}</td></tr>
                  <tr><th>Banker</th><td>{{$user->bank}}</td></tr>
                  <tr><th>Account Number</th><td>{{$user->accountno}}</td></tr>
                    <tr><th>Bank Verification Number</th><td></td></tr>
                  </table>
                @endforeach 
                 {{-- <form method="post">
                      <button type="submit" class="btn btn-primary" value="'.$fid.'" name="ResolveAccountNo">Verify Account Number</button>
      
                      <button type="submit" class="btn btn-info" value="'.$fid.'" name="ResolveBankVN">Verify BVN</button>
                    </form> --}}
            </div>
          </div>

          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
           

              
                 

                 

                  <div class="timeline-body table-responsive">
                
      <h4 class="timeline-header"><a href="#">Loan History</a></h4>
        
          <table  class="table  table-striped">
            <thead>
            <tr>
              <th>Date </th>
              <th>Loan </th> 
              <th>Interest</th>
              <th>Repayment</th>
              <th>Tenure</th>
              <th>Monthly Tranch</th>
              <th>Cash Paid</th>
              <th>Status </th>
              <th>Action </th>
            </tr>
            </thead>
            <tbody>
              @foreach($loandata as $loan)
              <td>{{date('jS M, Y',strtotime($loan->created_at))}}</td>
              <td>{{number_format($loan->amount,2)}}</td>
              <td>{{number_format($loan->interest,2)}}</td>
              <td>{{number_format($loan->amount+$loan->interest,2)}}</td>
              <td>{{$loan->tenure}}  Days</td>
              <td>{{number_format($loan->tranch,2)}}</td>
              <td>{{number_format($walletLoan,2)}}</td> 
              <td><?php echo $status ?></td> 
              <form method="post" action="/ViewUserLoan">
              @csrf
               <td><button class="btn btn-outline-primary btn-xs" name="ManageLoan" value="{{$loan->ref}}">Manage</button></td>
              </form>
            </tr> 
              @endforeach
            </tbody>
          </table>
          
        </div>


                 

                  <div class="timeline-body table-responsive">
   
      <h4 class="timeline-header"><a href="#">Investment History</a> </h4>
      <form method="post">
          <table  class="table  table-striped">
            <thead>
            <tr>
               <th>Date</th>
              <th>Loan </th> 
              <th>Interest</th>
              <th>Repayment</th>
              <th>Tenure</th>
              <th>Status </th>
              <th>Action </th>
            </tr>
            </thead>
            <tbody>
              @foreach($investdata as $invest)
              <tr>
              <td>{{date('jS M, Y',strtotime($invest->created_at))}}</td>
              <td>{{number_format($invest->amount,2)}}</td>
              <td>{{number_format($invest->interest,2)}}</td>
              <td>{{number_format($invest->amount+$invest->interest,2)}}</td>
              <td>{{$invest->tenure}} Days</td>
              <td><?php echo $istat ?></td>
              <td>
                <form method="post" action="/ViewUserInv">
                  @csrf
                <button class="btn btn-outline-primary btn-xs" name="ManageInv" value="{{$invest->ref}}">Manage</button>
                </form>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </form>
                
                </div>        
      <div class="timeline-body table-responsive">
       <h4 class="timeline-header"><a href="#">Savings History</a> </h4>
          <table  class="table  table-striped">
            <thead>
            <tr>
              <th>Date</th>
              <th>Periodic Amount</th>
              <th>Monthly Rate</th>
              <th>Savings Cycle</th>
              <th>Activation Date</th>
              <th>Total Deposit</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($savings as $saving)
              <tr>
                <?php $active = date('jS M, Y',strtotime($saving->created_at));?>
                  <td>{{$active}}</td>
                  <td>{{number_format($saving->amount,2)}}</td>
                  <td>{{number_format($saving->rate)}}%</td>
                  <td>{{$saving->period}} Days</td>
                  <td>{{$active}}</td>
                  <td>{{number_format($swallet,2)}}</td>
                  <td><?php echo $sstat ?></td>
                  <form action="/ViewSavingsDetails" method="POST">
                  @csrf
                  <td>
                    <button class="btn btn-outline-primary btn-xs" name="ManageSavings" value="<?php echo $saving->ref;?>">Manage</button>
                  </form>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>

    <div class="tab-pane" id="sms">
      <h4 class="timeline-header"><a href="#">Send SMS </a> </h4>
      <form method="post">
        <textarea class="form-control" name="sms" placeholder="Type sms here..."></textarea>
        <br>
        <button type="submit"  name="sendUserSms" class="btn btn-outline-success pull-right btn-block">Send SMS</button>
        </form>
        <br><br>
        <h4 class="timeline-header">Send Email</h4>
        <form method="post" action="/sendsinglemail">
          @csrf
        <input type="text" name="subject" class="form-control" placeholder="E-MAIL SUBJECT">
          <textarea class="form-control" rows="10" name="message" placeholder="Type E-mail message here..."></textarea>
          <br>
         
        <button type="submit" value="{{$user->userid}}"  name="sendUserEmail" class="btn btn-outline-success pull-right btn-block">Send E-mail</button>
          </form>
          <br><br>
    </div>












          <div class="tab-pane" id="settings">
            <?php //if(adminName($uid,'o5')==1){ ?>
            <form class="form-horizontal" method="post" action="/showuserfields">
              @csrf
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Profile Field</label>
                <div class="col-sm-10">
                  <?php 
                  $key = session()->has('updatekey') ? session()->get('updatekey') : ''?>
                  <select name="updateKey" class="form-control" onchange="submit()" required>
                    <option value="" disabled> Select Field...</option>
                    <option value="surname" <?php echo $key=='surname'?'selected':'' ?>>Surname</option>
                    <option value="othername" <?php echo $key=='othername'?'selected':'' ?>>Other Names</option>
                    <option value="email" <?php echo $key=='email'?'selected':'' ?>>Email</option>
                    <option value="phone" <?php echo $key=='phone'?'selected':'' ?>>Primary Phone Number</option>
                    <option value="phone2" <?php echo $key=='phone2'?'selected':'' ?>>Alternate Phone Number</option>
                    <option value="address" <?php echo $key=='address'?'selected':'' ?>>Residential Address</option>
                    <option value="address2" <?php echo $key=='address2'?'selected':'' ?>>Office Address</option>
                    <option value="state" <?php echo $key=='state'?'selected':'' ?>>State of Residence</option>
                    <option value="city" <?php echo $key=='city'?'selected':'' ?>> City of Residence</option>
                    <option value="birthday" <?php echo $key=='birthday'?'selected':'' ?>> Date of Birth</option>
                    <option value="sex" <?php echo $key=='sex'?'selected':'' ?>> Gender</option>
                    <option value="bank" <?php echo $key=='bank'?'selected':'' ?>> Banker</option>
                    <option value="accountno" <?php echo $key=='accountno'?'selected':'' ?>> Account Number</option>
                    <option value="bvn" <?php echo $key=='bvn'?'selected':'' ?>> Bank Verification Number</option>
                  </select> 
                </div>
              </div>
            <?php //} ?>
            </form>
            <?php //if(isset($_SESSION['updateKey'])){$key = $_SESSION['updateKey']; ?>
            <form class="form-horizontal" method="post" action="/updateclient">
              @csrf
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label"></label>

                <div class="col-sm-10">
                  
                 

                  {{-- <select class="form-control select2" name="fieldname"> --}}
          <?php// echo selectBank($res2['data'],$code);
          ?>
          {{-- </select> --}}
            <?php
            //}else{ ?>

                  <input type="text" value="{{session()->get('val') ?? ''}}" class="form-control" name="fieldname" placeholder="Profile Field">
                <?php// } ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-outline-primary btn-block" name="UpdateProfile">Update Profile</button>
                </div>
              </div>

            </form>
            <?php //}  ?>


             <h4 class="timeline-header"><a href="#"><br><br>User Documents</a> </h4>

          <table  class="table  table-striped">
          
            <tbody>
            <?php $i=1;
     foreach($doc as $key){ $e=$i++;?>
       <tr><td><?php echo $e.' '.$key->title.' - '.$key->note?><img src="storage/storage/{{$key->doc}}"></td></tr>
       <?php } ?>
            </tbody>

          </table>
           <button type="button" class="btn btn-outline-primary" style="float:right" data-toggle="modal" data-target="#modal-uploadoc">Upload Document</button>
           <br><br><br>
            <h4 class="timeline-header"><a href="#"><br><br>User Gurantors</a> </h4>
          <table  class="table  table-striped">
          <thead>
            <tr>
            <th>SN</th>  <th>Guarantor's Name</th><th>Phone Number</th><th>Email</th><th>Other Info</th>
            </tr>
          </thead>
            <tbody>
              <?php 
              $i=1;
                foreach($gua as $keys){$e = $i++;?>
                <tr>
                <th>{{$e}}</th><th>{{$keys->name}}</th><th>{{$keys->phone}}</th><th>{{$keys->email}}</th><th>{{$keys->note}}</th>
                </tr>
              <?php } ?>
            </tbody>
          </table>
    <button type="button" class="btn btn-outline-primary" style="float:right" data-toggle="modal" data-target="#modal-guarantor">Add New Guarantor</button>
    <br><br><br>
         <?php //} ?>
          </div>

          </div>
        </div>
     </div>
     </div>




















    </div>




   
      <div class="modal fade" id="modal-updatePhoto">
        <form method="post" enctype="multipart/form-data"> 
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title text-uppercase">Upload Client Photo</h4>
             </div>
             <div class="modal-body">
               <p><input type="file" name="image"> </p>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <button type="submit" name="updatePhoto" class="btn btn-outline-primary">Upload Photograph</button>
             </div>
           </div>
           <!-- /.modal-content -->
         </div>
        </form>
         <!-- /.modal-dialog -->
       </div>




    
      <div class="modal fade" id="modal-uploadoc">
        <div class="modal-dialog">
          <form method="post" enctype="multipart/form-data" action="{{route('adminstore')}}">
            @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-uppercase">Upload Document</h4>
            </div>
            <div class="modal-body">
             <p> <label>Document Type</label>
              <select name="title" class="form-control select2" required>
                <option value="">Select Option</option>
                <option>Bank Statement</option>
                <option>Utility Bill</option>
                <option>Identity Card</option>
                <option>Recommendation Letter</option>
                <option>Employment Letter</option>
                <option>Pre-signed Cheque</option>
                 <option>Others</option>
              </select></p>
              <p><label> Additional Note (Optional)</label>
                <input type="text" name="note" class="form-control" placeholder="Describe Document">
              </p>
              <p><label>Document File <small><i>Acceptable file formats are jpg, png & pdf</i></small></label> 
                <input type="file" name="image" class="form-control" required> <br>
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" value="{{$user->userid}}" name="UploadDoc" class="btn btn-outline-primary">Upload Document</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
      </form>
        <!-- /.modal-dialog -->
      </div>
   






     
       <div class="modal fade" id="modal-guarantor">
        <form method="post" enctype="multipart/form-data" action="/adminGuarantor"> 
          @csrf
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-uppercase">Add New Guarantor</h4>
              </div>
              <div class="modal-body">
               <p> <label>Guarantor's Full Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Full Name">
                </p>
               <p> <label>Phone Number</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                </p>
               <p> <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email">
                </p>
               <p> <label>Other Information</label>
                  <textarea  name="note" class="form-control" placeholder="Enter Other Information"></textarea></p>
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" value="{{$user->userid}}" name="AddGuarantor" class="btn btn-outline-primary">Add New Guarantor</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
          <!-- /.modal-dialog -->
        </div>



        <div class="modal fade" id="modal-transac">
          <form method="post" enctype="multipart/form-data" action="/clearalltransac"> 
            @csrf
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-uppercase">ARE YOU SURE??</h4>
                </div>
                <div class="modal-body">
                 <p> <label>Authenticate</label>
                    <input type="password" name="password" class="form-control" placeholder="TYPE IN YOUR PASSWORD">
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" value="{{$user->userid}}" name="cleartransact" class="btn btn-outline-danger">CLEAR</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </form>
            <!-- /.modal-dialog -->
          </div>
       
        <!-- /.modal -->
@endsection