@extends('users.masterUser')
@section('content')
    <link href="{{ url('css/paymentcss/payment.css') }}" type="text/css" rel="stylesheet">
    <section>
        <div class="containerpm">
            <div class="col-md-6">
                <form method="post" action="{{ route('checkout.place.order') }}">
                    @csrf
                    <div class="row">
                        <h3 class="title">Billing address</h3>
                        <div class="col">
                            <div class="inputBox">
                                <span>full name :</span>
                                <input name="name" type="text" value="{{ Auth::user()->name }}" placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>email :</span>
                                <input name="email" type="email" value="{{ Auth::user()->email }}" placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>city :</span>
                                <input name="city" type="text" value="" placeholder="">
                            </div>

                        </div>

                        <div class="col">

                            <!-- <div class="inputBox">
                                                                                                                            <span>cards accepted :</span>
                                                                                                                            <img src="img/card_img.png" alt="">
                                                                                                                        </div> -->
                            <div class="inputBox">
                                <span>address :</span>
                                <input name="address" type="text" value="{{ Auth::user()->address }}" placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Phone number :</span>
                                <input name="phone" type="text" value="{{ Auth::user()->phone }}" placeholder="">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">

                            <article class="card-body">
                                <dl class="dlist-align">
                                    <dt style="font-size: 12px; font-weight: bold">Total cost: </dt>
                                    <dd class="text-right h4 b"> {{ number_format(Cart::total()) }} đ
                                    </dd>
                                </dl>
                            </article>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="submit-btn"> PAY</button>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </form>
                <form action="{{ route('checkout.online') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_momo" value="{{ Cart::total() }}">
                    <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán qua
                        MOMO</button>
                </form>

            </div>

        </div>
    </section>

@stop
