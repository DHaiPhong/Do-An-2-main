@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 86%">
            <div class="card-body">
                <h4 style="margin-bottom: 18px; margin-right: 20px" class="card-title">Blog Category Table</h4>
                <a class="badge badge-success" style="float: right; font-size: 20px"
                    href="{{ route('categories.create') }}">Add</a>
                {{-- <select id="chon" onchange="myFunction()" class="form-select" aria-label="Default select example">
                    <option>Order By</option>
                    <option value="">Show All</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancel">Canceled</option>
                </select> --}}
                @if (session('message'))
                    <div style="margin-top: 1rem;" class="alert alert-success">
                        <span class="alert-text">{{ session('message') }}</span>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr style="align-items: center;">
                            <th scope="col"> # </th>
                            <th scope="col" style="width: 16%"> Name </th>
                            <th scope="col" style=""> Parent </th>
                            <th scope="col"> Description </th>
                            <th scope="col" style=""> Manage </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr scope="row">
                                <td scope="row">{{ ++$key }}</td>
                                <input type="hidden" value="{{ $category->id }} ">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent_id && $category->parent ? $category->parent->name : '' }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }} " method="POST"
                                        class="d-inline">
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
