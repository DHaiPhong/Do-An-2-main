@extends('users.masterUser')

@section('content')

    <link href="{{ url('css/detailprdcss/detailprd.css') }}" rel="stylesheet" type="text/css">
    <section>

        <section class="featured" id="fearured">
            <h1 class="heading">Product <span>Details</span></h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <p style="font-size: 2rem">
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
                                                    <p style="font-size: 2.9rem;text-decoration: line-through;"> Price
                                                        {{ number_format($prd->price) }} đ</p>
                                                </div>
                                                <div style="margin-left:10px">
                                                    <p style="font-size: 2.9rem; color: red">
                                                        {{ number_format(($prd->price / 100) * (100 - $prd->prd_sale)) }}
                                                        đ</p>
                                                </div>
                                                <input type="hidden" name="price"
                                                    value="{{ ($prd->price / 100) * (100 - $prd->prd_sale) }}">
                                            </div>
                                        @else
                                            <p style="color:red;font-size: 2.9rem;"> Giá {{ number_format($prd->price) }}
                                                VND</p>
                                            <input type="hidden" name="price" value="{{ $prd->price }}">
                                        @endif

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
                                                <input type="hidden" id="slsize" name="prd_size" value="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="boxo" style="height:50px;border-radius: 8px; text-align: center;">
                                    <p id="stock_message" style="display:none;font-size:18px;">Sorry! This size is
                                        temporarily out of stock.</p>
                                </div>
                                <div class="btn-and-quantity-wrap"
                                    style="display: inline-block;margin-top: 1rem;border-radius: .5rem;border: .2rem solid #000;font-weight: bolder;font-size: 1.7rem;
                                color: #000;
                                cursor: pointer;
                                background: #fff;
                                padding: .8rem 3rem;">

                                    <div class="btn-and-quantity">

                                        <div quickbeam="add-to-cart">

                                            <button id="order_button" type="submit" href="">ADD TO CART</button>
                                        </div>
                                    </div>
                                </div>
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
                        <h2>Product quality?</h2>
                        <p>Products are always tested and evaluated by VNSneakers with the highest quality before reaching
                            customers!</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq2.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Delivery time?</h2>
                        <p>We use the most reputable and fastest shipping unit, the estimated time is from 1-4 days
                            depending on the area.</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq3.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Wrong product color?</h2>
                        <p>Due to some objective factors such as screen brightness, screen quality, the product may not be
                            the right color.</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq4.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Working time?</h2>
                        <p>The store system and Online work from 8:30 to 22:00 daily.</p>
                    </td>
                </tr>

            </table>
            <table class="table1">
                <tr>
                    <td class="image-column1"><img src="/anh/qq5.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Is the item available?</h2>
                        <p>Products are available at VNSneakers store system and online at website.</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq6.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>How to exchange goods?</h2>
                        <p>Exchanges are easy and we always want our customers to be satisfied. Please contact fanpage to
                            change!</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq7.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Product warranty</h2>
                        <p>The product is warranted for 30 days against any defects. SALE items are not warranted.</p>
                    </td>
                </tr>
                <tr>
                    <td class="image-column1"><img src="/anh/qq8.png" alt="placeholder"></td>
                    <td class="text-column1">
                        <h2>Wrong shoe size?</h2>
                        <p>You can go to the store or send it back for an exchange with a 100% new product. Still have tags
                            and purchase receipt.</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="background-color: orange;height: 2px;width: 40%; margin:0px 350px"> </div>
        <div class="title-content">
            Some other
            <span><b style="color: orange; font-size: 25px;">PRODUCT</b></span>

        </div>
        <div class="product-container">
            @foreach ($otherprd as $oprd)
                <div class="product"><a href="{{ route('users.productdetail', ['id' => $oprd->prd_id]) }}">
                        <img src="/anh/{{ $oprd->prd_image }}" alt="Product 1">
                        <a href="{{ route('users.productdetail', ['id' => $oprd->prd_id]) }}">{{ $oprd->prd_name }} </a>
                        <div style=" height: 30px"></div>
                        <p>{{ number_format($oprd->price) }} VND</p>
                    </a>
                </div>
            @endforeach
        </div>


    </section>




    <!-- Quickbeam cart-->



    <!-- Quickbeam cart end -->
    </section>
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
                indexx = imgNb - 5

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
@stop
