@extends('Admin.master')


@section('product')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card" style="float: right; width: 80%">
        <div class="card-body">
            <h4 class="card-title">Product table</h4>
            <p class="card-description"> Add class
            </p>
            <a class="badge badge-success" style=" font-size: 20px" href="{{route('admin.add_prd')}}">Them</a>
            
            <select id="chon" onchange="myFunction()" class="form-select" aria-label="Default select example">
                <option  >Order By</option>
                <option  >id</option>
                <option  value="amount">Amount</option>
                <option  value="sold">Sold</option>
                <option  value="0">sold out</option>
                
            </select>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%"> Id </th>
                        <th style="width: 16%"> Product name </th>
                        <th style="width: 220px"> Image </th>
                        <th> Price </th>
                        <th> Size </th>
                        
                        
                        <th > Amount </th>
                        <th > Sold </th>

                        <th>On Sale </th>
                        <th > Sua </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$product->prd_name}}</td>

                        <td> <img src="/anh/{{$product->prd_image}}" style="height:120px"> </td>
                        <td> {{$product->price}} </td>
                        <td> {{$product->prd_size}} </td>
                        
                        
                        <td> {{$product->prd_amount}} </td>
                        <td> {{$product->sold}} </td>
                        <td @if($product->prd_sale > 0 ) style="color: red" @endif > {{$product->prd_sale}}% </td>
                        <td style=""><a href="{{route('admin.prd_detail',['id'=> $product->prd_detail_id])}}">
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
