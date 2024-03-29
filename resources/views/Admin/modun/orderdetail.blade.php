@extends('Admin.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h4 style="margin-bottom: 0" class="">Chi Tiết Hóa Đơn</h4>
                <br>
                <div style="display:flex;">
                    <h5 style="margin-right: 1rem">Trạng Thái Đơn Hàng:</h5>
                    @if ($order_st)
                        <h5>
                            @if ($order_st->order_status == 'pending')
                                <p class="statusbox" style="background-color: #f7c821; width: 120px"> Đang Duyệt </p>
                            @elseif($order_st->order_status == 'processing')
                                <p class="statusbox" style="background-color: #2eaef8;width: 120px"> Đang Xử Lý </p>
                            @elseif($order_st->order_status == 'shipping')
                                <p class="statusbox" style="background-color: #00eeff; width: 120px"> Đang Giao Hàng </p>
                            @elseif($order_st->order_status == 'completed')
                                <p class="statusbox" style="background-color: #11e309;width: 120px"> Hoàn Thành </p>
                            @else
                                <p class="statusbox" style="background-color: #f05454;width: 120px"> Đã Hủy </p>
                            @endif
                        </h5>
                    @endif




                </div>
                @if ($order_st)
                    <p>Người đặt: {{ $order_st->name }}</p>
                    <p>Số điện thoại: {{ $order_st->phone_number }}</p>
                    <p>Địa chỉ: {{ $order_st->address }}</p>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th style="width: 20%"> Tên </th>
                            <th style=""> Hình Ảnh </th>
                            <th style=""> Số lượng </th>
                            <th> Giá </th>
                            <th style=""> Size </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td> {{ $order->id }} </td>
                                <td><a
                                        href="{{ route('admin.prd_detail', ['id' => $order->product_id]) }}">{{ $order->prd_name }}</a>
                                </td>
                                <td> <img src='/anh/{{ $order->prd_image }}' width="100px" height="auto"></td>
                                <td> {{ $order->quantity }}</td>
                                <td> {{ number_format($order->price) }}đ </td>
                                <td> {{ $order->prd_size }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($order_st)
                    <div>
                        <p>Tổng sản phẩm: {{ number_format($order_st->total) }} đ</p>
                        <p>Phí vận chuyển: {{ number_format($order_st->shipfee) }} đ</p>

                        @if ($order_st->type == 'fixed')
                            <p>Mã giảm giá: {{ $order_st->code }}</p>
                            <p>Giảm giá: {{ number_format($order_st->amount) }} đ</p>
                        @elseif($order_st->type == 'percent')
                            <p>Mã giảm giá: {{ $order_st->code }}</p>
                            <p>Giảm giá: {{ $order_st->amount }}%</p>
                            <p>Thành tiền: {{ number_format(($order_st->total * $order_st->amount) / 100) }} đ</p>
                        @else
                        @endif
                        <p>Tổng tiền: {{ number_format($order_st->grand_total) }} đ</p>
                    </div>
                @endif
                @if (Auth::user()->role == 'admin')
                    @if ($order->status == 'cancel')
                        <p class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem;">Đã Hủy</p>
                    @else
                        <a class="btn btn-primary btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'processing']) }}"> Xử Lý </a>
                        <a class="btn btn-info btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'shipping']) }}"> Giao Hàng
                        </a>
                        <a class="btn btn-success btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'completed']) }}"> Hoàn Thành
                        </a>
                        <a class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'cancel']) }}"> Hủy Đơn </a>
                    @endif
                @else
                    @if ($order->status == 'cancel')
                        <p class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem;">Đã Hủy</p>
                    @elseif($order->status == 'pending')
                        <a class="btn btn-primary btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'processing']) }}"> Xử Lý </a>
                    @elseif($order->status == 'processing')
                        <a class="btn btn-info btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'shipping']) }}"> Giao Hàng
                        </a>
                    @elseif($order->status == 'shipping')
                        <a class="btn btn-success btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'completed']) }}"> Hoàn Thành
                        </a>
                    @endif
                    @if (($order->status == 'pending') & ($order->status != 'cancel'))
                        <a class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem"
                            href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'cancel']) }}"> Hủy Đơn </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        var userRole = "{{ Auth::user()->role }}"; // get the user's role
    </script>
@endsection
