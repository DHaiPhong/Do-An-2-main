<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li>
            <a>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black" style="margin-top: 7px">{{Auth::user()->name}}</p>
                </div>
            </a>
        </li>
        <li class="nav-item">
        
            <a class="nav-link" href="#">
                <form method="post" action="{{route('logout')}}">
            @csrf
            <button type="submit" style="    border: none;background: none;"> <i class="fa fa-sign-out" aria-hidden="true"></i>
            </button>

            </form>
            </a>
        </li>

    </ul>
</nav>