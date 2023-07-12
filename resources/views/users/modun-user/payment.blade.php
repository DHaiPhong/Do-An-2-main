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
                                <span>Email :</span>
                                <input name="email" type="email" value="{{ Auth::user()->email }}" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Thành phố :</span>
                                <select class="select_city" name="city" id="city" onchange="getSelectedOptionId()">
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <div class="inputBox">
                                <span>Địa chỉ nhà :</span>
                                <input name="address" type="text" value="{{ Auth::user()->address }}" required
                                    placeholder="">
                            </div>
                            <div class="inputBox">
                                <span>Số điện thoại :</span>
                                <input name="phone" id="phone_number" type="text" value="{{ Auth::user()->phone }}"
                                    required placeholder="sô điện thoại">
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
                                    <dt style="font-size: 1.8rem; font-weight: bold ; text-wrap:nowrap;">Tiền vận chuyển :
                                        <span style="font-weight:100" id="ship">Chọn tỉnh thành trước </span>
                                    </dt>
                                    @if (session('type') == 'fixed')
                                        <dt style="font-size: 1.8rem; font-weight: bold ; text-wrap:nowrap;">Giảm Giá :
                                            <span style="font-weight:100"
                                                id="ship">{{ number_format(session('amount')) }}
                                                đ</span>
                                        </dt>
                                        <dt style="font-size: 1.8rem; font-weight: bold">Tổng tiền : </dt>
                                        <dd class="text-right h3 b" id="totalht">
                                            {{ number_format(Cart::total() - session('amount')) }} đ </dd>
                                        <input type="hidden" id="total" name="total"
                                            value="{{ Cart::total() - session('amount') }}">
                                    @elseif(session('type') == 'percent')
                                        <dt style="font-size: 1.8rem; font-weight: bold ; text-wrap:nowrap;">Giảm Giá :
                                            <span style="font-weight:100"
                                                id="ship">{{ number_format(session('amount')) }}
                                                %</span>
                                        </dt>
                                        <dt style="font-size: 1.8rem; font-weight: bold">Tổng tiền : </dt>
                                        <dd class="text-right h3 b" id="totalht">
                                            {{ number_format(Cart::total() - (Cart::total() * session('amount')) / 100) }}
                                            đ </dd>
                                        <input type="hidden" id="total" name="total"
                                            value="{{ Cart::total() - (Cart::total() * session('amount')) / 100 }}">
                                    @endif
                                    <input type="hidden" name="coupon_amount" value="{{ session('amount') }}">
                                    <input type="hidden" name="coupon_type" value="{{ session('type') }}">
                                    <input type="hidden" id="shipp" name="ship" value="">
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
                            <button type="button" id="btnOnline" class="submit-btn momo" name="payUrl">MOMO<br>(Thanh
                                toán
                                Online)</button>
                            <input type="hidden" name="coupon" value="{{ session('amount') }}">
                            <input type="hidden" name="total_momo" value="{{ Cart::total() - session('amount') }}">
                        </div>
                    </div>
                    <input type="submit" class="giaohang" id="btnDelivery" value="Giao hàng" disabled>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
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
    <script>
        function numberFormat(value) {
            return new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'VND'
            }).format(value);
        }

        function getSelectedOptionId() {
            var selectElement = document.getElementById("city");
            var selectedOptionId = selectElement.options[selectElement.selectedIndex].getAttribute("data-id");
            var total = document.getElementById("total");

            console.log(selectedOptionId);
            if (selectedOptionId == 1) {
                document.getElementById("ship").textContent = "20.000";
                var ttotal = parseInt(total.value) + 20000;
                document.getElementById("totalht").textContent = numberFormat(ttotal);
                document.getElementById("shipp").value = 20000;
            } else if (selectedOptionId > 1 && selectedOptionId <= 40) {
                document.getElementById("ship").textContent = "35.000";
                var ttotal = parseInt(total.value) + 35000;
                document.getElementById("totalht").textContent = numberFormat(ttotal);
                document.getElementById("shipp").value = 35000;
            } else if (selectedOptionId > 40 && selectedOptionId <= 56) {
                document.getElementById("ship").textContent = "45.000";
                var ttotal = parseInt(total.value) + 45000;
                document.getElementById("totalht").textContent = numberFormat(ttotal);
                document.getElementById("shipp").value = 45000;
            } else if (selectedOptionId > 56) {
                document.getElementById("ship").textContent = "55.000";
                var ttotal = parseInt(total.value) + 55000;
                document.getElementById("totalht").textContent = numberFormat(ttotal);
                document.getElementById("shipp").value = 55000;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-success').click(function(e) {
                e.preventDefault();

                var coupon = $('input[name=code]').val();

                $.ajax({
                    type: 'GET',
                    url: '{{ route('applyCoupon') }}',
                    data: {
                        code: coupon
                    },
                    success: function(data) {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            // Cập nhật thông tin giá trị mã giảm giá, tiền giảm, tổng tạm...
                            alert('Áp dụng mã giảm giá thành công!');
                            location.reload();
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        alert("Sai mã giảm giá. Hoặc mã đã hết hạn!");
                    }
                });
            });
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
