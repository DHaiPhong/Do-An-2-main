<section class="home" id="home">
    <div class="slide-container active">

        <a class="slide" style="background:white;color:none;text-decoration:none;" href="http://127.0.0.1:8000/product">
            <div class="content">

                <span>Giày Nike thể thao</span>
                <h3>Nike Jordan 1 High Đen Trắng</h3>

                <!-- <a href="#" class="btn">add to card</a> -->
            </div>
            <div class="image">
                <img src="{{asset('img/slide/giayslide.png')}}" class="shoe">
            </div>
        </a>

    </div>
    <div class="slide-container">
        <a class="slide" style="background:white;color:none;text-decoration:none;"
            href="http://127.0.0.1:8000/productdetail/79">
            <div class="content">
                <span>Nike Sport Shoes</span>
                <h3>Nike Jordan 1 Low Trắng Xám Đế Đen</h3>
                
                <!-- <a href="#" class="btn">add to card</a> -->
            </div>
            <div class="image">
                <img src="{{asset('img/slide/giayslide2.png')}}" class="shoe">
            </div>
        </a>
    </div>
    <div class="slide-container">
        <a class="slide" style="background:white;color:none;text-decoration:none;" href="http://127.0.0.1:8000/productdetail/67">
            <div class="content">
                <span>Nike Sport Shoes</span>
                <h3>Converse 1970s Đen Cao Cổ REP</h3>
                
                <!-- <a href="#" class="btn">add to card</a> -->
            </div>
            <div class="image">
                <img src="{{asset('img/slide/giayslide3.png')}}" class="shoe">
            </div>
        </a>
    </div>
    <div class="slide-container">
        <a class="slide" style="background:white;color:none;text-decoration:none;" href="http://127.0.0.1:8000/productdetail/71">
            <div class="content">
                <span></span>
                <h3>New Balance M5740 Đen Trắng</h3>
                
                <!-- <a href="#" class="btn">add to card</a> -->
            </div>
            <div class="image">
                <img src="{{asset('img/slide/giayslide4.png')}}" class="shoe">
            </div>
        </a>
    </div>

    <div id="prev" class="fa fa-angle-left" onclick="prev();"></div>

    <div id="next" class="fa fa-angle-right" onclick="next();"></div>
</section>