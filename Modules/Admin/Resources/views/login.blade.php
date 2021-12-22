<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  
  <link rel="stylesheet" href="{{ url('public/Admin/assets/') }}/plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="{{ url('public/Admin/assets/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <link rel="stylesheet" href="{{ url('public/Admin/assets/') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="card card-outline card-primary">
       @if(session()->has('failed'))
              <center class="text-danger">{{ session()->get('failed') }}</center>
            @endif
    <div class="card-header text-center">
      <a href="javascript:;" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

     <form action="{{ url('admin/login-post') }}" method="post">
         @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
                <!--<div class="icheck-primary">-->
                <!--  <input type="checkbox" id="remember">-->
                <!--  <label for="remember">-->
                <!--    Remember Me-->
                <!--  </label>-->
                <!--</div>-->
          </div>
          
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          
        </div>
      </form>

     
      

      <p class="mb-1">
        <!--<a href="forgot-password.html">I forgot my password</a>-->
      </p>
      <p class="mb-0">
        <!--<a href="register.html" class="text-center">Register a new membership</a>-->
      </p>
    </div>
    
  </div>
  
</div>



<script src="{{ url('public/Admin/assets/') }}/plugins/jquery/jquery.min.js"></script>

<script src="{{ url('public/Admin/assets/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{ url('public/Admin/assets/') }}/dist/js/adminlte.min.js"></script>
</body>


</html>




