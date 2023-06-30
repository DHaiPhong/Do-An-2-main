@extends('Admin.master')


@section('css')
    <link href="{{ asset('css/admincss/arlert.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h4 class="card-title">Product table</h4>
                <p class="card-description"> Add class
                </p>
                <a class="badge badge-success" style=" font-size: 20px" href="{{ route('admin.add_prd') }}">Add</a>
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
                <select id="chon" onchange="myFunction()" class="form-select" aria-label="Default select example">
                    <option>Order By</option>
                    <option>id</option>
                    <option value="amount">Amount</option>
                    <option value="sold">Sold</option>
                    <option value="0">sold out</option>

                </select>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%"> Id </th>
                            <th style="width: 16%"> Product name </th>
                            <th style="width: 220px"> Image </th>
                            <th> Price </th>
                            <th> Size </th>
                            <th> Amount </th>
                            <th> Sold </th>
                            <th>On Sale </th>
                            <th> Sua </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $product->prd_name }}</td>

                                <td> <img src="/anh/{{ $product->prd_image }}" style="height:120px"> </td>
                                <td> {{ number_format($product->price) }}đ </td>
                                <td> {{ $product->prd_size }} </td>


                                <td> {{ $product->prd_amount }} </td>
                                <td> {{ $product->sold }} </td>
                                <td @if ($product->prd_sale > 0) style="color: red" @endif> {{ $product->prd_sale }}%
                                </td>
                                <td style=""><a
                                        href="{{ route('admin.prd_detail', ['id' => $product->prd_detail_id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i></td>


                            </tr>
                        @endforeach


                    </tbody>

                </table>{{ $products->links() }}
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("chon").value;

            var url = "{{ route('admin.productorderby', ':id') }}";
            url = url.replace(':id', x);

            location.href = url;
        }
    </script>
@stop
