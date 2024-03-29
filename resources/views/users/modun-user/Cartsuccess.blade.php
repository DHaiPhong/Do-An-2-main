@extends('users.masterUser')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        .hh1{
            
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .cc{
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        .checkmark{
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>
@stop
@section('content')


    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1 class="hh1">Thành công!</h1>
        <p class="cc">Cảm ơn đã đặt hàng ở web mình!<br /> Xin chào tạm biệt và hẹn gặp lại!!!</p>
        <a class="btn" href="{{ route('home1') }}">Quay về Trang Chủ</a>
    </div>
@stop
