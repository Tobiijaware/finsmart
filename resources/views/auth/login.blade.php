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
  <div class="login-box">
    <div class="login-logo">
      <a><img src='/storage/storage/livepetal.png' class="pr-1" width="13%"><b>FINSMART</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in Here</p>

          @include('inc.message')
          <form method="POST" action="{{ route('loginAdmin') }}">
            @csrf
          <div class="input-group mb-3">
            <input name="email" type="email" class="form-control" placeholder="Email">
            
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span>
                  <i class="fa fa-eye" id="eye" onclick="toggle()">
                  </i>
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="block mt-4" style="float:left">
                  <label class="flex items-center">
                      <input type="checkbox" class="form-checkbox" name="remember">
                      <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                  </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-outline-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          {{-- @if (Route::has('password.request'))
              <a class="text-center" href="{{ route('password.request') }}">
                  {{ __('Forgot your password?') }}
              </a>
          @endif --}}
          <a href="javascript(void)" data-toggle="modal" data-target="#myModal">
            Forgot your password
          </a>
        </p>
        <p class="mb-0" style="float:right">
          {{-- @if (Route::has('register')) --}}
              <a class="text-center" href="{{ route('register') }}">
                  {{ __('Register New') }}
              </a>
          {{-- @endif --}}
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">FORGOT PASSWORD?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
        <form id="formfor" method="post" action="/forgotpassword">
          @csrf
         <label>Email</label>
         <input type="email" id="forpass" name="email" class="form-control" placeholder="Enter Your Email" />
         <p id="show" class="text-danger"></p>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="btn-for" type="submit" class="btn btn-outline-primary">Reset</button>
        </div>
      </form>
  
      </div>
    </div>
  </div>

<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  let state= false;
    function toggle(){
        if(state){
      document.getElementById("password").setAttribute("type","password");
      document.getElementById("eye").style.color='#7a797e';
      state = false;
        }
        else{
      document.getElementById("password").setAttribute("type","text");
      document.getElementById("eye").style.color='#5887ef';
      state = true;
        }
    }
</script>
<script>
  $(document).ready(function(){
      $( ".alert-success" ).fadeIn(400 ).delay( 2000 ).fadeOut(400);
  });
  $(document).ready(function(){
      $( ".alert-danger" ).fadeIn( 300 ).delay( 1000 ).fadeOut(400);        
  });  



</script>
<script>
  let btn = document.getElementById('btn-for');
  btn.addEventListener('click', function(e){
    e.preventDefault();
    checkMail();

  });
  function checkMail(){
    let formfor = document.getElementById('formfor');
    let emailfor = document.getElementById('forpass');
    let email = emailfor.value;
    if (email==''){
      return document.getElementById("show").innerHTML = "Please input an email";
    } else {
      formfor.submit();
    }
  }

</script>
</body>
</html>
