@extends('users.masterUser')
@section('css')
@stop
@section('content')
    <link href="{{ url('css/cartcss/cart.css') }}" rel="stylesheet" type="text/css">

    <div class="text-center">
        <section>
            <div class="small-container cart-page">

                <h1>Giỏ Hàng</h1>
                @if (session('success'))
                    <div class="alert alert-success text-center m-0" style="font-size: 2rem; margin-bottom: 1rem"
                        role="alert">
                        Thêm sản phẩm thành công!
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger text-center m-0" style="font-size: 2rem; margin-bottom: 1rem"
                        role="alert">
                        Lỗi sản phẩm đã hết hàng!
                    </div>
                @endif
                @if (count(Cart::content()))
                    <div class="row">
                        <div class="card col-md-9">
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
                                                    <a href="{{ route('cart.delete', ['id' => $item->rowId]) }}">Xóa</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->price) }} đ</td>
                                        <td>
                                            <input type="number" name="quantity"
                                                style="width: 100px; background-color: #eee"
                                                onchange="updateCart(this.value, '{{ $item->rowId }}')" max="10"
                                                value="{{ $item->qty }}">
                                        </td>
                                        <td>{{ $item->options->size }}</td>
                                        <td>{{ number_format($item->total) }} đ</td>
                                    </tr>
                                @endforeach

                            </table>
                            <a class="btn btn-danger" href="{{ route('cart.delete', ['id' => 'all']) }}"> Xóa Giỏ
                                Hàng
                            </a>
                        </div>
                        <div class="card col-md-3" style="width: 300px; margin-left: 1rem">
                            <h2>Thanh Toán</h2>
                            <div class="total-price">
                                <table>
                                    <form method="post" action="{{ route('users.payment') }}">
                                        @csrf
                                        <tr>
                                            <td>Tạm Tính</td>
                                            <td style="color: red">{{ number_format(Cart::total()) }} đ</td>
                                        </tr>

                                        <tr>
                                            <td>Tổng</td>
                                            <td style="color: red">{{ number_format(Cart::total()) }} đ
                                                <input name="total_price" type="hidden" value="5000">
                                                {{-- <input name="total_price" type="hidden"
                                    value="{{ Cart::total() - 15000 - Cart::total() * (5 / 100) }}"> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn"
                                                    style="background-color: orangered; width: 100%; color: #fff">
                                                    Thanh toán </button>
                                            </td>
                                        </tr>
                                        <form>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger text-center m-0" style="font-size: 2rem" role="alert">
                        Giỏ hàng của bạn <b> đang trống</b>.
                    </div>
                @endif
            </div>
        </section>
    </div>

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
