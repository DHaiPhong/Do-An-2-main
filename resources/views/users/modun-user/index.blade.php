@extends('users.masterUser')
@include('users.modun-user.banner')
@section('css')
    <link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">

@stop
@section('content')
    <section class="producth" id="producth">
        <h1 class="heading"><span>TOP</span> Sản Phẩm Bán Chạy</h1>
        <div class="box-container">
            @foreach ($sells as $sell)
                <div class="box">
                    <div class="content" style="position:relative">
                        <a href="{{ route('users.productdetail', $sell->slug) }}"><img src="/anh/{{ $sell->prd_image }}"
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
        <div style="width:100% ;padding: 0 25%;  margin-top:30px " > <div style="width:100% ; height:2px; background-color:orange"></div> </div>

        {{-- </section>
    <!--end product-->
    <section class="featured" id="fearured"> --}}
        <h1 class="heading">Sản Phẩm <span>HOT</span></h1>
        <div class="box-container">
            @foreach ($views as $view)
                <div class="box">
                    <div class="content" style="position:relative">
                        <a href="{{ route('users.productdetail', $view->slug) }}"><img src="/anh/{{ $view->prd_image }}"
                                width=" " alt=""></a>
                        <h3>{{ \Illuminate\Support\Str::limit($view->prd_name, '43') }}</h3>
                        <div style="height: 80px"></div>
                        <div class="product-item"
                            style=" display: flex;
                                    flex-direction: column;
                                    justify-content: space-between;
                                    height: 40px">
                            @if ($view->prd_sale != 0)
                                <div class="price"
                                    style="text-transform: none; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start;">

                                    <div style="display:flex">
                                        <p
                                            style="text-decoration: line-through;font-size: 20px; color: red; text-transform: none; margin-right: 1rem">
                                            {{ number_format($view->price) }} đ</p>
                                        <p style="text-transform: none; font-size: 20px">
                                            {{ number_format($view->price - ($view->price * $view->prd_sale) / 100) }} đ
                                        </p>
                                        <p style="color: red; font-size: 1.2rem; margin-left: 0.8rem"> -
                                            {{ $view->prd_sale }}%
                                        </p>
                                    </div>
                                    <p style="text-transform: none; font-size: 12px; color: red; margin-bottom: 0;">Còn lại
                                        {{ $view->prd_amount }} sản phẩm</p>
                                </div>
                            @else
                                <div class="price"
                                    style="text-transform: none; display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-start;">
                                    <div style="display:flex">
                                        <p style="text-transform: none; font-size: 20px">
                                            {{ number_format($view->price - ($view->price * $view->prd_sale) / 100) }} đ
                                        </p>
                                    </div>
                                    <p style="text-transform: none; font-size: 12px; color: red; margin-bottom: 0;">Còn lại
                                        {{ $view->prd_amount }} sản phẩm</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div id="banner" >
        <img src="img/slide/giayslide5.png" style="left:54%; height:680px;width:auto" alt="Shoe" id="animatedShoe">
        <div id="animatedtext" style="right:50%;">
        <h1  style="color:white; text-wrap:nowrap" >Chào mứng đến với cửa hàng chúng tôi</h1>
        <p style="color:white; text-wrap:nowrap">Hãy click vào đây để khám phá những mẫu giày mới nhất </p>
        <a href="{{ route('users.product') }}"><button   class="sketch-button"> Nhấn vào đây</button></a>
        </div>
        


    <section>
        <h1 class="heading"><span>TOP 3</span> Sản Phẩm được đánh giá cao nhất</h1>
        <div class="container d-flex justify-content-center">
            @foreach ($rates as $rate)
                <figure class="card card-product-grid card-lg">
                    <a href="{{ route('users.productdetail', $rate->slug) }}" class="img-wrap" data-abc="true"> <img
                            src="anh/{{ $rate->prd_image }}"> </a>
                    <figcaption class="info-wrap">
                        <div class="row">
                            <div class="col-xs-9" style="height:110px"> <a
                                    href="{{ route('users.productdetail', $rate->slug) }}" class="title"
                                    data-abc="true">{{ $rate->prd_name }}</a> </div>

                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="rating text-right" style="width: 228px;">
                                @for ($i = 0; $i < round($rate->average_rating, 0, PHP_ROUND_HALF_UP); $i++)
                                    <i class="fa fa-star" style="color: #ffcc00;font-size: 3rem"></i>
                                @endfor
                            </div>
                            <span class="rated" style="font-size:15px; text-wrap:nowrap">Rated
                                {{ round($rate->average_rating, 0) }}/5</span>
                        </div>
                    </figcaption>

                    <div class="bottom-wrap-payment">
                        <figcaption class="info-wrap">
                            <div class="row">
                                <div class="col-md-9 col-xs-9"> <a href="#" class="title"
                                        data-abc="true">{{ number_format($rate->price) }} đ</a></div>

                                <div class="bottom-wrap"> <a href="{{ route('users.productdetail', $rate->slug) }}"
                                        class="btn btn-primary float-right" data-abc="true"> Mua </a>
                                </div>
                        </figcaption>
                    </div>
                </figure>
            @endforeach
        </div>
    </section>
    <div style="width:100% ;padding: 0 25%;  margin-top:30px " > <div style="width:100% ; height:2px; background-color:orange"></div> </div>

    <section style="" class="why_section layout_padding">

        <div class="container">
            <div class="heading_center">
                <h2>
                    Tại sao mua sắm với chúng tôi
                </h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M476.158,231.363l-13.259-53.035c3.625-0.77,6.345-3.986,6.345-7.839v-8.551c0-18.566-15.105-33.67-33.67-33.67h-60.392

                 V110.63c0-9.136-7.432-16.568-16.568-16.568H50.772c-9.136,0-16.568,7.432-16.568,16.568V256c0,4.427,3.589,8.017,8.017,8.017
                 c4.427,0,8.017-3.589,8.017-8.017V110.63c0-0.295,0.239-0.534,0.534-0.534h307.841c0.295,0,0.534,0.239,0.534,0.534v145.372
                 c0,4.427,3.589,8.017,8.017,8.017c4.427,0,8.017-3.589,8.017-8.017v-9.088h94.569c0.008,0,0.014,0.002,0.021,0.002
                 c0.008,0,0.015-0.001,0.022-0.001c11.637,0.008,21.518,7.646,24.912,18.171h-24.928c-4.427,0-8.017,3.589-8.017,8.017v17.102
                 c0,13.851,11.268,25.119,25.119,25.119h9.086v35.273h-20.962c-6.886-19.883-25.787-34.205-47.982-34.205
                 s-41.097,14.322-47.982,34.205h-3.86v-60.393c0-4.427-3.589-8.017-8.017-8.017c-4.427,0-8.017,3.589-8.017,8.017v60.391H192.817
                 c-6.886-19.883-25.787-34.205-47.982-34.205s-41.097,14.322-47.982,34.205H50.772c-0.295,0-0.534-0.239-0.534-0.534v-17.637
                 h34.739c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017H8.017c-4.427,0-8.017,3.589-8.017,8.017
                 s3.589,8.017,8.017,8.017h26.188v17.637c0,9.136,7.432,16.568,16.568,16.568h43.304c-0.002,0.178-0.014,0.355-0.014,0.534
                 c0,27.996,22.777,50.772,50.772,50.772s50.772-22.776,50.772-50.772c0-0.18-0.012-0.356-0.014-0.534h180.67
                 c-0.002,0.178-0.014,0.355-0.014,0.534c0,27.996,22.777,50.772,50.772,50.772c27.995,0,50.772-22.776,50.772-50.772
                 c0-0.18-0.012-0.356-0.014-0.534h26.203c4.427,0,8.017-3.589,8.017-8.017v-85.511C512,251.989,496.423,234.448,476.158,231.363z
                  M375.182,144.301h60.392c9.725,0,17.637,7.912,17.637,17.637v0.534h-78.029V144.301z M375.182,230.881v-52.376h71.235
                 l13.094,52.376H375.182z M144.835,401.904c-19.155,0-34.739-15.583-34.739-34.739s15.584-34.739,34.739-34.739
                 c19.155,0,34.739,15.583,34.739,34.739S163.99,401.904,144.835,401.904z M427.023,401.904c-19.155,0-34.739-15.583-34.739-34.739
                 s15.584-34.739,34.739-34.739c19.155,0,34.739,15.583,34.739,34.739S446.178,401.904,427.023,401.904z M495.967,299.29h-9.086
                 c-5.01,0-9.086-4.076-9.086-9.086v-9.086h18.171V299.29z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M144.835,350.597c-9.136,0-16.568,7.432-16.568,16.568c0,9.136,7.432,16.568,16.568,16.568
                 c9.136,0,16.568-7.432,16.568-16.568C161.403,358.029,153.971,350.597,144.835,350.597z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M427.023,350.597c-9.136,0-16.568,7.432-16.568,16.568c0,9.136,7.432,16.568,16.568,16.568
                 c9.136,0,16.568-7.432,16.568-16.568C443.591,358.029,436.159,350.597,427.023,350.597z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M332.96,316.393H213.244c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017H332.96
                 c4.427,0,8.017-3.589,8.017-8.017S337.388,316.393,332.96,316.393z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M127.733,282.188H25.119c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h102.614
                 c4.427,0,8.017-3.589,8.017-8.017S132.16,282.188,127.733,282.188z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M278.771,173.37c-3.13-3.13-8.207-3.13-11.337,0.001l-71.292,71.291l-37.087-37.087c-3.131-3.131-8.207-3.131-11.337,0
                 c-3.131,3.131-3.131,8.206,0,11.337l42.756,42.756c1.565,1.566,3.617,2.348,5.668,2.348s4.104-0.782,5.668-2.348l76.96-76.96
                 C281.901,181.576,281.901,176.501,278.771,173.37z" />
                                    </g>
                                </g>

                            </svg>
                        </div>
                        <div class="detail-box">
                            <p>
                                Giao hàng nhanh
                            </p>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <img style="width:50px" src="/anh/discount.png">
                        </div>
                        <div class="detail-box">
                            <p>
                                Giá cả hợp lý
                            </p>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="img-box">
                            <svg id="_30_Premium" height="512" viewBox="0 0 512 512" width="512"
                                xmlns="http://www.w3.org/2000/svg" data-name="30_Premium">
                                <g id="filled">
                                    <path
                                        d="m252.92 300h3.08a124.245 124.245 0 1 0 -4.49-.09c.075.009.15.023.226.03.394.039.789.06 1.184.06zm-96.92-124a100 100 0 1 1 100 100 100.113 100.113 0 0 1 -100-100z" />
                                    <path
                                        d="m447.445 387.635-80.4-80.4a171.682 171.682 0 0 0 60.955-131.235c0-94.841-77.159-172-172-172s-172 77.159-172 172c0 73.747 46.657 136.794 112 161.2v158.8c-.3 9.289 11.094 15.384 18.656 9.984l41.344-27.562 41.344 27.562c7.574 5.4 18.949-.7 18.656-9.984v-70.109l46.6 46.594c6.395 6.789 18.712 3.025 20.253-6.132l9.74-48.724 48.725-9.742c9.163-1.531 12.904-13.893 6.127-20.252zm-339.445-211.635c0-81.607 66.393-148 148-148s148 66.393 148 148-66.393 148-148 148-148-66.393-148-148zm154.656 278.016a12 12 0 0 0 -13.312 0l-29.344 19.562v-129.378a172.338 172.338 0 0 0 72 0v129.38zm117.381-58.353a12 12 0 0 0 -9.415 9.415l-6.913 34.58-47.709-47.709v-54.749a171.469 171.469 0 0 0 31.467-15.6l67.151 67.152z" />
                                    <path
                                        d="m287.62 236.985c8.349 4.694 19.251-3.212 17.367-12.618l-5.841-35.145 25.384-25c7.049-6.5 2.89-19.3-6.634-20.415l-35.23-5.306-15.933-31.867c-4.009-8.713-17.457-8.711-21.466 0l-15.933 31.866-35.23 5.306c-9.526 1.119-13.681 13.911-6.634 20.415l25.384 25-5.841 35.145c-1.879 9.406 9 17.31 17.367 12.618l31.62-16.414zm-53-32.359 2.928-17.615a12 12 0 0 0 -3.417-10.516l-12.721-12.531 17.658-2.66a12 12 0 0 0 8.947-6.5l7.985-15.971 7.985 15.972a12 12 0 0 0 8.947 6.5l17.658 2.66-12.723 12.535a12 12 0 0 0 -3.417 10.516l2.928 17.615-15.849-8.231a12 12 0 0 0 -11.058 0z" />
                                </g>
                            </svg>
                        </div>
                        <div class="detail-box">

                            <p>
                                Sản phẩm chất lượng
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end featured-->


    <!--end news-->
<script>
var animationPlayed = false;
var animatedBanner = document.getElementById('animatedShoe');
var animatedtext = document.getElementById('animatedtext');

window.addEventListener('scroll', function(){
    var windowPosition = window.scrollY + window.innerHeight;
    var bannerPosition = animatedBanner.getBoundingClientRect().top + window.scrollY;

    if(windowPosition >= bannerPosition && !animationPlayed){
        animationPlayed = true;
        animatedBanner.style.animation = 'slideShoe 2s linear forwards';
        animatedBanner.style.opacity = '1';
        animatedtext.style.animation = 'slidetext 2s linear forwards';
        animatedtext.style.opacity = '1';
    }
});








</script>
@stop
