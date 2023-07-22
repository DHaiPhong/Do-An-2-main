@extends('users.masterUser')
@section('css')
    <link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <section class="main-content" style="margin-top: 5%; font-size: 1.5rem">
        <h1 style="  padding-left:25%;  text-align: center"> {{ $cat }}</h1>
        <div class="row">
            <div class="col-md-3">
                <div class='rowprd' style="margin-right: 10rem; position:sticky; top:110px">
                    <ul class="mcd-menu">
                        <ul class="parent-list">
                            <li style="background-color: orangered; color: #fff">
                                <a href="" style="pointer-events: none;">
                                    <strong style="color: #fff"> Lọc Theo </strong>
                                </a>
                            </li>
                            <li
                                style="{{ Route::currentRouteName() == 'product.by.view' ? 'background: orangered;' : '' }}">
                                <a href="{{ route('product.by.view') }}"
                                    style="{{ Route::currentRouteName() == 'product.by.view' ? 'color: #fff;' : '' }}">
                                    <strong style="">Lượt xem </strong>
                                </a>
                            </li>
                            <li
                                style="{{ Route::currentRouteName() == 'product.by.rating' ? 'background: orangered;' : '' }}">
                                <a href="{{ route('product.by.rating') }}"
                                    style="{{ Route::currentRouteName() == 'product.by.rating' ? 'color: #fff;' : '' }}">
                                    <strong style="">Đánh Giá </strong>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.by.sale') }}" style="">
                                    <strong style="">Giảm Giá </strong>
                                </a>
                            </li>
                            <li class="list-item">
                                <a href="">
                                    <strong style="">Giá </strong>
                                </a>
                                <ul class="child-list">
                                    <li class="child-item">
                                        <a href="{{ route('product.by.lowprice') }}"><strong>Từ Thấp đến Cao</strong></a>
                                    </li>
                                    <li class="child-item">
                                        <a href="{{ route('product.by.highprice') }}"><strong>Từ Cao đến Thấp</strong></a>
                                    </li>
                                </ul>
                            </li>
                            <li style="background-color: orangered; color: #fff">
                                <a href="" style="pointer-events: none;">
                                    <strong style="color: #fff">Danh Mục </strong>
                                </a>
                            </li>
                            @if (isset($categories))
                                @foreach ($categories as $category)
                                    <li class="list-item">
                                        <a href="{{ route('product.category', $category->slug) }}">
                                            <strong>{{ $category->name }}</strong>
                                        </a>
                                        @if ($category->children->isNotEmpty())
                                            <ul class="child-list">
                                                @foreach ($category->children as $sub)
                                                    <li class="child-item">
                                                        <a href="{{ route('product.category', $sub->slug) }}">
                                                            <strong>{{ $sub->name }}</strong>
                                                        </a>
                                                        @if ($sub->children->isNotEmpty())
                                                            <ul>
                                                                @foreach ($sub->children as $sub2)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('product.category', $sub2->slug) }}">
                                                                            <strong>{{ $sub2->name }}</strong>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="rowprd" style="float: left">
                    <table>
                        <tbody>
                            @if (count($prds) == 0)
                                <div class="alert alert-info text-center m-0" style="font-size: 2rem" role="alert">
                                    Không tìm thấy sản phẩm liên quan.
                                </div>
                            @else
                                @foreach ($prds as $prd)
                                    <div class='product'
                                        style="  width: 14em; min-width:14em;   height: 370px; position: relative;">

                                        <div class='product_inner'>
                                            @if ($prd->prd_sale != 0)
                                                <div>
                                                    <p
                                                        style="padding-left:2px;background-color:red;position: absolute; left: 14px ; top: 28px;font-size:12px; font-weight:600;color:white;">
                                                        SALE {{ $prd->prd_sale }}%</p>

                                                </div>
                                            @endif
                                            <a style="border:none"
                                                href="{{ route('users.productdetail', ['id' => $prd->slug]) }}">
                                                <img style="width:200px" src='/anh/{{ $prd->prd_image }}'>
                                            </a>

                                            <a href="{{ route('users.productdetail', ['id' => $prd->slug]) }}">
                                                <p style="text-transform: uppercase;font-weight:600; padding-top:5px;">
                                                    {{ $prd->prd_name }}
                                                </p>
                                            </a>
                                        </div>
                                        <div
                                            style="text-align: center; position: absolute;top: 90%; left: 50%;transform: translate(-50%, -50%);">
                                            <p style="font-size:12px;margin-bottom: 0;font-weight:500"><i class="fa fa-eye"
                                                    title="Lượt xem" style="font-size: 12px"></i>
                                                {{ $prd->views }}</p>

                                            @if ($prd->prd_sale != 0)
                                                <div style="display:flex">
                                                    <div>
                                                        <p
                                                            style="color:gray;margin-bottom: 0;text-decoration: line-through;font-size:15px;">
                                                            {{ number_format($prd->price) }}đ</p>
                                                    </div>
                                                    <div style="margin-bottom: 0;margin-left:10px;font-size:15px;">
                                                        <p style=" margin-bottom: 0;color: red;font-size:15px;">
                                                            {{ number_format(($prd->price / 100) * (100 - $prd->prd_sale)) }}đ
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <p style="color:red;margin-bottom: 0;font-size:15px;">
                                                    {{ number_format($prd->price) }}
                                                    đ
                                                </p>
                                            @endif
                                            @php
                                                $rating = round($ratings[$prd->prd_id]['avg_rating'] ?? 0);
                                                $ratingCount = $ratings[$prd->prd_id]['count_rating'] ?? 0;
                                            @endphp

                                            <ul class="list-inline" style="display: flex">
                                                @for ($count = 1; $count <= 5; $count++)
                                                    @php
                                                        if ($count <= $rating) {
                                                            $color = 'color: #ffcc00;';
                                                        } else {
                                                            $color = 'color: #ccc;';
                                                        }
                                                    @endphp
                                                    <li class="rating"
                                                        style="cursor:pointer; font-size: 3rem; {{ $color }}; margin-right: 0.5rem"
                                                        title="Đánh Giá"> &#9733; </li>
                                                @endfor
                                                <li style="margin-top: 14px">({{ $ratingCount }})</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <section>
            <div class='rowprd'>
                {{ $prds->links() }}
            </div>
        </section>
    </section>
@stop
@section('js')
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value;
            console.log(query);
            if (query.length > 2) {
                fetch('/suggestions?query=' + query)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionList = document.getElementById('suggestionList');
                        suggestionList.innerHTML = '';

                        data.forEach(item => {
                            let suggestionItem = document.createElement('li');
                            suggestionItem.classList.add('suggestion-item');

                            let prdImage = document.createElement('img');
                            prdImage.classList.add('suggestion-img');
                            prdImage.src = 'anh/' + item.prd_image;
                            suggestionItem.appendChild(prdImage);

                            let prdName = document.createElement('p');
                            prdName.textContent = item.prd_name;
                            suggestionItem.appendChild(prdName);

                            let prdPrice = document.createElement('span');
                            prdPrice.textContent = '$' + item.price;
                            prdPrice.textContent = formatPrice(item.price) + 'VND';
                            suggestionItem.appendChild(prdPrice);

                            suggestionItem.addEventListener('click', function() {
                                document.getElementById('searchInput').value = item.prd_name;
                                suggestionList.style.display = 'none';
                            });

                            suggestionList.appendChild(suggestionItem);
                        });

                        suggestionList.style.display = 'block';
                    });
            } else {
                document.getElementById('suggestionList').style.display = 'none';
            }
        });
    </script>
@endsection
