<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Ký</title>
    <link rel='shortcut icon' href="{{ asset('img/pnglogoSneaker.png') }}" />
    <!-- plugins:css
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
   <link rel="stylesheet" href="../../assets/css/style.css">
   
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    -->
    <link href="{{ url('css/logincss/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/logincss/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/logincss/vendor.bundle.base.css') }}" rel="stylesheet" type="text/css">

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
        <a href="{{ route('home1') }}" class="logo">
            <img src="{{ asset('img/pnglogoSneaker.png') }}" height="77px" width="auto">
        </a>
    </header>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h3 style="margin-left:37%">Đăng Ký</h3>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="" placeholder="Nhập tên" required autocomplete="name"
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="address"
                                            value="" placeholder="Địa Chỉ">

                                    </div>

                                    <div class="form-group">
                                        <input id="name" type="number"
                                            class="form-control @error('name') is-invalid @enderror" name="phone"
                                            value="" placeholder="Số Điện Thoại">

                                    </div>



                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="" placeholder="Email" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Nhập Mật Khẩu" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Nhập lại mật khẩu" required
                                            autocomplete="new-password">

                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Đăng Ký') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4 font-weight-light"> Đã có tài khoản? <a
                                            href="{{ route('login') }}" class="text-primary">Đăng Nhập</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>
