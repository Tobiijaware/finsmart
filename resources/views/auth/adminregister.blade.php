<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FINSMART</title>
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
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Admin Register Here</p>
                @include('inc.message')
                <form method="POST" action="">
                    @csrf

                    <div class="form-group has-feedback">
                    <input id="cname" type="text" class="form-control @error('cname') is-invalid @enderror" name="cname" value="{{ old('cname') }}" placeholder="Company Name" required autocomplete="cname" autofocus>
                        
                            @error('cname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group has-feedback">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="row">
                    <div class="col-lg-6 form-group has-feedback">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required autocomplete="phone" autofocus>
                            
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-lg-6 form-group has-feedback">
                        <input id="phone2" type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}" placeholder="Second Phone" required autocomplete="phone2" autofocus>
                            
                            @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    </div>
                    <div class="row">
                       
                            <div class="col-lg-6 form-group has-feedback">
                                <input id="accname" type="text" class="form-control @error('accname') is-invalid @enderror" name="accname" value="{{ old('accname') }}" placeholder="Account Name" required autocomplete="phone2" autofocus>
                                    
                                    @error('phone2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-lg-6 form-group has-feedback">
                                <input id="bank" type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" value="{{ old('bank') }}" placeholder="Bank Name" required autocomplete="bank" autofocus>
                                    
                                    @error('bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                   
                    </div>
                    <div class="row">
                       
                        <div class="col-lg-6 form-group has-feedback">
                            <input id="senderid" type="text" class="form-control @error('senderid') is-invalid @enderror" name="senderid" value="{{ old('senderid') }}" placeholder="SMS ID">
                                
                                @error('senderid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-lg-6 form-group has-feedback">
                            <input id="smskey" type="text" class="form-control @error('smskey') is-invalid @enderror" name="smskey" value="{{ old('smskey') }}" placeholder="SMS KEY">
                                
                                @error('smskey')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
               
                </div>
                    <div class="form-group has-feedback">
                        <input id="accno" type="text" class="form-control @error('accno') is-invalid @enderror" name="accno" placeholder="Account Number" required autocomplete="accno">
                             @error('accno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input id="skey" type="text" class="form-control @error('skey') is-invalid @enderror" name="key" placeholder="Paystack Secret Key">
                             @error('skey')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" required autocomplete="address">
                             @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group has-feedback">
                        <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                             @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group has-feedback">
                        <input id="pass" type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" placeholder="Confirm Password" required autocomplete="current-password">
                             @error('confirmpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
            
                    <div class="form-group row">
                        {{-- <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </div>
                             
                        </div> --}}
                        
                          <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-outline-primary">
                                 {{ __('Register')}} 
                            </button>
                          </div>
                        </div>
                </form>
                <div style="text-align: center;">
                    Already Registered? <a href="/login" class="text-center">Login</a>
                  </div>
            </div>
        </div>
    </div>


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>