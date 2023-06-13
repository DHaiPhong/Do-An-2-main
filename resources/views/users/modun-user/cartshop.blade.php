@extends('users.masterUser')
@section('product')
@section('css')
@stop
<link href="{{url('css/cartcss/cart.css')}}" rel="stylesheet" type="text/css">


   <section>
    <div class="small-container cart-page" >
        <div class="" style=""><h3>Giỏ Hàng</h3></div>
    @if (count(Cart::content()))
        <table>
            <tr>
                <th style="width:40%">Product</th>
                <th>price</th>

                <th>Quantity</th>
                <th>color</th>
                <th>size</th>
                <th>Subtotal</th>

            </tr>
            @foreach (Cart::content() as $item)
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="/anh/{{$item->options->img  }}">
                        <div>
                            <p>{{ $item->name }}</p>
                            
                            <a href="{{route('cart.delete',['id'=> $item->rowId])}}">Remove</a>
                        </div>
                    </div>
                </td>
                <td>{{ number_format($item->price) }} đ</td>
                <td> <a href="{{route('cart.minus',['id'=> $item->rowId])}}" class="btnplusminus"><i class="fa-solid fa-circle-minus"></i></a> 
               
                {{ $item->qty }} 

                <a href="{{route('cart.plus',['id'=> $item->rowId])}}" class="btnplusminus" style="padding-left: 6px;padding-right: 5px;"><i class="fa-solid fa-circle-plus"></i></a></td>
                <td>{{ $item->options->color }}</td>
                <td>{{ $item->options->size }}</td>
                <td>{{ number_format( $item->total) }} đ</td>
            </tr>
            @endforeach
            
           
        </table>
        <div class="total-price" style=" justify-content: flex-start;     ">
            <table style="border-top: none;">
                
                <tr>
                    <td style="text-align: left;">
                        <a class="btn" href="{{route('cart.delete',['id'=> 'all'])}}"> Xóa Giỏ Hàng </a>
                    </td>
                    
                    
                </tr>
            </table>
        </div>
        <div class="total-price">
            <table>
                
                <tr>
                    <td>Total</td>
                    <td>{{ number_format(Cart::total())  }} đ</td>
                </tr>
                
                <tr>
                <td></td>
                <td > 
                    @auth                       
                    <a class="btn" style="background-color: #56e856" href="{{ route('users.payment') }}"> Thanh toán </a>
                    @endauth
                    @guest                       
                    <a class="btn" style="background-color: #56e856" href="{{ route('login') }}"> Thanh toán </a>
                    @endguest
</td>
             </tr>
            </table>
        </div>
       
        @else
                    <div class="alert alert-info text-center m-0" role="alert">
                        Your Cart is <b>empty</b>.
                    </div>
                    @endif
    </div>
   </section>
@stop
