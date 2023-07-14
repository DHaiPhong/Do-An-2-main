@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 82%">
            <div class="card-body">
                <h2>Danh Sách Đánh Giá</h2>
                {{-- <a class="badge badge-success" style="float: right; font-size: 20px"
                    href="{{ route('comments.create') }}">Thêm</a> --}}
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
                            <th scope="col" style="width: 16%"> Tên người gửi </th>
                            <th scope="col" style=""> Bình Luận </th>
                            <th scope="col" style="width: 30%"> Sản Phẩm </th>
                            <th scope="col"> Ngày đánh giá </th>
                            <th scope="col" style=""> Quản Lý </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $comment)
                            @if ($comment->parent_id == '')
                                <tr scope="row">
                                    <td scope="row">{{ ++$key }}</td>
                                    <input type="hidden" value="{{ $comment->id }} ">
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->comment }}
                                        <br>
                                        <span style="color: red">Trả Lời:</span>
                                        <ul style="color: blue">
                                            @foreach ($comments as $key => $comm_reply)
                                                @if ($comm_reply->parent_id == $comment->id)
                                                    <li style="list-style-type: decimal">{{ $comm_reply->comment }}
                                                        - bởi {{ $comm_reply->user->name }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <br>
                                        <textarea class="form-controll reply-comment" id="reply-comment-{{ $comment->id }}" cols="30" rows="3"></textarea>
                                        <br>
                                        <button class="btn btn-success btn-reply-comment"
                                            data-product_id="{{ $comment->product_id }}"
                                            data-comment_id="{{ $comment->id }}">Trả Lời</button>
                                    </td>
                                    <td><a
                                            href="{{ route('users.productdetail', $comment->product->slug) }}">{{ $comment->product->prd_name }}</a>
                                    </td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <a href="{{ route('comments.edit', $comment->id) }}"
                                            class="btn btn-sm btn-primary">Sửa</a>
                                        <form action="{{ route('comments.destroy', $comment->id) }} " method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">Xóa</button>
                                        </form>
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $comments->links() }}
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
    <script>
        $(document).off('click', '.btn-reply-comment').on('click', '.btn-reply-comment', function() {

            var comment_id = $(this).data('comment_id');
            var product_id = $(this).data('product_id');
            var comment = $('#reply-comment-' + comment_id).val();

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/reply-comment/') }}",
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // ADD THIS LINE
                    product_id: product_id,
                    comment: comment,
                    comment_id: comment_id,
                },
                success: function(data) {
                    location.reload();
                    $('#reply-comment-' + comment_id).val('');
                },
            });
        });
    </script>
@endsection
