@extends('users.masterUser')

@section('content')

    <section style="margin-top: 5rem; font-size: 1.5rem">
        <h1 style="    text-align: center"> Search Result</h1>
        <div class='rowsb'>
            <ul class="mcd-menu">
                <li class="float">
                    <a class="search">
                        <form method="get" role="search" action="{{ url('search') }}">
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
                    <a href="{{ route('users.product') }}">

                        <strong>SNEAKERS</strong>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/product/1') }}">

                        <strong>NIKE</strong>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/product/2') }}">

                        <strong>ADIDAS</strong>
                    </a>
                </li>


                <li>
                    <a href="{{ url('/product/3') }}">

                        <strong>PUMA</strong>

                    </a>

                </li>


            </ul>
        </div>
        <div class='rowprd'>
            @if (count($searchproducts) == 0)
                <div style="
    width: 680px;
    height: 300px;
    text-align: center;
    padding-top: 100px;
">
                    <h3> Không thể tìm sản phẩm tương ứng</h3>
                </div>
            @else
                <table>
                    <tbody>

                        @foreach ($searchproducts as $prd)
                            <div class='product' style=" width:25em;   height: 360px; position: relative;">

                                <div class='product_inner'>
                                    @if ($prd->prd_sale != 0)
                                        <div>
                                            <img src="/anh/sale-tag-icon.png"
                                                style="width: 33px;position: absolute;right: 30px;">

                                            <p style="position: absolute;right: 55px;color:red;padding-top:15px;">
                                                -{{ $prd->prd_sale }}%</p>
                                        </div>
                                    @endif
                                    <a style="border:none"
                                        href="{{ route('users.productdetail', ['id' => $prd->prd_id]) }}">
                                        <img src='/anh/{{ $prd->prd_image }}'>
                                    </a>

                                    <p style="">{{ $prd->prd_name }}</p>

                                </div>
                                <div
                                    style="text-align: center; position: absolute;bottom: 20px;top:75%; left: 50%;transform: translate(-50%, -50%);">

                                    <p style=";margin-bottom: 0;">Price </p>

                                    @if ($prd->prd_sale != 0)
                                        <div style="display:flex">
                                            <div>
                                                <p style="color:red;margin-bottom: 0;text-decoration: line-through;">
                                                    {{ number_format($prd->price) }} đ</p>
                                            </div>
                                            <div style="margin-left:10px">
                                                <p style=" color: red">
                                                    {{ number_format(($prd->price / 100) * (100 - $prd->prd_sale)) }}
                                                    đ</p>
                                            </div>
                                        </div>
                                    @else
                                        <p style="color:red;margin-bottom: 0;">{{ number_format($prd->price) }} đ</p>
                                    @endif

                                    <br>


                                    <a class="btn" type="button" style="margin-top:-14px;"
                                        href="{{ route('users.productdetail', ['id' => $prd->prd_id]) }}">Detail</a>
                                    </p>
                                </div>


                            </div>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <section>
            <div class='rowprd'>
                {{ $searchproducts->links() }}

            </div>
        </section>
    </section>
@stop
