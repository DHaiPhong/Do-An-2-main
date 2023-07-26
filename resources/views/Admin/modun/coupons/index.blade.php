@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 82%">
            <div class="card-body">
                <h2>Danh Sách Mã Giảm Giá</h2>
                <a class="badge badge-success" style="float: right; font-size: 20px"
                    href="{{ route('coupons.create') }}">Thêm</a>
                <div id="filter" style="display: flex; ">
                    <h4 style="margin-right: 1rem">Tìm Kiếm</h4>
                    <input type="text" id="search-box" onkeyup="searchFunction()">
                </div>
                <h3 id="no-results" style="display: none; color:red; margin-top: 1rem">Không có kết quả liên quan</h3>

                @if (session('success'))
                    <div style="margin-top: 1rem;" class="alert alert-success">
                        <span class="alert-text">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div style="margin-top: 1rem;" class="alert alert-danger">
                        <span class="alert-text">{{ session('error') }}</span>
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr style="align-items: center;">
                            <th scope="col"> ID </th>
                            <th scope="col" style="width: 16%"> Code </th>
                            <th scope="col" style="width: 16%"> Slug </th>
                            <th scope="col" style=""> Giảm </th>
                            <th scope="col"> Loại </th>
                            <th scope="col" style=""> Ngày Hết Hạn </th>
                            <th scope="col" style=""> Thời Gian Tạo </th>
                            <th scope="col" style=""> Thời Gian Cập Nhật </th>
                            <th scope="col" style=""> Quản Lý </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key => $coupon)
                            <tr scope="row">
                                <td scope="row">{{ ++$key }}</td>
                                <input type="hidden" value="{{ $coupon->id }} ">
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->slug }}</td>
                                <td>{{ number_format($coupon->amount) }}</td>
                                @if ($coupon->type == 'percent')
                                    <td>Phần Trăm</td>
                                @else
                                    <td>Số</td>
                                @endif
                                <td>{{ $coupon->expires_at }}</td>
                                <td>{{ $coupon->created_at }}</td>
                                <td>{{ $coupon->updated_at }}</td>
                                <td>
                                    <a href="{{ route('coupons.edit', $coupon->id) }}"
                                        class="btn btn-sm btn-primary">Sửa</a>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }} " method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')">Xóa</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $coupons->links() }}
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
