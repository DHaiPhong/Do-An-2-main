@extends('users.masterUser')
@section('content')
    <link href="{{ url('css/paymentcss/payment.css') }}" type="text/css" rel="stylesheet">
    <section>
        <div class="containerpm">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="font-size:15px">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" id="myform" action="">
                    @csrf
                    <div class="row" style="font-size: 17px;">
                        <h3 style="font-size:22px; margin-bottom:0; text-align:center" class="title">NHẬP THÔNG TIN GIAO
                            HÀNG</h3>
                        <div class="col">
                            <div class="inputBox">
                                <span>Họ và tên :</span>
                                <input name="name" type="text" value="{{ Auth::user()->name }}" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                
                                <input name="email" type="email" value="{{ Auth::user()->email }}" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Thành phố :</span>
                                <select class="select_city" name="city" id="city">
                                </select>
                                
                            </div>

                        </div>

                        <div class="col">

                            <!-- <div class="inputBox">
                                                                                                                                <span>cards accepted :</span>
                                                                                                                                <img src="img/card_img.png" alt="">
                                                                                                                            </div> -->
                            <div class="inputBox">
                                <span>Địa chỉ nhà :</span>
                                <input name="address" type="text" value="{{ Auth::user()->address }}" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Số điện thoại :</span>
                                <input name="phone" id="phone_number" type="text" value="" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Quận Huyện :</span>
                                <select class="select_city" name="district" id="district">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">

                            <article class="card-body">
                                <dl class="dlist-align">

                                    <dt style="font-size: 15px; font-weight: bold ; text-wrap:nowrap;">Tiền vận chuyển : <span style="font-weight:100" id="ship" >20.000đ </span></dt>
                                    <dt style="font-size: 15px; font-weight: bold">Tông tiền : </dt>
                                    <dd class="text-right h4 b"> {{ number_format(Cart::total()) }} đ </dd>
                                </dl>
                            </article>
                        </div>
                    </div>
                    <h1> Phương thức thanh toán
                    </h1>
                    <div class="row" style="flex-wrap:nowrap">
                        <div class="col-md-6" style="width: 49%;">
                            <button type="button" id="btnCash" class="submit-btn">Tiền mặt</button>
                        </div>
                        <div class="col-md-6" style="width: 49%;">
                            <button type="button" id="btnOnline" class="submit-btn momo" name="payUrl">MOMO<br>(Thanh toán
                                Online)</button>
                            <input type="hidden" name="total_momo" value="{{ Cart::total() }}">
                        </div>
                    </div>
                    <input type="submit" class="giaohang" id="btnDelivery" value="Giao hàng" disabled>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
    $('#city').change(function() {
        if ($(this).val() === 'Thành phố Hà Nội') {
        $('#ship').text('20.000 đ');
        } else {
        $('#ship').text('30.000 đ');
        }
    });
    });
        // Access the input element
        var input = document.getElementById('phone_number');
        input.addEventListener('input', function() {
            if (this.value.includes("+")) {
                this.value = this.value.replace(/[^0-9+]/, '');
                if (this.value.length > 12) {
                    this.value = this.value.slice(0, 12);
                }
            } else {
                this.value = this.value.replace(/[^0-9]/, '');
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            }
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "city");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }

        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
            printResult();
        });

        /////////////////////////nut thanh toan /////////////////////////////
        document.getElementById('btnCash').addEventListener('click', function(event) {
            document.getElementById('btnCash').style.opacity = "1";
            document.getElementById('btnCash').style.border = "2px solid black";
            document.getElementById('btnOnline').style.opacity = "0.7";
            document.getElementById('btnOnline').style.border = "none";
            document.getElementById('myform').action = "{{ route('checkout.place.order') }}";
            document.getElementById('btnDelivery').disabled = false;
            document.getElementById('btnDelivery').style.background = "white";
        });

        document.getElementById('btnOnline').addEventListener('click', function(event) {
            document.getElementById('btnOnline').style.opacity = "1";
            document.getElementById('btnCash').style.opacity = "0.7";
            document.getElementById('btnCash').style.border = "none";
            document.getElementById('btnOnline').style.border = "2px solid black";
            document.getElementById('myform').action = "{{ route('checkout.online') }}";
            document.getElementById('btnDelivery').disabled = false;
            document.getElementById('btnDelivery').style.background = "white";

        });
    </script>
@stop
