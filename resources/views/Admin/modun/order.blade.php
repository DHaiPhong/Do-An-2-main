@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h2 style="margin-bottom: 18px" class="card-title">Danh Sách Đơn Hàng</h2>

                <select id="chon" onchange="myFunction()" class="form-select"
                    style="margin-left: 1rem; margin-bottom: 1rem" aria-label="Default select example">
                    <option hidden >Order By</option>
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

                <table id="productTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th style="width: 16%"> Số Đơn Hàng </th>
                            <th style="width: 10%; text-align: center"> Trạng Thái </th>
                            <th style="text-align: center"> Giá </th>
                            <th style="width: 23%"> Địa Chỉ </th>
                            <th style="width: 9%"> Số Điện Thoại </th>
                            <th style="width: 5%; text-align: center;"> Số Lượng </th>
                            <th style="width: 7%; text-align: center;"> Người Chỉnh sửa </th>
                            <th style="text-align: center"> Thời Gian Mua </th>
                            <th style="text-align: center"> Thời Gian Cập Nhật </th>
                            <th style="align-item: center"> Chi Tiết </th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @foreach ($orders as $key => $order)
                            <tr class="bangcu">
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
                                <td>{{ $order->address }}</td>
                                <td> {{ $order->phone_number }} </td>
                                <td> {{ $order->item_count }} </td>
                                <td style="text-align: center"> {{ $order->editname }} </td>
                                <td> {{ $order->created_at }}</td>
                                <td> {{ $order->updated_at }}</td>
                                <td style="text-align: center"><a style="text-align: center"
                                        href="{{ route('admin.orderdetail', ['id' => $order->id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="display:flex" id="pagination"></div>
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
        

        // Calculation for total pages
        var table = $('.bangcu');
        console.log(table)
        var currentPage = 1;
        var totalRows = table.length;
        var totalPages = Math.ceil(totalRows / 8);
    
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
      var startIndex = (page - 1) * 8;
      var endIndex = Math.min(startIndex + 8, totalRows);
    
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
              }else if(value === ""){
                $("#no-results").hide();
                $("#pagination").show();
                displayPage(currentPage);
              }
               else {
                $("#no-results").hide();
                $("#pagination").hide();
              }
     }); 
     
     
    
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
