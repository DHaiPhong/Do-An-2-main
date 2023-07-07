@extends('users.masterUser')

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
                        <img src="/anh/{{ $primg->prd_image }}" alt="" style="width:90px" class="featured-image-1"
                            id="pic">
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
                                                data-quantity="{{ $prdsize->prd_amount }}" onclick="checkStock(this)">
                                                {{ $prdsize->prd_size }}
                                            </div>
                                            @endforeach
                                            <input type="hidden" id="slsize" name="prd_size" value="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="boxo" style="height:50px;border-radius: 8px; text-align: center;">
                                <p id="stock_message" style="display:none;font-size:18px;">Size này đã hết hàng</p>
                            </div>

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
                                                    <p>Bạn hãy đặt túi đựng viên chống ẩm vào bên trong giày để hút
                                                        ẩm
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
        </div>
    </section>
    <div style="flex-wrap:wrap;padding:10px 50px;" class="d-flex justify-content-center">
        <table class="table1">
            <tr>
                <td class="image-column1"><img src="/anh/qq1.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Chất lượng sản phẩm?</h2>
                    <p>Sản phẩm luôn được VNSneakers kiểm tra và đánh giá chất lượng cao nhất trước khi đạt
                        khách hàng!</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq2.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Thời gian giao hàng?</h2>
                    <p>Chúng tôi sử dụng đơn vị vận chuyển uy tín nhất, nhanh nhất, thời gian ước tính từ 1-4 ngày
                        tùy thuộc vào khu vực.</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq3.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Màu sắc sản phẩm sai?</h2>
                    <p>Do một số yếu tố khách quan như độ sáng màn hình, chất lượng màn hình nên sản phẩm có thể không
                        được như ý.
                        đúng màu.</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq4.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Thời gian làm việc?</h2>
                    <p>Hệ thống cửa hàng và Online làm việc từ 8h30 đến 22h hàng ngày.</p>
                </td>
            </tr>

        </table>
        <table class="table1">
            <tr>
                <td class="image-column1"><img src="/anh/qq5.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Hàng có sẵn không?</h2>
                    <p>Sản phẩm có bán tại hệ thống cửa hàng VNSneakers và online tại website.</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq6.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Đổi hàng như thế nào?</h2>
                    <p>Trao đổi rất dễ dàng và chúng tôi luôn muốn khách hàng hài lòng. Vui lòng liên hệ fanpage để
                        thay đổi!</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq7.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Bảo hành sản phẩm</h2>
                    <p>Sản phẩm được bảo hành 30 ngày đối với bất kỳ lỗi nào. Hàng SALE không bảo hành.</p>
                </td>
            </tr>
            <tr>
                <td class="image-column1"><img src="/anh/qq8.png" alt="placeholder"></td>
                <td class="text-column1">
                    <h2>Cỡ giày sai?</h2>
                    <p>Bạn có thể đến cửa hàng hoặc gửi lại để đổi với sản phẩm mới 100%. Vẫn còn thẻ
                        và hóa đơn mua hàng.</p>
                </td>
            </tr>
        </table>
    </div>
    <div style="background-color: orange;height: 2px; margin:0px 350px"> </div>
    <div class="title-content">
        Sản phẩm
        <span><b style="color: orange; font-size: 25px;">Khác</b></span>

    </div>
    <div class="d-flex justify-content-center">
        @foreach ($otherprd as $oprd)
        <div class="product" style="max-width:21em"><a
                href="{{ route('users.productdetail', ['id' => $oprd->prd_id]) }}">
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
                    href="{{ route('users.productdetail', ['id' => $oprd->prd_id]) }}">{{ $oprd->prd_name }} </a>
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

    const slsize = parseInt(size.getAttribute("data-size"))
    document.getElementById("slsize").value = slsize;


}
</script>
@endsection