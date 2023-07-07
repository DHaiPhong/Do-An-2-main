@extends('Admin.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h4 style="margin-bottom: 18px" class="card-title">Chi Tiết Hóa Đơn</h4>
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
                @if ($order->status == 'cancel')
                    <p class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem;">Đã Hủy</p>
                @elseif($order->status == 'pending')
                    <a class="btn btn-primary btn-fw check-permission" style="margin-top: 1rem"
                        href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'processing']) }}"> Xử Lý </a>
                @elseif($order->status == 'processing')
                    <a class="btn btn-info btn-fw check-permission" style="margin-top: 1rem"
                        href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'shipping']) }}"> Giao Hàng </a>
                @elseif($order->status == 'shipping')
                    <a class="btn btn-success btn-fw check-permission" style="margin-top: 1rem"
                        href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'completed']) }}"> Hoàn Thành </a>
                @endif
                @if ($order->status != 'cancel' && $order->status != 'completed')
                    <a class="btn btn-danger btn-fw check-permission" style="margin-top: 1rem"
                        href="{{ route('admin.updatestatus', ['id' => $order->order_id, 'cancel']) }}"> Hủy Đơn </a>
                @endif
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        var userRole = "{{ Auth::user()->role }}"; // get the user's role

        $(document).ready(function() {
            // all buttons and a tags that need permission checking
            var elements = document.querySelectorAll("a.check-permission");

            for (var i = 0; i < elements.length; i++) {
                // Ensure the click event is only attached once
                if (!elements[i].hasAttribute('data-click-bound')) {
                    elements[i].addEventListener("click", function(e) {
                        // check editor's permission
                        if (userRole == "editor") {
                            e.preventDefault();
                            alert("Bạn không có quyền thực hiện chức năng này");
                        }
                    });
                    elements[i].setAttribute('data-click-bound', 'true');
                }
            }
        });
    </script>
@endsection
