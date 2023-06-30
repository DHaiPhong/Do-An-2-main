<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="Gq6XlRkyOGNGID1KYINLGR7v3pLl92TbKgBw3C3J">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Dashboard </title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript"
        src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=EwAWSSWG_Mf00rU0IisELu-egk13OlOkEG_N9ykHzzv9QL4qOQ_Sl5QJx2f-QCuw"
        charset="UTF-8"></script>
    @yield('css')
    <style>
        .statusbox {


            width: 85px;
            text-align: center;
            border-radius: 5px;

            padding-bottom: 3%;
            padding-top: 3%;
        }
    </style>
    <link href="{{ url('css/admincss/account.css') }}" rel="stylesheet" type="text/css">
    
    
</head>

<body class="sidebar-mini">
    <div class="wrapper">
        @include('Admin.thanhphan.header')
        @yield('content')
        {{-- @yield('content-account')
        @yield('detail')
        @yield('add')
        @yield('order')
        @yield('orderdetail')
        @yield('product')
        @yield('prd_detail') --}}
        @include('Admin.thanhphan.sidebar')
        @include('Admin.thanhphan.javascript')
    </div>
</body>

</html>
