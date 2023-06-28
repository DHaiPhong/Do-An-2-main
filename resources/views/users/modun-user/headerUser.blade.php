<section>
    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="{{ url('') }}" class="logo">
            <img src="{{ asset('img/pnglogoSneaker.png') }}" height="77px" width="auto">
        </a>
        <nav style="flex:3 ;justify-content: space-around;" class="navbar">
            <a href="{{ url('') }}">HOME</a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">SHOP</a>
                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" style="width: 110px" href="{{ route('users.product') }}">Product</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" style="width: 110px" href="{{ url('/product/1') }}">NIKE</a></li>
                    <li><a class="dropdown-item" style="width: 110px" href="{{ url('/product/2') }}">ADIDAS</a></li>
                    <li><a class="dropdown-item" style="width: 110px" href="{{ url('/product/3') }}">PUMA</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">Blog</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="width: 120px" href="{{ route('users.blogs') }}">News</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    
                    {{-- https://shoegazing.com/topics/ --}}
                </ul>
            </li>
            <a href="{{ route('users.product') }}">ABOUT</a>
            <a href="{{ route('users.product') }}">BLOG</a>
        </nav>
        <div style="flex:2" class="search-container">
        <form action="{{ route('search') }}" method="GET">
  <input id="searchInput" type="text" name="query" placeholder="Search...">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
<ul id="suggestionList" class="suggestion-list"></ul>
</div>
        <div class="icons">
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a style="font-size: 2rem; margin-right:14px; background:none"
                                href="{{ route('users.cartshop') }}">{{ Cart::count() }}<i
                                    class="fa fa-shopping-cart"></i></a>

                        </div>
                        @auth
                            <div class="col-sm" style="">
                                <li class="nav-item dropdown">
                                    <button class="dropdown-toggle"
                                        style="font-size: 2rem;  background:none;    text-transform: uppercase;"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }} <i class="fa fa-user"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-white">
                                        <li><a class="dropdown-item" style="margin-left:0"
                                                href="{{ route('users.order') }}">Account</a></li>
                                        <form method="post" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"> <a class="dropdown-item"
                                                    style="margin-left:0">Logout</a>
                                            </button>
                                        </form>
                                    </ul>
                                </li>
                            </div>
                        @endauth
                        @guest
                            <div class="col-sm">
                                <a href="{{ route('login') }}" class="login_btn"> Login </a>
                            </div>
                            <div class="col-sm">
                                <a href="{{ route('register') }}" class="signup_btn" style="color: white; "> Signup </a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>
</section>
<script>
   document.getElementById('searchInput').addEventListener('input', function () {
        let query = this.value;
        console.log(query);
        if (query.length > 2) {
            fetch('/suggestions?query=' + query)
                .then(response => response.json())
                .then(data => {
                    let suggestionList = document.getElementById('suggestionList');
                    suggestionList.innerHTML = '';

                    data.forEach(item => {
                        let suggestionItem = document.createElement('li');
                        suggestionItem.classList.add('suggestion-item');

                        let prdImage = document.createElement('img');
                        prdImage.classList.add('suggestion-img');
                        prdImage.src = 'anh/'+ item.prd_image;
                        suggestionItem.appendChild(prdImage);

                        let prdName = document.createElement('p');
                        prdName.textContent = item.prd_name;
                        suggestionItem.appendChild(prdName);

                        let prdPrice = document.createElement('span');
                        prdPrice.textContent = '$' + item.price;
                        prdPrice.textContent = formatPrice(item.price) +'VND';
                        suggestionItem.appendChild(prdPrice);

                        suggestionItem.addEventListener('click', function () {
                            document.getElementById('searchInput').value = item.prd_name;
                            suggestionList.style.display = 'none';
                        });

                        suggestionList.appendChild(suggestionItem);
                    });

                    suggestionList.style.display = 'block';
                });
        } else {
 document.getElementById('suggestionList').style.display = 'none';
        }
    });
    function formatPrice(price) {
  return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
    </script>