<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">


    <a href="{{ route('admin.dashboard') }}" class="brand-link ">


        <img src="http://127.0.0.1:8000/vendor/adminlte/dist/img/AdminLTELogo.png" alt="Admin Logo"
            class="brand-image img-circle elevation-3" style="opacity:.8">


        <span class="brand-text font-weight-light ">
            <b>Admin</b>
        </span>

    </a>


    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">

                <!-- <li>

                    <div class="form-inline my-2">
                        <div class="input-group" data-widget="sidebar-search" data-arrow-sign="&raquo;">


                            <input class="form-control form-control-sidebar" type="search" placeholder="search"
                                aria-label="search">


                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                </li> -->
                <li class="nav-item">

                    <a class="nav-link  " href="{{ route('admin.dashboard') }}">

                        <i class="fa-solid fa-ballot-check"></i>



                        <p>
                            DASHBOARD

                        </p>

                    </a>

                </li>
                <li class="nav-item">

                    <a class="nav-link  " href="{{ route('admin.account') }}">


                        <i class="fas fa-fw fa-user "></i>

                        <p>
                            Users
                            <span class="badge badge-success right">
                                <?php $count = DB::table('users')
                                    ->where('status', 0)
                                    ->count();
                                echo $count; ?>
                            </span>
                        </p>

                    </a>

                </li>

                <li class="nav-header ">

                    Manager

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="{{ route('admin.product') }}">

                        <i class="fas fa-fw fa-lock "></i>



                        <p>
                            Product
                            <span class="badge badge-success right">
                                <?php $count = DB::table('products')->count();
                                echo $count; ?>
                            </span>

                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link  " href="{{ route('admin.order') }}">

                        <i class="fa-solid fa-ballot-check"></i>



                        <p>
                            Check Order

                        </p>

                    </a>

                </li>



            </ul>
        </nav>
    </div>

</aside>


<div class="content-wrapper ">




    <div class="content">
        <div class="container-fluid">
        </div>
    </div>

</div>
