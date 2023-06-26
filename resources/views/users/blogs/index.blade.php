@extends('users.masterUser')

@section('content')
    <style>
        .card-img-top {
            max-height: 500px;
            object-fit: cover;
            position: relative;
        }

        .card-img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            text-align: center;
            color: white;
        }

        .blog-card {
            display: flex;
            flex-direction: row;
        }

        .blog-card img {
            width: 50%;
            height: auto;
        }

        .blog-card .card-body {
            width: 50%;
        }
    </style>
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <div class="card h-100" style="position: relative;">
                    <img src="{{ asset('img/blog/home-bg.jpg') }}" class="card-img-top" alt="Blog 1" style="opacity: 0.8;">
                    <div class="card-img-overlay"></div>
                    <div class="overlay-content">
                        <h2 class="display-1">Blog</h2>
                        <p class="lead">Welcome to our shoe blog. Here, we share our thoughts and insights related to
                            footwear.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-4">
        <div class="row flex-column align-items-center">
            <div class="col-lg-8 mb-4">
                <div class="card h-100 blog-card">
                    <img src="https://via.placeholder.com/300x200.png?text=Blog+1" class="card-img-top" alt="Blog 1">
                    <div class="card-body">
                        <h2 class="card-title">Blog 1</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc malesuada augue
                            eu euismod placerat. Nulla facilisis elementum risus, et tristique nunc semper id.</p>
                        <a href="" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card h-100 blog-card">
                    <img src="https://via.placeholder.com/300x200.png?text=Blog+2" class="card-img-top" alt="Blog 2">
                    <div class="card-body">
                        <h2 class="card-title">Blog 2</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc malesuada augue
                            eu euismod placerat. Nulla facilisis elementum risus, et tristique nunc semper id.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card h-100 blog-card">
                    <img src="https://via.placeholder.com/300x200.png?text=Blog+3" class="card-img-top" alt="Blog 3">
                    <div class="card-body">
                        <h2 class="card-title">Blog 3</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc malesuada augue
                            eu euismod placerat. Nulla facilisis elementum risus, et tristique nunc semper id.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
