@extends('users.masterUser')
@include('users.modun-user.banner')
@section('content')
    <section class="producth" id="producth">
        <h1 class="heading"><span>TOP 5</span> Best seller</h1>
        <div class="box-container">
            @foreach ($sells as $sell)
                <div class="box">
                    <div class="content">
                        <a href="{{ route('users.productdetail', $sell->prd_id) }}"><img src="/anh/{{ $sell->prd_image }}"
                                width=" " alt=""></a>
                        <h3>{{ \Illuminate\Support\Str::limit($sell->prd_name, '17') }}</h3>
                        @if ($sell->prd_sale != 0)
                            <div class="price" style="text-transform: none;">

                                <div style="display:flex">
                                    <p
                                        style="text-decoration: line-through;font-size: 20px; color: red; text-align: left; text-transform: none; margin-right: 1rem">
                                        {{ number_format($sell->price) }} đ</p>
                                    <p style="text-align: left; text-transform: none; font-size: 20px">
                                        {{ number_format($sell->price - ($sell->price * $sell->prd_sale) / 100) }} đ</p>
                                    <p style="color: red; font-size: 1.2rem; margin-left: 0.8rem"> - {{ $sell->prd_sale }}%
                                    </p>
                                </div>
                                <p style="text-align: left; text-transform: none; font-size: 12px; color: red">
                                    {{ $sell->prd_amount }}
                                    products left</p>
                            </div>
                        @else
                            <div class="price" style="text-transform: none;">
                                <p style="text-transform: none; font-size: 20px; text-align: left">Price:
                                    {{ number_format($sell->price - ($sell->price * $sell->prd_sale) / 100) }} đ</p>
                                <p style="text-align: left; text-transform: none; font-size: 12px; color: red">
                                    {{ $sell->prd_amount }}
                                    products left</p>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach



        </div>
    </section>
    <!--end product-->
    <section class="featured" id="fearured">
        <h1 class="heading">New <span>Product</span></h1>
        <div class="row">
            <div class="image-container">
                <div class="small-image">
                    <img src="img/product1/Nike Alphafly 2 1.png" alt="" class="featured-image-1">
                    <img src="img/product1/Nike Alphafly 2 2.png" alt="" class="featured-image-1">
                    <img src="img/product1/Nike Alphafly 3.png" alt="" class="featured-image-1">
                    <img src="img/product1/Nike Alphafly 2 4.png" alt="" class="featured-image-1">
                </div>
                <div class="big-image">
                    <img src="img/product1/Nike Alphafly 2.png" alt="" class="big-image-1">
                </div>
            </div>
            <div class="content">
                <h3>New Nike Alphafly 2</h3>
                <p>
                    Once you take a few strides in the Nike Alphafly 2, you'll never look at your favourite pair of old
                    racing shoes in the same way. These rocket ships are made to help shave precious time off your personal
                    records without surrendering the foundation you need to go the full distance. A thick, lightweight
                    support system brings comfort and speed together so you can enjoy our greatest energy return while you
                    chase your personal bests.
                </p>
                <div class="price"> Price: 8.369.000VND <span></span></div>
                <a href="{{ route('users.productdetail', ['id' => 16]) }}" class="btn">add to cart</a>
            </div>
        </div>

        </div>
    </section>
    <!--end featured-->


    <!--end news-->

@stop
