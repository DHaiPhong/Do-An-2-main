@extends('Admin.master')
@section('orderdetail')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card" style="float: right; width: 80%">
        <div class="card-body">
            <h4 style="margin-bottom: 18px" class="card-title">Order table</h4>
            
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th style="width: 20%"> name </th>
                        <th style=""> image </th>
                        <th style=""> amount </th>
                        <th> Price </th>
                        <th style=""> size </th>
                        <th style=""> color </th>
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td> {{$order->id}} </td>
                        <td>{{$order->prd_name}}</td>
                        <td> <img src='/anh/{{$order->prd_image}}' width="100px" height="auto"></td>
                        <td> {{$order->quantity}}</td>
                        
                        
                        
                        
                        
                        <td> {{$order->price}} </td>
                        <td> {{$order->prd_size}} </td>
                        <td> {{$order->prd_color}}</td>
                        
                        

                    </tr>
                @endforeach
                
                    
                </tbody>

                
            </table>
            @if($order-> status == 'cancel')
            
            @elseif($order-> status == 'pending')
            <a class="btn btn-info btn-fw" href="{{ route('admin.updatestatus', [ 'id'=> $order->order_id,'processing']) }}"> Processing </a>
            
            @elseif($order-> status == 'processing')
            <a class="btn btn-success btn-fw" href="{{ route('admin.updatestatus', [ 'id'=> $order->order_id,'completed']) }}" > Completed </a>
            @elseif($order-> status == 'completed')
            
            @endif
        </div>
    </div>
</div>
@stop