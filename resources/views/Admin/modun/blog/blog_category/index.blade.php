@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 86%">
            <div class="card-body">
                <h4 style="margin-bottom: 18px; margin-right: 20px" class="card-title">Blog Category Table</h4>
                <a class="badge badge-success" style="float: right; font-size: 20px"
                    href="{{ route('admin.blog.category.add') }}">Add</a>
                <select id="chon" onchange="myFunction()" class="form-select" aria-label="Default select example">
                    <option>Order By</option>
                    <option value="">Show All</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancel">Canceled</option>
                </select>
                @if (session('message'))
                    <div style="margin-top: 1rem;" class="alert alert-success">
                        <span class="alert-text">{{ session('message') }}</span>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr style="align-items: center;">
                            <th scope="col"> # </th>
                            <th scope="col" style="width: 16%"> Title </th>
                            <th scope="col" style=""> Slug </th>
                            <th scope="col"> Description </th>
                            <th scope="col" style="width: 25%"> Image </th>
                            <th scope="col" style="width: 5%"> Status </th>
                            <th scope="col" style=""> Manage </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category_blogs as $key => $category_blog)
                            <tr scope="row">
                                <td scope="row">{{ ++$key }}</td>
                                <input type="hidden" value="{{ $category_blog->id }} ">
                                <td> {{ $category_blog->title }} </td>
                                <td>
                                    {{ $category_blog->slug }}
                                </td>
                                <td> {{ $category_blog->description }} </td>
                                <td>
                                    @if ($category_blog->image)
                                        <img src="{{ asset('storage/images/' . $category_blog->image) }}"
                                            alt="{{ $category_blog->title }}" width="auto" height="150" maxwidth="250">
                                    @endif
                                </td>
                                <td>
                                    @if ($category_blog->status == '1')
                                        <span class="badge bg-success" style="font-size: 1rem;">Active</span>
                                    @elseif($category_blog->status == '0')
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog.category.edit', $category_blog->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.blog.category.destroy', $category_blog->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                {{ $category_blogs->links() }}
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
