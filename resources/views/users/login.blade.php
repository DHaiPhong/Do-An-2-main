<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link rel='shortcut icon' href="{{ asset('img/pnglogoSneaker.png') }}" />
    <link href="{{url('css/logincss/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/logincss/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/logincss/vendor.bundle.base.css')}}" rel="stylesheet" type="text/css">
  </head>
  <body>
  <header>
            <div id="menu-bar" class="fa fa-bars"></div>
            <a href="" class="logo">
            <img src="{{ asset('img/pnglogoSneaker.png') }}" height ="77px" width = "auto">
        </a>
            
            <div class="icons">
            
                <a href="" class="signup_btn" style="color: black; size:5px "> Sign up </a>

            </div>
        </header>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <!-- <div class="brand-logo">
                <img src="{{ asset('img/pnglogoSneaker.png') }}" height ="50" width = "auto">
                </div> -->

                
                <h4>LOGIN</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                
                <form method="post" action=""class="pt-3">
                  @csrf
      
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                   
                  </div>
                  
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="" class="text-primary">Sign up</a>
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