@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 82%">
            <div class="card-body">
                <h2>Danh Sách Danh Mục</h2>
                <a class="badge badge-success" style="float: right; font-size: 20px"
                    href="{{ route('categories.create') }}">Thêm</a>
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
                            <th scope="col"> # </th>
                            <th scope="col" style="width: 16%"> Tên </th>
                            <th scope="col" style=""> Cha </th>
                            <th scope="col"> Slug </th>
                            <th scope="col" style=""> Quản Lý </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr scope="row">
                                <td scope="row">{{ ++$key }}</td>
                                <input type="hidden" value="{{ $category->id }} ">
                                <td>{{ $category->name }}</td>
                                @if ($category->parent_id == null)
                                    <td>Không có</td>
                                @else
                                    <td>{{ $category->parent_id && $category->parent ? $category->parent->name : '' }}</td>
                                @endif
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-primary">Sửa</a>
                                    <form action="{{ route('categories.destroy', $category->id) }} " method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("chon").value;
            var url = "{{ route('admin.orderorderby', ':id') }}";
            url = url.replace(':id', x);
            location.href = url;
        }
    </script>
@stop
@section('js')
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
