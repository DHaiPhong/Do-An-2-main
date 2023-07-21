<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Nhập</title>
    <link rel='shortcut icon' href="{{ asset('img/pnglogoSneaker.png') }}" />
    <link href="{{ url('css/logincss/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/logincss/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/logincss/vendor.bundle.base.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="{{ route('home1') }}" class="logo">
            <img src="{{ asset('img/pnglogoSneaker.png') }}" height="77px" width="auto">
        </a>
    </header>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h3 style="text-align:center">Đăng Nhập</h3>
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Nhập Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="Nhập Mật Khẩu" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        {{ __('Đăng Nhập') }}
                                    </button>
                                    <div class="text-center mt-4 font-weight-light"> Không có tài khoản? <a
                                            href="{{ route('register') }}" class="text-primary">Đăng Ký</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
