@extends('users.masterUser')

@section('productdetail')

    <link href="{{ url('css/detailprdcss/detailprd.css') }}" rel="stylesheet" type="text/css">
    <section>

        <section class="featured" id="fearured">
            <h1 class="heading">Product <span>Details</span></h1>
            <div class="row">
                <div class="image-container">
                    <div class="boxx" >
                    <div class="small-image">
                        
                        @foreach ($prdimg as $primg)
                        <img src="/anh/{{ $primg->img }}" alt=""
                            class="featured-image-1" id = "pic">
                    @endforeach
                   
                    </div>
                     <button id="leftb" class="slide-left" onclick="next1()">&#8250;</button>
                    <button id="rightb" class="slide-right" onclick="pre1()">&#8249;</button>
                    </div>
                    

                    <div class="big-image">
                        <img src="/anh/{{ $primg->img }}" alt="" class="big-image-1">
                    </div>
                </div>
                <div class="content">
                    
                        <!-- ------------------------------------ -->
                        <div class="right-col">
                            <h1 itemprop="name">{{$prd->prd_name}}</h1>
                            <h4 style="width: 440px;    text-align: justify;">{{$prd->prd_details}}</h4>
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <meta itemprop="priceCurrency" content="USD">
                                <link itemprop="availability" href="http://schema.org/InStock">
                                <form method="post" action="{{route('cart.add')}}">

                                    @csrf
                                <div class="price-shipping">
                                    <div class="price" id="price-preview" quickbeam="price" quickbeam-price="800">
                                        @if($prd->prd_sale !=0)
                                        <div style="display:flex">
                                            <div>
                                                <p style="font-size: 2.9rem;text-decoration: line-through;"> Price
                                                    {{number_format($prd->price)}} đ</p>
                                            </div>
                                            <div style="margin-left:10px">
                                                <p style="font-size: 2.9rem; color: red">
                                                    {{number_format($prd->price / 100 * (100-$prd->prd_sale))}}
                                                    đ</p>
                                            </div>
                                            <input type="hidden" name="price" value="{{$prd->price / 100 * (100-$prd->prd_sale)}}">
                                        </div>

                                        @else
                                        <p style="font-size: 2.9rem;"> Giá {{number_format($prd->price)}} đ</p>
                                        <input type="hidden" name="price" value="{{$prd->price}}">

                                        @endif

                                    </div>
                                </div>


                                
                                    <input type="hidden" name="prd_id" value="{{$prd->prd_id}}">


                                    <div class="swatches">
                                        <div class="swatch clearfix">

                                            <div class="header">Size</div>
                                            <select class="form-control" name="prd_size" id="example FormControlSelect2"
                                                style="margin-top: 10px;width: 4rem;height: 3rem;font-size: 1.7rem; border: 0.2rem solid;"
                                                name="size">
                                                @foreach($prdsize as $prdsize)

                                                <option value="{{$prdsize->prd_size}}">
                                                    {{$prdsize->prd_size}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="swatch clearfix" style="font-size: 1.8rem" data-option-index="1">
                                            <div class="header" style="margin-left: 10px">Color</div>

                                            @foreach($products as $product)

                                            <input type="radio" class="boxcolor" name="prd_color"
                                                value="{{$product->prd_color}}" checked> {{$product->prd_color}}
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="btn-and-quantity-wrap" style="display: inline-block;
                            margin-top: 1rem;
                            border-radius: .5rem;
                            border: .2rem solid #000;
                            font-weight: bolder;
                            font-size: 1.7rem;
                            color: #000;
                            cursor: pointer;
                            background: #fff;
                            padding: .8rem 3rem;">
                                <div class="btn-and-quantity">
        
                                    <div quickbeam="add-to-cart">
        
                                        <button id="AddToCart" type="submit" href="">ADD TO CART</button>
                                </form>

                            </div>
                        </form>
                        </div>               
                </div>
              
            </div>
        </section>

    </section>



    <!-- Quickbeam cart-->



    <!-- Quickbeam cart end -->
</section>
<script>
const imgPositon = document.querySelectorAll(".small-image img")
    // console.log(imgPositon)
    const imgContaine = document.querySelector(".small-image")
    console.log(imgPositon)

    let imgNb = imgPositon.length
    let indexx = 0
    

    function next1(){
        indexx++;
        if (indexx >= imgNb - 5) {
            indexx = 0
        }
        if(indexx < imgNb - 5 ){
        slider(indexx)
    }}
    function pre1(){
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

</script>
@stop

