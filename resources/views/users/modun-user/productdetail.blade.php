@extends('users.masterUser')
@section('css')
<link href="{{ url('css/productcss/prd.css') }}" rel="stylesheet" type="text/css">

@stop
@section('content')

    <link href="{{ url('css/detailprdcss/detailprd.css') }}" rel="stylesheet" type="text/css">
    <section>

        <section class="featured" id="fearured">
            <h1 class="heading">Chi Tiết <span>Sản Phẩm</span></h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <p style="font-size: 2rem; margin-top: 5px">
                                    {{ $error }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="image-container">
                    <div class="boxx">
                        <div class="small-image">
                            @foreach ($prdimg as $primg)
                                <img src="/anh/{{ $primg->prd_image }}" alt="" style="width:90px"
                                    class="featured-image-1" id="pic">
                            @endforeach

                        </div>

                        <button id="leftb" class="slide-left" onclick="next1()">&#8250;</button>
                        <button id="rightb" class="slide-right" onclick="pre1()">&#8249;</button>
                    </div>



                    <div class="big-image">
                        <img src="/anh/{{ $primg->prd_image }}" alt="" class="big-image-1">
                    </div>
                </div>
                <div class="content">

                    <!-- ------------------------------------ -->
                    <div class="right-col">
                        <h1 style="font-size:33px" itemprop="name">{{ $prd->prd_name }}</h1>

                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="priceCurrency" content="USD">
                            <link itemprop="availability" href="http://schema.org/InStock">
                            <form method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <div class="price-shipping">
                                    <div class="price" id="price-preview" quickbeam="price" quickbeam-price="800">

                                        @if ($prd->prd_sale != 0)
                                            <div style="display:flex">


                                                <div>
                                                    <p style="font-size: 2.9rem;color:black"> Giá: <span
                                                            style="font-size: 2.9rem;text-decoration: line-through; color:gray">
                                                            {{ number_format($prd->price) }} VND <span></p>

                                                </div>
                                                <div style="margin-left:10px">
                                                    <p style="font-size: 2.5rem; color: red;">
                                                        {{ number_format(($prd->price / 100) * (100 - $prd->prd_sale)) }}
                                                        đ</p>
                                                </div>
                                                <input type="hidden" name="price"
                                                    value="{{ ($prd->price / 100) * (100 - $prd->prd_sale) }}">
                                            </div>
                                        @else
                                            <p style="color:black;font-size: 2.9rem;"> Giá: <span
                                                    style="color:red;font-size: 2.9rem;text-decoration:none">{{ number_format($prd->price) }}
                                                    VND</span>
                                            </p>

                                            <input type="hidden" name="price" value="{{ $prd->price }}">
                                        @endif
                                        <p>Lượt xem: {{ $prd->views }}</p>




                                    </div>
                                </div>
                                <input type="hidden" name="prd_id" value="{{ $prd->prd_id }}">
                                <div class="swatches">
                                    <div class="swatch clearfix" style="font-size: 1.8rem" data-option-index="1">
                                        <div class="size-selection">
                                            <h3>Chọn Size:</h3>
                                            <div class="sizes">
                                                @foreach ($prdsize as $prdsize)
                                                    <div class="size" data-size="{{ $prdsize->prd_size }}"
                                                        data-quantity="{{ $prdsize->prd_amount }}"
                                                        onclick="checkStock(this)">
                                                        {{ $prdsize->prd_size }}
                                                    </div>
                                                @endforeach

                                            </div>
                                            <p style="display:none" id="qt-size">0</p>
                                            <input type="hidden" id="slsize" name="prd_size" value="">
                                            <div style="display:none" id="quantity-container" class="quantity-container">
                                                <button type="button" class="quantity-btn minus">-</button>
                                                <input style="display:block;padding-left:13px" class="quantity-input"
                                                    id="qtinput" name="quantity" type="number" min="1"
                                                    max="10" readonly value="0">
                                                <button type="button" class="quantity-btn plus">+</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="boxo" style="height:50px;border-radius: 8px; text-align: center;">
                                    <p id="stock_message" style="display:none;font-size:18px;">Size này đã hết hàng</p>
                                </div>
                                <ul class="list-inline" style="display: flex">
                                    @for ($count = 1; $count <= 5; $count++)
                                        @php
                                            if ($count <= $rating) {
                                                $color = 'color: #ffcc00;';
                                            } else {
                                                $color = 'color: #ccc;';
                                            }
                                        @endphp
                                        <li class="rating"
                                            style="cursor:pointer; font-size: 3rem; {{ $color }} margin-bottom: 2rem; margin-right: 0.5rem; margin-top: 2rem"
                                            title="Đánh Giá" id="{{ $prd->prd_id }}-{{ $count }}"
                                            data-index="{{ $count }}" data-product_id="{{ $prd->prd_id }}"
                                            data-rating="{{ $rating }}">
                                            &#9733;
                                        </li>
                                    @endfor
                                    <p style="margin-top: 1.3rem">{{ $rating_count }} lượt đã đánh giá </p>
                                </ul>
                                <div class="btn-and-quantity-wrap">
                                    <button id="order_button" type="submit">Mua Ngay</button>
                                </div>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" style="margin-bottom: 0.5rem">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne"
                                                style="font-size: 2rem">
                                                Chính Sách Giao Hàng & Đổi Trả
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>Giao hàng hoàn toàn miễn phí 100%</p>
                                                <p>An toàn với nhận hàng và trả tiền tại nhà</p>
                                                <p>Bảo hành đổi trả trong vòng 60 ngày</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo"
                                                style="font-size: 2rem">
                                                Hướng dẫn bảo quản
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    <h2>Khử mùi bên trong giày</h2>

                                                    <li>
                                                        <p>Bạn hãy đặt túi đựng viên chống ẩm vào bên trong giày để hút ẩm
                                                            và rắc phấn rôm (có thể thay bằng cách đặt vào bên trong
                                                            giày
                                                            gói trà túi lọc chưa qua sử dụng) để khử mùi, giúp giày luôn
                                                            khô
                                                            thoáng.
                                                            Để hạn chế mùi hôi và sự ẩm ướt cho giày, hãy chọn vớ chân
                                                            loại
                                                            tốt, có khả năng thấm hút cao. Ngoài ra, dùng các loại lót
                                                            giày
                                                            khử mùi
                                                            cũng là một phương pháp tốt.</p>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <h2>Bảo quản giày khi không sử dụng</h2>

                                                    <li>
                                                        <p>Khi sử dụng giày, bạn đừng vội vứt hộp đi mà hãy cất lại để
                                                            dành.
                                                            Khi
                                                            không sử dụng, hãy nhét một ít giấy vụn vào bên trong giày
                                                            để
                                                            giữ
                                                            cho
                                                            dáng giày luôn chuẩn, đẹp. Sau đó đặt giày vào hộp bảo quản
                                                            cùng
                                                            túi
                                                            hút
                                                            ẩm.
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <button type="button" class="btn btn-danger">
                            Tổng Đài Bán Hàng: <span class="badge bg-Warning" style="font-size: 1.5rem">123456789</span>
                        </button>
                        </form>
                    </div>
                </div>

            </div>

        </section>

        <div style="background-color: orange;height: 2px; margin:0px 350px"></div>
        <div class="title-content">
            Đánh
            <span><b style="color: orange; font-size: 25px;">Giá</b></span>
        </div>
        <style>
            .col-md-12 .icon {
                display: inline-block;
                margin-right: 10px;
            }

            .style-comment {
                border: 1px solid #000;
                border-radius: 5px;
                width: 65%;
                margin-left: 1rem
            }

            .style-comment .col-md-12 p {
                margin: 1rem;
            }
        </style>
        <form action="">
            @csrf
            <input type="hidden" name="prd_id" class="product_id" value="{{ $prd->prd_id }}">

            <div class="container mt-5">
                <div class="row d-flex justify-content-center" style="margin-left: ' . $offset . '; font-size: 2rem">
                    <div class="col-md-8">
                        <div class="headings d-flex justify-content-between align-items-center mb-3">
                            <p>Bình luận ({{ $commentCount }})</p>
                        </div>
                        <div id="comment_show"></div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: justify; margin-top: 1rem; margin-left: 1rem;">Đánh Giá
                    <span><b style="color: orange; font-size: 25px;">Sản Phẩm</b></span>
                </h1>
            </div>
            <style>
                .comment_content {
                    border: 1px solid #000;
                    border-radius: 5;
                    height: 100px;
                    width: 100%;
                    margin-left: 1rem;
                    font-size: 1.8rem;
                    padding: 1rem;
                }
            </style>
            <div class="col-md-8">
                <div class="comment-form">
                    <form action="#">
                        @csrf
                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                        <input type="hidden" name="user_id" class="user_id"
                            value="{{ Auth::check() ? Auth::user()->id : '' }}">
                        <input type="hidden" name="prd_id" class="product_id" value="{{ $prd->prd_id }}">

                        <textarea class="comment_content" name="content" placeholder="Nhập bình luận"></textarea>
                        @if (auth()->check())
                            <button style="margin-left: 1rem; margin-bottom: 1rem; display: inline-block;" type="button"
                                class="btn btn-success send-comment">Đăng</button>
                            <h2 style="margin-left: 1rem; display: inline-block; color: red" class="logged-in-as">Bình
                                luận với tài
                                khoản:
                                {{ auth()->user()->name }}</h2>
                        @else
                            <button style="margin-left: 1rem; margin-bottom: 1rem; display: inline-block;" disabled
                                type="submit" class="btn btn-success">Đăng</button>
                            <h2 style="margin-left: 1rem; display: inline-block; color: red" class="not-logged-in">Bạn
                                chưa đăng nhập. Hãy đăng nhập để đánh giá sản phẩm.
                            </h2>
                        @endif
                        <div id="notify_comment"></div>
                    </form>
                </div>
            </div>
        </div>
        <div style="background-color: orange;height: 2px; margin:0px 350px"></div>
        <div class="title-content">
            Sản phẩm
            <span><b style="color: orange; font-size: 25px;">Khác</b></span>

        </div>
        <div class="d-flex justify-content-center">
            @foreach ($otherprd as $oprd)
                <div class="product" style="max-width:21em"><a
                        href="{{ route('users.productdetail', ['id' => $oprd->slug]) }}">
                        @if ($oprd->prd_sale != 0)
                            <div>
                                <!-- <img src="/anh/sale-tag-icon.png" style="width: 38px;position: absolute;right: 0px; top:0px;"> -->

                                <p
                                    style="padding-left:2px;background-color:red;position: absolute; left: 8px ; top: 18px;font-size:12px;bottom:unset; font-weight:600;color:white;">
                                    SALE {{ $oprd->prd_sale }}%</p>
                            </div>
                        @endif
                        <img src="/anh/{{ $oprd->prd_image }}" alt="Product 1">
                        <a style="font-size:16px;line-height: 1.1;"
                            href="{{ route('users.productdetail', ['id' => $oprd->slug]) }}">{{ $oprd->prd_name }} </a>
                        <div style=" height: 30px"></div>
                        @if ($oprd->prd_sale != 0)
                            <div style="text-wrap: nowrap;">
                                <p
                                    style="color:gray;margin-bottom: 0;text-decoration: line-through;font-size:15px;position: absolute; left: 12px;">
                                    {{ number_format($oprd->price) }}đ<span
                                        style="margin-left: 10px; margin-bottom: 0;color: red;font-size:15px;">{{ number_format(($oprd->price / 100) * (100 - $oprd->prd_sale)) }}đ</span>
                                </p>
                            </div>
                        @else
                            <p style="color:red;margin-bottom: 0;font-size:15px;">
                                {{ number_format($oprd->price) }} đ
                            </p>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>


    </section>

@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        //Đánh Giá Sao
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');

            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var rating = $(this).data('rating');

            remove_background(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        // import Swal from 'sweetalert2';
        $(document).on('click', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('insert-rating') }}",
                type: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token,
                },
                success: function(data) {
                    if (data == 'done') {
                        Swal.fire({
                            title: 'Thành Công!',
                            text: 'Bạn đã đánh giá ' + index + ' sao thành công!',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            customClass: {
                                title: 'swal-title-class',
                                content: 'swal-content-class',
                                confirmButton: 'swal-button-class',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Lỗi! Đánh giá thất bại',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            customClass: {
                                title: 'swal-title-class',
                                content: 'swal-content-class',
                                confirmButton: 'swal-button-class',
                            }
                        });
                    }
                },
                error: function(error) {
                    var message = error.responseJSON.error;
                    Swal.fire({
                        title: 'Lỗi!',
                        text: message,
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        customClass: {
                            title: 'swal-title-class',
                            content: 'swal-content-class',
                            confirmButton: 'swal-button-class',
                        }
                    });
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            // alert(product_id);
            load_comment();

            function load_comment() {
                var product_id = $('.product_id').val();

                var _token = $('input[name="_token"]').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('/load-comment') }}",
                    data: {
                        product_id: product_id,
                        token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }
            $('.send-comment').click(function() {

                var product_id = $('.product_id').val();
                var user_id = $('.user_id').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();

                // alert(product_id)
                // alert(user_id)
                // alert(comment_content)
                // alert(_token)
                $.ajax({
                    type: "POST",
                    url: "{{ url('/send-comment') }}",
                    data: {
                        product_id: product_id,
                        user_id: user_id,
                        comment_content: comment_content,
                        token: _token
                    },
                    success: function(data) {
                        $('#notify-comment').html(
                            '<p class="text text-success">Thêm bình luận thành công! </p>');
                        load_comment();
                        $('.comment_content').val('');
                    },
                    error: function(error) {
                        var message = error.responseJSON.error;
                        alert(message);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Khi nút "Trả Lời" được bấm
            $(document).on('click', '.reply-btn', function(e) {
                // Đặt biến $replyBox là đối tượng div.reply-box gần nhất của nút được bấm
                var $replyBox = $(this).closest('.row').find('.reply-box');

                // Kiểm tra nếu reply box đang hiển thị thì ẩn nó, ngược lại hiển thị
                if ($replyBox.is(":visible")) {
                    $replyBox.hide();
                } else {
                    $replyBox.show();
                }
            });
            $(document).on('click', '.reply-submit', function(e) {
                e.preventDefault();

                var product_id = $('.product_id').val();
                var user_id = $(this).data('user_id');
                var comment_id = $(this).data('comment_id');
                var reply_content = $('.reply_content_' + comment_id).val();
                var _token = $('input[name="_token"]').val();

                // alert(product_id)
                // alert(user_id)
                // alert(comment_id)
                // alert(reply_content)
                // alert(_token)
                $.ajax({
                    type: "POST",
                    url: "{{ url('/replycomment') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product_id: product_id,
                        reply_content: reply_content,
                        comment_id: comment_id,
                        user_id: user_id,
                    },
                    success: function(data) {
                        location.reload();
                        $('.reply_content_' + comment_id).val('');
                    },
                    error: function(error) {
                        var message = error.responseJSON.error;
                        alert(message);
                    }
                });
            });
        });
    </script>
    <script>
        const imgPositon = document.querySelectorAll(".small-image img")
        // console.log(imgPositon)
        const imgContaine = document.querySelector(".small-image")

        const nextb = document.querySelector(".slide-left")
        const preb = document.querySelector(".slide-right")

        let imgNb = imgPositon.length
        let indexx = 0

        if (imgNb <= 5) {
            nextb.style.display = "none"
            preb.style.display = "none"
        }

        function next1() {
            indexx++;

            if (indexx >= imgNb - 5) {
                indexx = 0
            }
            if (indexx < imgNb - 5) {
                slider(indexx)
            }

        }

        function pre1() {
            indexx--;
            if (indexx <= 0) {
                indexx = 0
            }
            slider(indexx)
        }
        // nxt[index].addEventListener("click", function imgslide() {

        // } ) 
        function slider(indexx) {
            imgContaine.style.top = "-" + indexx * 20 + "%"

        }

        function checkStock(size) {

            const sizes = document.getElementsByClassName("size");
            var x = sizes.length

            for (let i = 0; i <= length + x - 1; i++) {

                sizes[i].classList.remove("selected");
            }

            size.classList.add("selected");
            const quantity = parseInt(size.getAttribute("data-quantity"));

            document.getElementById("stock_message").style.display = quantity === 0 ? "block" : "none";
            document.getElementById("boxo").style.border = quantity === 0 ? "2px solid red" : "none";
            document.getElementById("order_button").disabled = quantity === 0;
            document.getElementById("qt-size").textContent = "Số lượng còn: " + quantity;
            document.getElementById("qt-size").style.display = "block";
            document.getElementById("quantity-container").style.display = "flex";

            const qtinput = document.getElementById("qtinput")
            qtinput.value = 1;
            qtinput.max = quantity;

            const slsize = parseInt(size.getAttribute("data-size"))
            document.getElementById("slsize").value = slsize;


        }
    </script>
    <script>
        const minusBtn = document.querySelector('.minus');
        const plusBtn = document.querySelector('.plus');
        const quantityInput = document.querySelector('.quantity-input');
        const qtinput = document.getElementById("qtinput")

        // Xử lý sự kiện khi nhấn nút "-"
        minusBtn.addEventListener('click', function() {
            // Lấy giá trị hiện tại từ input và chuyển đổi thành số
            let currentQuantity = parseInt(quantityInput.value);

            // Kiểm tra giá trị số lượng nếu lớn hơn 0 thì giảm đi 1
            if (currentQuantity > 1) {
                currentQuantity--;
            }

            // Cập nhật giá trị số lượng mới vào input
            quantityInput.value = currentQuantity;
        });

        // Xử lý sự kiện khi nhấn nút "+"
        plusBtn.addEventListener('click', function() {
            // Lấy giá trị hiện tại từ input và chuyển đổi thành số
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < qtinput.max) {
                // Tăng giá trị số lượng lên 1
                currentQuantity++;

                // Cập nhật giá trị số lượng mới vào input
                quantityInput.value = currentQuantity;
            }
        });
    </script>
@endsection
