@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h2 style="margin-bottom: 18px" class="card-title">Danh Sách Đơn Hàng</h2>

                <select id="chon" onchange="myFunction()" class="form-select"
                    style="margin-left: 1rem; margin-bottom: 1rem" aria-label="Default select example">
                    <option>Order By</option>
                    <option value="">Tất cả</option>
                    <option value="pending">Đang Duyệt</option>
                    <option value="processing">Đang Xử Lý</option>
                    <option value="completed">Hoàn Thành</option>
                    <option value="cancel">Đã Hủy</option>
                </select>
                @if (session('error'))
                    <div id="myDiv" class="alert alert-danger">

                        {{ session('error') }}

                    </div>
                @endif
                @if (session('success'))
                    <div id="myDiv" class="alert alert-success">

                        {{ session('success') }}

                    </div>
                @endif
                <div id="filter" style="display: flex; margin-top: 1rem; margin-bottom: 1rem; ">
                    <h4 style="margin-right: 1rem">Tìm Kiếm</h4>
                    <input type="text" id="search-box" onkeyup="searchFunction()">
                </div>
                <h3 id="no-results" style="display: none; color:red; margin-top: 1rem">Không có kết quả liên quan</h3>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th style="width: 16%"> Số Đơn Hàng </th>
                            <th style="width: 10%"> Trạng Thái </th>
                            <th> Giá </th>
                            <th style="width: 25%"> Địa Chỉ </th>
                            <th style="width: 9%"> Số Điện Thoại </th>
                            <th style="width: 5%; text-align: center;"> Số Lượng </th>
                            <th> Ngày Mua </th>
                            <th style="align-item: center"> Chi Tiết </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td> {{ $order->order_number }}</td>
                                <input type="hidden" value="{{ $order->id }} ">
                                <td>
                                    @if ($order->status == 'pending')
                                        <p class="statusbox" style="background-color: #f7c821; width: 120px"> Đang Duyệt
                                        </p>
                                    @elseif($order->status == 'processing')
                                        <p class="statusbox" style="background-color: #2eaef8;width: 120px"> Đang Xử Lý </p>
                                    @elseif($order->status == 'shipping')
                                        <p class="statusbox" style="background-color: #00eeff; width: 120px"> Đang Giao Hàng
                                        </p>
                                    @elseif($order->status == 'completed')
                                        <p class="statusbox" style="background-color: #11e309;width: 120px"> Hoàn Thành </p>
                                    @else
                                        <p class="statusbox" style="background-color: #f05454;width: 120px"> Đã Hủy </p>
                                    @endif
                                </td>
                                <td> {{ number_format($order->grand_total) }}đ </td>
                                <td>
                                    {{ $order->address }}
                                </td>
                                <td> {{ $order->phone_number }} </td>
                                <td> {{ $order->item_count }} </td>
                                <td> {{ $order->updated_at }}</td>
                                </td>
                                <td style=""><a href="{{ route('admin.orderdetail', ['id' => $order->order_id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>{{ $orders->links() }}
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("chon").value;
            var url = "{{ route('admin.orderorderby', ':id') }}";
            url = url.replace(':id', x);
            location.href = url;
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#search-box").on("keyup", function() {
                var value = $(this).val().toLowerCase();

                var visibleRows = $("table tbody tr").filter(function() {
                    var match = $(this).text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(match);
                    return match;
                }).length;

                if (visibleRows === 0) {
                    $("#no-results").show();
                } else {
                    $("#no-results").hide();
                }
            });
        });
    </script>
@endsection
