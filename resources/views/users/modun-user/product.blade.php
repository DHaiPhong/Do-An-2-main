@extends('users.masterUser')

@include('users.modun-user.banner')
@section('css')
<link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')

<section style="margin-top: -5%; font-size: 1.5rem">
    <h1 style="    text-align: center"> Sneakers</h1>
    <div class='rowsb'>
        <ul class="mcd-menu">
            <li class="float">
                <a class="search">
                    <form method="get" role="search" action="{{url('search')}}">
                        @csrf
                        <input type="search" name="search" value="" placeholder="Search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </a>
                <a href="" class="search-mobile">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            <li>
                <a href="{{route('users.product')}}">

                    <strong>SNEAKERS</strong>
                </a>
            </li>
            @foreach($cate as $cat)
            <li>
                <a href="http://127.0.0.1:8000/product/{{$cat->id}}">

                    <strong>{{$cat->brand}}</strong>
                </a>
            </li>
            @endforeach



        </ul>
    </div>
    <div class='rowprd'>
        <table>
            <tbody>
                @foreach($prds as $prd)
                <div class='product' style="  width: 14em; min-width:14em;   height: 310px; position: relative;">

                    <div class='product_inner'>
                        @if($prd->prd_sale !=0)
                        <div>
                            <!-- <img src="/anh/sale-tag-icon.png" style="width: 38px;position: absolute;right: 0px; top:0px;"> -->

                            <p style="padding-left:2px;background-color:red;position: absolute; left: 14px ; top: 28px;font-size:12px; font-weight:600;color:white;">
                                SALE {{$prd->prd_sale}}%</p>
                        </div>
                        @endif
                        
                        <a style="border:none" href="{{route('users.productdetail',['id'=> $prd->prd_id])}}">
                            <img style="width:200px" src='/anh/{{$prd->prd_image}}'>
                        </a>

                        <p style="text-transform: uppercase;font-weight:600; padding-top:5px;">{{$prd->prd_name}}</p>

                    </div>
                    <div
                        style="text-align: center; position: absolute;top: 90%; left: 50%;transform: translate(-50%, -50%);">

                        <p style="font-size:16px;margin-bottom: 0;font-weight:600;">Price </p>

                        @if($prd->prd_sale !=0)
                        <div style="display:flex">
                            <div>
                                <p style="color:gray;margin-bottom: 0;text-decoration: line-through;font-size:15px;">
                                    {{ number_format($prd->price) }}đ</p>
                            </div>
                            <div style="margin-bottom: 0;margin-left:10px;font-size:15px;">
                                <p style=" margin-bottom: 0;color: red;font-size:15px;">
                                    {{number_format($prd->price / 100 * (100-$prd->prd_sale))}}đ</p>
                            </div>
                        </div>


                        @else
                        <p style="color:red;margin-bottom: 0;font-size:15px;">{{ number_format($prd->price) }} đ</p>
                        @endif

                    </div>

                </div>



                @endforeach
            </tbody>
        </table>

    </div>
    <section>
        <div class='rowprd'>
            {{ $prds->links() }}
        </div>
    </section>
</section>
@stop