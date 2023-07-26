@extends('Admin.master')


@section('css')
<link href="{{ asset('css/admincss/arlert.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card" style="float: right; width: 80%">
        <div class="card-body">
            <h2 class="card-title">Danh Sách Sản Phẩm</h2>
            <div>
                <form class="container" style="display: flex" method="post"
                    action="{{ route('admin.productorderby' ) }}">
                    @csrf
                    <select id="chon" name="sort" class="form-select" style="float: right"
                        aria-label="Default select example">
                        <option hidden value="">Sắp xếp</option>
                        <option value="">tất cả</option>
                        <option value="quantity-desc">Số lượng giảm dần</option>
                        <option value="quantity-asc">Số lượng tăng dần</option>
                        <option value="sold-desc">Số lượng đã bán giảm dần</option>
                        <option value="sold-asc">Số lượng đã bán tăng dần</option>
                        <option value="price-asc">Giá tăng dần</option>
                        <option value="price-desc">Giá giảm dần</option>
                        <option value="view">Sản phẩm có lượt xem nhiều</option>
                        <option value="sale">Sản phẩm sale</option>
                        
                    </select>
                    <select id="chon" name="filter" class="form-select" style="float: right"
                        aria-label="Default select example">
                        <option value="all" hidden>Danh Mục</option>
                        <option value="all">tất cả</option>
                        @foreach($cats as $cat )
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit"> Sắp Xếp </button>
                </form>
            </div>

            @if (session('Notification'))
            <div style="position: fixed;right: 20px;top: 70px; " id="myDiv" class="alert alert-danger">

                {{ session('Notification') }}

            </div>
            @endif
            @if (session('success'))
            <div style="position: fixed;right: 20px;top: 70px; " id="myDiv" class="alert alert-success">

                {{ session('success') }}

            </div>
            @endif
            <div id="filter" style="display: flex; margin-top: 1rem; margin-bottom: 1rem; ">
                <h4 style="margin-right: 1rem">Tìm Kiếm</h4>
                <input type="text" id="search-box">
                <a class="badge badge-success"
                    style="margin-left: 1rem; font-size: 20px;position: absolute; right: 20px; padding:10px"
                    href="{{ route('admin.add_prd') }}">Thêm Sản phẩm</a>
            </div>
            <h3 id="no-results" style="display: none; color:red; margin-top: 1rem">Không có kết quả liên quan</h3>

            <table id="productTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%"> Id </th>
                        <th style="width: 16%"> Tên </th>
                        <th style="width: 220px"> Hình Ảnh </th>
                        <th> Giá </th>
                        <th> Danh Mục</th>
                        <th> Size </th>
                        <th> Giảm </th>
                        
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach ($products as $key => $product)
                    <tr class="bangcu">
                        <td>{{ ++$key }}</td>
                        <td>{{ $product->prd_name }}</td>
                        <td> <img src="/anh/{{ $product->prd_image }}" style="height:120px"> </td>
                        <td> {{ number_format($product->price) }}đ </td>
                        <td> {{ $product->category }}</td>
                        <td>{!! $product->new_prd_details !!}</td>
                        <td @if ($product->prd_sale > 0) style="color: red" @endif> {{ $product->prd_sale }}%
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination"></div>

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
// Calculation for total pages
var table = $('.bangcu');
console.log(table)
var currentPage = 1;
var totalRows = table.length;
var totalPages = Math.ceil(totalRows / 6);

// Clear the pagination links
$('#pagination').empty();

// Create the pagination links
for (var i = 1; i <= totalPages; i++) {
    var link = $('<a class="page-link" href="javascript:void(0);"></a>').text(i);
    link.attr('data-page', i); // Set the 'data-page' attribute
    console.log(link);
    $('#pagination').append(link);
}

// Display the rows for the first page
displayPage(currentPage);

// Handle click event for pagination links
$('.page-link').on('click', function() {
    var page = $(this).attr('data-page'); // Retrieve the 'data-page' attribute

    if (page === currentPage) {
        return;
    }

    displayPage(page);
});

// Function to display rows for the given page
function displayPage(page) {
    // Update current page
    currentPage = page;

    // Hide all rows
    $('#productTableBody tr').hide();

    // Calculate the index range for the selected page
    var startIndex = (page - 1) * 6;
    var endIndex = Math.min(startIndex + 6, totalRows);

    // Display the rows for the selected page
    for (var i = startIndex; i < endIndex; i++) {
        $('#productTableBody tr:eq(' + i + ')').show();
    }
}



$("#search-box").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    var visibleRows = $("table tbody tr").filter(function() {

        var match = $(this).text().toLowerCase().indexOf(value) > -1;
        $(this).toggle(match);

        return match;
    }).length;

    if (visibleRows === 0) {
        $("#no-results").show();
        $("#pagination").hide();
    } else if (value === "") {
        $("#no-results").hide();
        $("#pagination").show();
        displayPage(currentPage);
    } else {
        $("#no-results").hide();
        $("#pagination").hide();
    }
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection