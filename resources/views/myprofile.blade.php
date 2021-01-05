@extends('layouts.sapp')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css?family=Lato:400,400i,700");

    bodyy{
        display:flex;
        justify-content:center;
        flex-direction:column;
    }



    .gallery{
        position:relative;
        display:flex;
        grid-template-columns:repeat(6,50px);
        grid-template-rows:repeat(5,50px);
    }

    .item{
        margin:0.2em;
    }

    .small:hover{
        opacity:0.5;
    }

    .item img{
        height:50%;
        width:50%;
        object-fit:cover;
    }

    .feature{
        grid-row: 1 / span 4;
        grid-column: 1 / span 6;
        position:relative;
    }








    /* put text alongside gallery for large screens */

    @media screen and (min-width:1000px){
        bodyy{
            flex-direction:row;
        }


    }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=".">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header">
              <h3 class="card-title">My Profile</h3>
          </div>
          <div class="card-body">
            <div>
              <p class="text-center"><img class="profile-user-img img-responsive img-circle
                " src="/storage/storage/{{Auth::user()->photo}}" alt="User profile picture"></p>
              <h3 class="profile-username text-center">{{ $user->surname.' '.$user->othername}}</h3>
              <p class="text-muted text-center">{{ $user->email}}</p>
            </div>
            <div class="">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                <b>Account Balance</b> <a class="pull-right"><b>₦{{ number_format($amt,2)}}</b></a>
                </li>
                <li class="list-group-item">
                <b>Active Investment</b> <a class="pull-right"><b>₦{{ number_format($activeinvest,2)}}</b></a>
                </li>
                <li class="list-group-item">
                  <b>Active Savings</b> <a class="pull-right"><b>₦{{ number_format($saving,2)}}</b></a>
                </li>
                <li class="list-group-item">
                <b>Active Loans</b> <a class="pull-right"><b>₦{{ number_format($loan,2)}}</b></a>
                </li>
              </ul>
              <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
               data-target="#modal-updatePhoto">Update Photo</button>
            </div>
          </div>
      </div>
      </div>



      <div class="col-8">
        <div class="card">
          <div class="nav-tabs-custom card-header">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile Data</a></li>
              <li><a href="#settings" data-toggle="tab">Update Profile</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
              <div class="post">
                  <!-- /.user-block -->
                <h4>Client's Profile Information</h4>
                <table class="table table-sm" style="font-size: 14px!important;">
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
                  <tr><th>Bank</th><td>{{$user->bank}}</td></tr>
                  <tr><th>Account Number</th><td>{{$user->accountno}}</td></tr>
                  <tr><th>Bank Verification Number</th><td>{{$user->bvn}}</td></tr>
                </table>
              </div>
            </div>

            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
               <div class="timeline-body">
               </div>
            </div>



            <div class="tab-pane" id="settings">
              <button type="button" class="btn btn-outline-primary" style="float:right" data-toggle="modal" data-target="#modal-changep">Change Password</button>
              <h4 class="timeline-header"><a href="#"><br><br>User Guarantors</a> </h4>
            <table  class="table  table-striped">
            <thead>
              <tr><th>Guarantor's Name</th><th>Phone Number</th><th>Email</th><th>Relationship</th>
              </tr>

            </thead>
              <tbody>
              <?php foreach($guarantor as $key){ ?>
              <tr><th><?php echo $key->name; ?></th><th><?php echo $key->phone; ?></th><th><?php echo $key->email; ?></th><th><?php echo $key->note; ?></th></tr>
              <?php } ?>
              </tbody>
            </table>
            <form method="post" action="{{route('guarantor')}}">
             @csrf
           <div class="row">
             <div class="col-md-3"> <label>Guarantor's Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Full Name"></div>
             <div class="col-md-3"><label>Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required>
              </div>
             <div class="col-md-3"><label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
              </div>
             <div class="col-md-3"><label>Relationship</label>
                <textarea  name="note" class="form-control" placeholder="Relationship with Guarantor" required></textarea>
              </div>
             <div class="col-md-3"><button type="submit" name="AddGuarantor2" class="btn btn-outline-primary">Add Guarantor</button></div>
           </div>
          </form>


          <br><br>

                <div class="bodyy" style="overflow-y: auto;">
                <?php foreach($document as $key){ ?>
                    <div class="gallery" style="overflow-y: auto;">

                        <div class="item feature" id="scroll">
                            <img data-key='1' src='/storage/storage/{{$key->doc}}' alt='' />
                        </div>

      </div>
                    <?php } ?>
                </div>



                  <button type="button" class="btn btn-outline-primary mr-3" style="float:right" data-toggle="modal" data-target="#modal-uploadoc">Update Document</button>

                  <button type="button" class="btn btn-outline-primary ml-2" style="float:right" data-toggle="modal" data-target="#modal-bank">Update Bank Information</button>


                  <br><br>


            <!-- /.tab-pane -->
          </div>

            </div>
          </div>
       </div>
       </div>
    </div>
  </div>




  <div class="modal fade" id="modal-updatePhoto">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="{{route('store')}}">
          @csrf
          @method('PUT')
        <div class="text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
          <h4 class="modal-title">Upload Passport Photograph</h4>
        </div>
        <div class="modal-body">
          <p><input type="file" name="image"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="updatePhoto2" class="btn btn-outline-primary">Upload Photograph</button>
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade" id="modal-uploadoc">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="{{route('storeDoc')}}">
          @csrf
          @method('PUT')
        <div class="text-center">
          <h4 class="modal-title">Upload Document</h4>
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
          <p><label>Document File <small><i>Acceptable file formats are jpg, png</i></small></label>
            <input type="file" name="image" class="form-control" required> <br>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="UploadDoc2" class="btn btn-outline-primary">Upload Document</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->





  <div class="modal fade" id="modal-changep">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="{{route('password', Auth::user()->userid)}}">
          @csrf
          @method('PUT')
        <div class="text-center">
          <h4 class="modal-title">Change Password</h4>
        </div>
        <div class="modal-body">
         <p> <label>Current Password</label>
            <input type="password" name="currentpass" class="form-control" placeholder="Enter Current Password" required>
          </p>
         <p> <label>New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>
          </p>
         <p> <label>Re-type New Password</label>
            <input type="password" name="password2" class="form-control" placeholder="Re-type New Password" required>
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" name="changePassword" class="btn btn-outline-primary">Change Password</button>
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal-->


  <div class="modal fade" id="modal-bank">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form" method="post" enctype="multipart/form-data" action="{{route('update', Auth::user()->userid)}}">
          @csrf
        <div class="text-center">
          <h4 class="modal-title">Update Bank Information</h4>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <div class="modal-body">
         <p> <label>Bank </label>
           <input type="text" name="bank" value="{{Auth::user()->bank}}" class="form-control" placeholder="Enter Bank Name" required>

          </p>
         <p> <label>Account Number</label>
            <input type="text" name="accno" value="{{Auth::user()->accountno}}" class="form-control" placeholder="Enter Account Number" required>
          </p>
         <p> <label>BVN</label>
            <input id="bvn" type="number" max="10" min="10" name="bvn" value="{{Auth::user()->bvn}}" class="form-control" placeholder="Enter BVN" required>
          </p>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button id="bvnsubmit" type="submit" class="btn btn-outline-primary">Update Bank Information</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</section>


<script>
  let form = document.getElementById('bvnsubmit');
  form.addEventListener('click', function(event){
    event.preventDefault();
    if (checkBvn()){
     let f =  document.getElementById('form');
     f.submit();
    }
  });

function checkBvn(){
  let Bvn = document.getElementById('bvn');
  let bvnLength = Bvn.value;
  if(bvnLength.length != 10){
    alert('BVN should be ten digits');
    return false;
  }
  return true;
}
</script>
@endsection
