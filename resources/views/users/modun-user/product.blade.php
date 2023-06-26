@extends('users.masterUser')

@include('users.modun-user.banner')
@section('css')
<link  href="{{ url('css/productcss/prd.css') }}"  rel="stylesheet" type="text/css">
@stop
@section('product')

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
            <li>
                <a href="{{url('/product/1')}}">

                    <strong>NIKE</strong>
                </a>
            </li>

            <li>
                <a href="{{url('/product/2')}}">

                    <strong>ADIDAS</strong>
                </a>
            </li>


            <li>
                <a href="{{url('/product/3')}}">

                    <strong>PUMA</strong>

                </a>

            </li>


        </ul>
    </div>
    <div class='rowprd'>
        <table>
            <tbody>
                @foreach($prds as $prd)
                <div class='product' style="  width: 14em; min-width:14em;   height: 360px; position: relative;">

                    <div class='product_inner'>
                    @if($prd->prd_sale !=0)
                    <div>
                        <img src="/anh/sale-tag-icon.png" style="width: 33px;position: absolute;right: 18px;">
                        
                        <p style="position: absolute; font-weight:600;right: 40px;color:red;padding-top:17px;">-{{$prd->prd_sale}}%</p>
</div>
                    @endif    
                        <a style="border:none" href="{{route('users.productdetail',['id'=> $prd->prd_id])}}">
                            <img style="width:200px" src='/anh/{{$prd->prd_image}}'>
                        </a>

                        <p style="text-transform: uppercase;font-weight:600; padding-top:5px;">{{$prd->prd_name}}</p>
                    
                    </div>
                    <div
                        style="text-align: center; position: absolute;bottom: 20px;top:75%; left: 50%;transform: translate(-50%, -50%);">

                        <p style=";margin-bottom: 0;">Price </p>

                        @if($prd->prd_sale !=0)
                                        <div style="display:flex">
                                            <div>
                                                <p style="color:red;margin-bottom: 0;text-decoration: line-through;">{{ number_format($prd->price) }}đ</p>
                                            </div>
                                            <div style="margin-left:10px">
                                                <p style=" color: red">
                                                    {{number_format($prd->price / 100 * (100-$prd->prd_sale))}}đ</p>
                                            </div>
                                        </div>

                                        @else
                                        <p style="color:red;margin-bottom: 0;">{{ number_format($prd->price) }} đ</p>


                                        @endif
                        
                            <br>


                            <a class="btn" type="button" style="margin-top:-14px;"
                                href="{{route('users.productdetail',['id'=> $prd->prd_id])}}">Detail</a>
                        </p>
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