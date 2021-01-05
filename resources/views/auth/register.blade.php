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
 <section class="content">
 <div class="login-logo">
  <img src='/storage/storage/livepetal.png' class="pr-1" width="6%"><h2>FINSMART</h2>
 </div>
 <div class="row">
  @extends('inc.msg')
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body login-card-body">
        <form method="POST" action="{{ route('register') }}">
        <div class="box box-default">
                <div class="box-header with-border">
                <h3 class="box-title text-center">Basic Information</h3>
                </div>
                  @csrf
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                          <label>{{ __('Surname') }}</label>
                          <input id="surname" type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" placeholder="Enter Surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                          <label>{{ __('Other names') }}</label>
                          <input id="othername" type="text" name="othername" class="form-control @error('othername') is-invalid @enderror" placeholder="Enter Other Names" value="{{ old('othername') }}" required autocomplete="othername" autofocus>
                                @error('othername')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
                       <div class="col-md-6">
                         <div class="form-group">
                         <label>{{ __('Date of Birth') }}</label>
                         <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                         <input type="date" name="birthday"  class="form-control @error('birthday') is-invalid @enderror" id="datepicker" placeholder="Enter Birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         </div>    
                         </div>
                       </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>{{ __('Gender') }}</label>
                        <select name="sex" class="form-control @error('sex') is-invalid @enderror" value="{{ old('sex') }}" required autocomplete="sex" autofocus>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>
                      </div>
                    </div>
                    </div>
                    </div>
                    <div class="box box-default">
                    <div class="box-header with-border">
                    <h3 class="box-title">Contact Information</h3>
                    </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                          <label>{{ __('Phone Number') }}</label>
                          <input id="phone" type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              </div>
             <div class="col-md-6">
              <div class="form-group">
                          <label>{{ __('Additional Phone Number') }}</label>
                          <input id="phone2" type="number" name="phone2" class="form-control @error('phone2') is-invalid @enderror" placeholder="Enter Second Phone Number" value="{{ old('phone2') }}" required autocomplete="phone2" autofocus>
                                @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                          <label>{{ __('Residential Address') }}</label>
                          <input id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Residential Address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              </div>
              <div class="col-md-6">
             <div class="form-group">
                <label>{{ __('State of Residence') }}</label>
                        <select name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" required autocomplete="state" autofocus>
                          <option value="">Select state...</option>
                  <option>Abia</option>
                  <option>Adamawa</option>
                  <option>Akwa-Ibom</option>
                  <option>Anambra</option>
                  <option>Bauchi</option>
                  <option>Bayelsa</option>
                  <option>Benue</option>
                  <option>Borno</option>
                  <option>Cross River</option>
                  <option>Delta</option>
                  <option>Ebonyi</option>
                  <option>Edo</option>
                  <option>Ekiti</option>
                  <option>Enugu</option>
                  <option>FCT</option>
                  <option>Gombe</option>
                  <option>Imo</option>
                  <option>Jigawa</option>
                  <option>Kaduna</option>
                  <option>Kano</option>
                  <option>Katsina</option>
                  <option>Kebbi</option>
                  <option>Kogi</option>
                  <option>Kwara</option>
                  <option>Lagos</option>
                  <option>Nasarawa</option>
                  <option>Niger</option>
                  <option>Ogun</option>
                  <option>Ondo</option>
                  <option>Osun</option>
                  <option>Oyo</option>
                  <option>Plateau</option>
                  <option>Rivers</option>
                  <option>Sokoto</option>
                  <option>Taraba</option>
                  <option>Yobe</option>
                  <option>Zamfara</option>
                  <option>Outside Nigeria</option>
            </select>
             @error('state')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                          <label>{{ __('City') }}</label>
                          <input id="city" type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter City of Residence" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                          <label>{{ __('Office Address') }}</label>
                          <input id="address2" type="text" name="address2" class="form-control @error('address2') is-invalid @enderror" placeholder="Enter Office Address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address2')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              </div>
            </div>
            </div>
            </div>
        <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">User Login Information</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>{{ __('E-Mail Address') }}</label>
                 <input id="email" type="email" placeholder="Enter E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              </div>

                <div class="col-md-4">     
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                             <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                           <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
              </div>

                    <div class="box-footer">
                                <button type="submit" class="btn btn-outline-primary" style="float:right">
                                    {{ __('Create Account') }}
                                </button>
                    </div>
                    </div>
                    <div style="padding: 20px" >Already Have an Account 
                    <a href="{{ route('login') }}" class="text-center"> Login Here</a>
                    </div>
                </div>
        </form>
        </div>
    </div>
  </div>
 </div>
</section>

<!-- jQuery -->
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
</body>
</html>