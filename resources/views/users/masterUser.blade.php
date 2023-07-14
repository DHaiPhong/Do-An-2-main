<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel='shortcut icon' href="{{ asset('img/pnglogoSneaker.png') }}" />
    <link href="{{ url('css/style_home.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/041cb6b55e.js" crossorigin="anonymous"></script>
    <script src="{{ url('js/search.js') }}" crossorigin="anonymous"></script>
    <link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('css/sidebarcss/sd.css') }}" rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('css/sidebarcss/sd.css') }}" rel="stylesheet"type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')

    <!-- CSS only -->
    <title>{{ $title }}</title>
</head>

<body>

    @include('users.modun-user.headerUser')
    @yield('content')
    @include('users.modun-user.footerUser')


</body>
@yield('js')
<script src="{{ url('js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

{{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script> --}}

</html>
