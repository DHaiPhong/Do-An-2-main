@extends('users.masterUser')
@include('users.modun-user.banner')
@section('content')
    <section class="producth" id="producth">
        <h1 class="heading"><span>TOP 5</span> Sản Phẩm Bán Chạy</h1>
        <div class="box-container">
            @foreach ($sells as $sell)
                <div class="box">
                    <div class="content" style="position:relative">
                        <a href="{{ route('users.productdetail', $sell->prd_id) }}"><img src="/anh/{{ $sell->prd_image }}"
                                width=" " alt=""></a>
                        <h3>{{ \Illuminate\Support\Str::limit($sell->prd_name, '43') }}</h3>
                        <div style="height: 80px"></div>
                        <div class="product-item"
                            style=" display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                    height: 40px">
                            @if ($sell->prd_sale != 0)
                                <div class="price"
                                    style="text-transform: none; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start;">

                                    <div style="display:flex">
                                        <p
                                            style="text-decoration: line-through;font-size: 20px; color: red; text-transform: none; margin-right: 1rem">
                                            {{ number_format($sell->price) }} đ</p>
                                        <p style="text-transform: none; font-size: 20px">
                                            {{ number_format($sell->price - ($sell->price * $sell->prd_sale) / 100) }} đ</p>
                                        <p style="color: red; font-size: 1.2rem; margin-left: 0.8rem"> -
                                            {{ $sell->prd_sale }}%
                                        </p>
                                    </div>
                                    <p style="text-transform: none; font-size: 12px; color: red; margin-bottom: 0;">Còn lại
                                        {{ $sell->prd_amount }} sản phẩm</p>
                                </div>
                            @else
                                <div class="price"
                                    style="text-transform: none; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start;">
                                    <div style="display:flex">
                                        <p style="text-transform: none; font-size: 20px">
                                            {{ number_format($sell->price - ($sell->price * $sell->prd_sale) / 100) }} đ</p>
                                    </div>
                                    <p style="text-transform: none; font-size: 12px; color: red; margin-bottom: 0;">Còn lại
                                        {{ $sell->prd_amount }} sản phẩm</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach



        </div>
    </section>
    <!--end product-->
    <section class="featured" id="fearured">
        <h1 class="heading">Sản Phẩm <span>HOT</span></h1>
        @foreach($products as $product)
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
                
                <div class="price"> Price: 8.369.000VND <span></span></div>
                <a href="{{ route('users.productdetail', ['id' => 16]) }}" class="btn">Mua</a>
            </div>
        </div>
        @endforeach
        

        
    </section>
    <!--end featured-->


    <!--end news-->

@stop
