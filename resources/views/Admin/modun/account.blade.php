@extends('Admin.master')

@section('content')
    <div class="card" style="float: right; width: 80%">
        <div class="card-body" style="">
            <h2>Danh Sách Tài Khoản</h2>
            <div id="filter" style="display: flex; ">
                <h4 style="margin-right: 1rem">Tìm Kiếm</h4>
                <input type="text" id="search-box" onkeyup="searchFunction()">
            </div>
            <table class="table">
                <thead>
                    <tr class="account-tr">
                        <th>Id</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Role</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <h3 id="no-results" style="display: none; color:red; margin-top: 1rem">Không có kết quả liên quan</h3>
                    @foreach ($user1 as $key => $user)
                        @if ($user->status == 0)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->role == 2)
                                        <p class="badge badge-danger">Admin</p>
                                    @elseif ($user->role == 1)
                                        <p class="badge badge-warning">Editor</p>
                                    @else
                                        <p class="badge badge-success">Người Dùng</p>
                                    @endif
                                </td>
                                <td style="padding-left: 48px"><a class="check-permission"
                                        href="{{ route('account.detail', ['id' => $user->id]) }}"><i
                                            class="fa fa-pencil-square-o " aria-hidden="true" width="50px"></i></td>

                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
