@extends('users.masterUser')
@section('css')
    <link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <section class="main-content" style="margin-top: 5%; font-size: 1.5rem">
        <h1 style="    text-align: center"> Sản Phẩm</h1>
        <div class="row">
            <div class="col-md-4">
                <div class='rowprd' style="margin-right: 10rem">
                    <ul class="mcd-menu">
                        <ul class="parent-list">
                            <li>
                                <a href="" style="pointer-events: none;">
                                    <strong>Danh Mục</strong>
                                </a>
                            </li>
                            @if (isset($categories))
                                @foreach ($categories as $category)
                                    <li class="list-item">
                                        <a href="{{ route('product.category', $category->slug) }}">
                                            <strong>{{ $category->name }}</strong>
                                        </a>
                                        @if ($category->subCategories->isNotEmpty())
                                            <ul class="child-list">
                                                @foreach ($category->subCategories as $sub)
                                                    <li class="child-item">
                                                        <a href="{{ route('product.category', $sub->slug) }}">
                                                            <strong>{{ $sub->name }}</strong>
                                                        </a>
                                                        @if ($sub->subCategories->isNotEmpty())
                                                            <ul>
                                                                @foreach ($sub->subCategories as $sub2)
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
            <div class="col-md-8">
                <div class="rowprd" style="float: left">
                    <table>
                        <tbody>
                            @if (count($prds) == 0)
                                <div class="alert alert-info text-center m-0" role="alert">
                                    Không tìm thấy sản phẩm liên quan.
                                </div>
                            @else
                                @foreach ($prds as $prd)
                                    <div class='product'
                                        style="  width: 14em; min-width:14em;   height: 310px; position: relative;">

                                        <div class='product_inner'>
                                            @if ($prd->prd_sale != 0)
                                                <div>
                                                    <!-- <img src="/anh/sale-tag-icon.png" style="width: 38px;position: absolute;right: 0px; top:0px;"> -->

                                                    <p
                                                        style="padding-left:2px;background-color:red;position: absolute; left: 14px ; top: 28px;font-size:12px; font-weight:600;color:white;">
                                                        SALE {{ $prd->prd_sale }}%</p>
                                                </div>
                                            @endif

                                            <a style="border:none"
                                                href="{{ route('users.productdetail', ['id' => $prd->prd_id]) }}">
                                                <img style="width:200px" src='/anh/{{ $prd->prd_image }}'>
                                            </a>

                                            <p style="text-transform: uppercase;font-weight:600; padding-top:5px;">
                                                {{ $prd->prd_name }}
                                            </p>

                                        </div>
                                        <div
                                            style="text-align: center; position: absolute;top: 90%; left: 50%;transform: translate(-50%, -50%);">

                                            <p style="font-size:16px;margin-bottom: 0;font-weight:600;">Giá </p>

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
