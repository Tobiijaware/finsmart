<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Finsmart</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
  @if($data->reset > 0 || time() < $data->time)
    <div class="login-box">
        <div class="login-logo">
          <a><img src='/storage/storage/livepetal.png' class="pr-1" width="13%"><b>FINSMART</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Reset Password Here</p>
    
              @include('inc.message')
              <form method="POST" action="/resetpass" id="formre">
                @csrf
              <div class="input-group mb-3">
                <input id="email" type="email" value="{{$data->email}}" class="form-control" placeholder="Email" disabled>
                <input name="email" id="email" type="hidden" value="{{$data->email}}">
                
                
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <span><p id="showemail" class="text-danger"></p></span>
             
              <div class="input-group mb-3">
                <input name="password" type="password" class="form-control" placeholder="Password" id="password">
               
                <div class="input-group-append">
                  <div class="input-group-text">
                    {{-- <span>
                      <i class="fa fa-eye" id="eye" onclick="toggle()">
                      </i>
                    </span> --}}
                   
                  </div>
                </div>
              </div>
              <span><p id="showpass" class="text-danger"></p></span>
             
              <div class="input-group mb-3">
                <input name="password1" type="password" class="form-control" placeholder="Password" id="password1">
               
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span>
                      <i class="fa fa-eye" id="eye" onclick="toggle()">
                      </i>
                    </span>
                  </div>
                </div>
              </div>
              <span><p id="showpass1" class="text-danger"></p></span>
              
              <div class="row">
                <div class="col-12">
                  <button id="btn-re" type="submit" class="btn btn-outline-primary btn-block">Reset</button>
                </div>
                
              </div>
            </form>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>

@endif
<div class="hold-transition register-page">
<h4>PAGE EXPIRED!!!!!</h4>
</div>






<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function(){
        $( ".alert-success" ).fadeIn(400 ).delay( 2000 ).fadeOut(400);
    });
    $(document).ready(function(){
        $( ".alert-danger" ).fadeIn( 300 ).delay( 1000 ).fadeOut(400);        
    });    
</script>
<script>
  let state= false;
    function toggle(){
        if(state){
      document.getElementById("password").setAttribute("type","password");
      document.getElementById("password1").setAttribute("type","password");
      document.getElementById("eye").style.color='#7a797e';
      state = false;
        }
        else{
      document.getElementById("password").setAttribute("type","text");
      document.getElementById("password1").setAttribute("type","text");
      document.getElementById("eye").style.color='#5887ef';
      state = true;
        }
    }
</script>
<script>
  let button = document.getElementById('btn-re');
  button.addEventListener('click', function(e){
    e.preventDefault();
    checkInputs();

  });
  function checkInputs(){
    let form = document.getElementById('formre');
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let confirmpassword = document.getElementById('password1').value;

    if (email==''){
      return document.getElementById('showemail').innerHTML = "<i class='fas fa-exclamation-circle'></i>Email can't be empty";
    }else if(password==''){
      return document.getElementById('showpass').innerHTML = "<i class='fas fa-exclamation-circle'></i>Password can't be empty";
    }else if(confirmpassword==''){
      return document.getElementById('showpass1').innerHTML = "<i class='fas fa-exclamation-circle'></i>Confirm Password can't be empty";
    }else if(password != confirmpassword){
      return document.getElementById('showpass1').innerHTML = "<i class='fas fa-exclamation-circle'></i>Passwords must match";
    }else{
      form.submit();
    }
  }

 

</script>

</body>
</html>