@extends('Admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="float: right; width: 80%">
            <div class="card-body">
                <h4 style="margin-bottom: 18px" class="card-title">Blog Category table</h4>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th style="width: 16%"> Title </th>
                            <th style=""> Slug </th>
                            <th> Description </th>
                            <th style="width: 25%"> Image </th>
                            <th style="width: 5%"> Status </th>
                            <th style=""> Manage </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($orders as $key => $order)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td> {{ $order->name }}</td>
                                <input type="hidden" value="{{ $order->id }} ">
                                <td>

                                    @if ($order->status == 'pending')
                                        <p class="statusbox" style="background-color: #f7c821;"> {{ $order->status }} </p>
                                    @elseif($order->status == 'processing')
                                        <p class="statusbox" style="background-color: #2eaef8;"> {{ $order->status }} </p>
                                    @elseif($order->status == 'completed')
                                        <p class="statusbox" style="background-color: #11e309;"> {{ $order->status }} </p>
                                    @else
                                        <p class="statusbox" style="background-color: #f05454;"> cancelled </p>
                                    @endif

                                </td>



                                <td> {{ $order->grand_total }} </td>

                                <td>
                                    {{ $order->address }}
                                </td>
                                <td> {{ $order->phone_number }} </td>
                                <td> {{ $order->item_count }} </td>
                                <td style=""><a href="{{ route('admin.orderdetail', ['id' => $order->order_id]) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                        </i></td>

                            </tr>
                        @endforeach --}}


                    </tbody>
                </table>
                {{-- {{ $orders->links() }} --}}
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
