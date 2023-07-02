<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel='shortcut icon' href="{{ asset('img/pnglogoSneaker.png') }}" />
    <!-- plugins:css 
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
   <link rel="stylesheet" href="../../assets/css/style.css">
   
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    -->
    <link href="{{url('css/logincss/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/logincss/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/logincss/vendor.bundle.base.css')}}" rel="stylesheet" type="text/css">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
  </head>
  <body>
  <header>
            <div id="menu-bar" class="fa fa-bars"></div>
            <a href="{{route('users.login')}}" class="logo">
            <img src="{{ asset('img/pnglogoSneaker.png') }}" height ="77px" width = "auto">
        </a>
            
            <div class="icons">
            
                <a href="{{route('users.login')}}" class="signup_btn" style="color: black; size:5px "> Login </a>

            </div>
        </header>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
               
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3"  method="post" action="{{route('users.signup')}}" >
                @csrf  
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputUsername1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="address" id="exampleInputEmail1" placeholder="Address">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="phone" id="phone_number" placeholder="Phone Number">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{route('users.login')}}" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
<script>
  // Access the input element
  var input = document.getElementById('phone_number');

  // Listen for input into the phone number field
  input.addEventListener('input', function() {
    // Replace any non-digit characters with an empty string
    input.value = input.value.replace(/\D/g, '');
  });
</script>