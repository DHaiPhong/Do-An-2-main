@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body" style="margin-bottom: 1rem">
                <h4 class="card-title">Product table</h4>
                <a class="badge badge-success" style="float: right; font-size: 20px" href="{{ route('admin.add') }}">Add</a>
                <select id="chon" onchange="myFunction()" style="float: right; font-size: 20px" class="form-select"
                    aria-label="Default select example">
                    <option>Order By</option>
                    <option>ID</option>
                    <option value="amount">Amount</option>
                    <option value="sold">Sold</option>
                    <option value="0">Sold Out</option>

                </select>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th style="width: 16%"> Product name </th>
                            <th style="width: 190px"> Image </th>
                            <th> Price </th>
                            <th style="width: 25%"> Detail </th>
                            <th style="width: 5%"> Size </th>
                            <th style="width: 5%"> Amount </th>
                            <th style="width: 5%"> Sold </th>
                            <th>On Sale </th>
                            <th style="width: 5%"> Edit </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->prd_detail_id }}</td>
                                <td>{{ $product->prd_name }}</td>

                                <td> <img src="/anh/{{ $product->prd_image }}" style="height:100px"> </td>
                                <td> {{ number_format($product->price) }} đ </td>
                                <td
                                    style="display: -webkit-box;
                                max-height: 5.9rem;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                white-space: normal;
                                line-height: 1.6rem;
                                ">
                                    {{ $product->prd_details }} </td>
                                <td> {{ $product->prd_size }}</td>
                                <td> {{ $product->prd_amount }} </td>
                                <td> {{ $product->sold }} </td>
                                <td> {{ $product->prd_sale }}% </td>
                                <td style="">
                                    <a href="{{ route('admin.prd_detail', ['id' => $product->prd_detail_id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i>
                                    </a>
                                </td>

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
