@extends('Admin.master')


@section('css')
    <link href="{{ asset('css/admincss/arlert.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h2 class="card-title">Danh Sách Sản Phẩm</h2>
                <div class="container" style="display: flex">
                    <select id="chon" onchange="myFunction()" class="form-select" style="float: right"
                        aria-label="Default select example">
                        <option>Sort by</option>
                        <option>Id</option>
                        <option value="amount">Số lượng</option>
                        <option value="sold">Số lượng đã bán</option>
                    </select>
                    <a class="badge badge-success" style="margin-left: 1rem; font-size: 20px; float: right"
                        href="{{ route('admin.add_prd') }}">Thêm</a>
                </div>

                @if (session('Notification'))
                    <div style="position: fixed;right: 20px;top: 70px; "id="myDiv" class="alert alert-danger">

                        {{ session('Notification') }}

                    </div>
                @endif
                @if (session('success'))
                    <div style="position: fixed;right: 20px;top: 70px; "id="myDiv" class="alert alert-success">

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
                            <th style="width: 5%"> Id </th>
                            <th style="width: 16%"> Tên </th>
                            <th style="width: 220px"> Hình Ảnh </th>
                            <th> Giá </th>
                            <th> Danh Mục</th>
                            <th> Size </th>
                            <th> Giảm </th>
                            <th> Sửa </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $product->prd_name }}</td>
                                <td> <img src="/anh/{{ $product->prd_image }}" style="height:120px"> </td>
                                <td> {{ number_format($product->price) }}đ </td>
                                <td> {{ $product->category }}</td>
                                <td>{!! $product->new_prd_details !!}</td>
                                <td @if ($product->prd_sale > 0) style="color: red" @endif> {{ $product->prd_sale }}%
                                </td>
                                <td style="">
                                    <a href="{{ route('admin.prd_detail', ['id' => $product->prd_detail_id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

@stop
@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("chon").value;

            var url = "{{ route('admin.productorderby', ':id') }}";
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
