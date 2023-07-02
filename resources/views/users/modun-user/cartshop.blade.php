@extends('users.masterUser')
@section('css')
@stop
@section('content')
    <link href="{{ url('css/cartcss/cart.css') }}" rel="stylesheet" type="text/css">


    <section>
        <div class="small-container cart-page">
            <h1>Giỏ Hàng</h1>
            @if (session('success'))
                <div class="alert alert-success text-center m-0" style="font-size: 2rem; margin-bottom: 1rem" role="alert">
                    Thêm sản phẩm thành công!
                </div>
            @endif
            @if (count(Cart::content()))
                <table style="margin-top: 1rem">
                    <tr>
                        <th style="width:40%">Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Size</th>
                        <th>Tổng</th>
                    </tr>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <img src="/anh/{{ $item->options->img }}">
                                    <div>
                                        <p>{{ $item->name }}</p>
                                        <a href="{{ route('cart.delete', ['id' => $item->rowId]) }}">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ number_format($item->price) }} đ</td>
                            <td>
                                <input type="number" name="quantity" style="width: 100px"
                                    onchange="updateCart(this.value, '{{ $item->rowId }}')" max="10"
                                    value="{{ $item->qty }}">
                            </td>
                            <td>{{ $item->options->size }}</td>
                            <td>{{ number_format($item->total) }} đ</td>
                        </tr>
                    @endforeach


                </table>
                <div class="total-price" style=" justify-content: flex-start;     ">
                    <table style="border-top: none;">

                        <tr>
                            <td style="text-align: left;">
                                <a class="btn btn-danger" href="{{ route('cart.delete', ['id' => 'all']) }}"> Xóa Giỏ Hàng
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="total-price">
                    <table>
                        <tr>
                            <td>Tạm Tính</td>
                            <td style="color: red">{{ number_format(Cart::total()) }} đ</td>
                        </tr>
                        <tr>
                            <td>Phí Ship</td>
                            <td style="color: red">15.000 đ</td>
                        </tr>
                        <tr>
                            <td>Giảm Giá</td>
                            <td style="color: red">5%</td>
                        </tr>
                        <tr>
                            <td>Tổng</td>
                            <td style="color: red">{{ number_format(Cart::total() - 15000 - Cart::total() * (5 / 100)) }} đ
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @auth
                                    <a class="btn" style="background-color: orangered; width: 100%; color: #fff"
                                        href="{{ route('users.payment') }}">
                                        Thanh toán </a>
                                @endauth
                                @guest
                                    <a class="btn" style="background-color: orangered; width: 100%; color: #fff"
                                        href="{{ route('login') }}"> Thanh
                                        toán
                                    </a>
                                @endguest
                            </td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center m-0" style="font-size: 2rem" role="alert">
                    Giỏ hàng của bạn <b> trống</b>.
                </div>
            @endif
        </div>
    </section>
@stop
@section('js')
    <script>
        function updateCart(qty, rowId) {
            $.get(
                '{{ route('cart.update') }}', {
                    qty: qty,
                    rowId: rowId
                },
                function() {
                    location.reload();
                }
            );
        }
    </script>
@endsection
