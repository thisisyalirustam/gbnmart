@extends('website.layout.content')
@section('webcontent')
   
    @php
        $banners = getbanners();
    @endphp

    <style>
        /* General Styling for the Carousel */
        .carousel-item {
            position: relative;
            height: 500px;
            background-size: cover;
            background-position: center;
        }

        /* Overlay to Darken Carousel Item */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Carousel Caption Styling */
        .carousel-caption {
            position: absolute;
            top: 45%;
            transform: translate(0, -50%);
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .carousel-caption p {
            font-size: 1.2rem;
        }

        /* Button Styling */
        .btn-shop-now {
            padding: 12px 25px;
            background: linear-gradient(135deg, #FF5733, #FF8F33);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-shop-now:hover {
            background: linear-gradient(135deg, #FF8F33, #FF5733);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .arrow-icon {
            margin-left: 10px;
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }

        .btn-shop-now:hover .arrow-icon {
            transform: translateX(5px);
        }

        /* Carousel Control Buttons Styling */
        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Adjust Left and Right Controls */
        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }
    </style>

    <!-- HTML (Carousel Structure) -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <!-- Loop through banners dynamically -->
            @foreach ($banners as $index => $banner)
                <div class="carousel-item @if ($index == 0) active @endif"
                    style="background-image: url('{{ asset($banner->image ? $banner->image : 'path/to/default/image.jpg') }}');">
                    <div class="overlay"></div>
                    <div class="carousel-caption">
                        <h1 class="text-warning">{{ $banner->title ?? 'Default Title' }}</h1>
                        <p>{{ $banner->product_cat->name ?? 'Default Category' }} <br />
                            {{ $banner->percentage ?? 0 }} %
                        </p>
                        <p>{{ $banner->description ?? 'Default Description' }}</p>
                        <a href="{{ route('shoppage', $banner->product_cat->slug ?? '#') }}" class="btn btn-shop-now">
                            Shop Now <i class="fas fa-arrow-right arrow-icon"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <script>
        $(document).ready(function() {
            var isDragging = false;
            var startX;
            var carousel = $('#carouselExample');

            // Dragging Start
            carousel.on('mousedown', function(e) {
                isDragging = true;
                startX = e.pageX;
                carousel.css('cursor', 'grabbing');
            });

            // Dragging Movement
            carousel.on('mousemove', function(e) {
                if (!isDragging) return;

                var moveX = e.pageX - startX;
                if (moveX > 100) {
                    $('#carouselExample').carousel('prev');
                    isDragging = false;
                    carousel.css('cursor', 'grab');
                } else if (moveX < -100) {
                    $('#carouselExample').carousel('next');
                    isDragging = false;
                    carousel.css('cursor', 'grab');
                }
            });

            // Dragging End
            carousel.on('mouseup', function() {
                isDragging = false;
                carousel.css('cursor', 'grab');
            });
        });
    </script>

    <section class="hero " style="margin-top: 300px">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </section>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($category as $cat)
                        <div class="col-lg-3 ">
                            <div class="categories__item set-bg" data-setbg="{{ $cat->image }}">
                                <h5><a href="{{ route('shoppage', $cat->slug) }}">{{ $cat->name }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($category as $cat)
                                <li data-filter=".{{ $cat->slug }}">{{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <style>
                ..wishlist-icon {
                    transition: color 0.3s ease;
                }

                .wishlist-icon:hover {
                    color: red !important;
                    /* Wishlist icon color turns red on hover */
                }

                .wishlist-icon.clicked {
                    color: green !important;
                    /* Wishlist icon turns green when clicked */
                }

                .card-link {
                    display: block;
                    text-decoration: none;
                }

                .card-link:hover {
                    text-decoration: none;
                }
            </style>
            <div class="row featured__filter">
                @foreach ($product as $item)
                    @php
                        $images = json_decode($item->images, true);
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 product-card mb-4 mix {{ $item->product_cat->slug }}">
                        <a href="{{ route('product.detail', $item->slug) }}" class="card-link">
                            <!-- Wrap the entire card in <a> -->
                            <div class="card h-100 border-1 shadow-sm position-relative">
                                <!-- Product Image Slider -->
                                <div id="carousel{{ $item->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($images as $index => $imageName)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('images/products/' . $imageName) }}"
                                                    class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $item->id }}" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $item->id }}" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <!-- Wishlist Icon Always Visible -->
                                <a href="#" class="wishlist-icon position-absolute top-0 right-0 p-2 text-red"
                                    title="Add to Wishlist">
                                    <i class="fa fa-heart"></i>
                                </a>

                                <!-- Product Details -->
                                <div class="card-body text-center p-3">
                                    <h6 class="product-name text-truncate font-weight-bold mb-2">
                                        {{ $item->name }}
                                    </h6>
                                    <p class="product-description text-muted small mb-2">
                                        {{ Str::limit(strip_tags($item->description), 50) }}
                                    </p>
                                    <!-- Product Price -->
                                    <div class="product-price mb-2">
                                        @if ($item->discounted_price)
                                            <span class="text-muted"
                                                style="text-decoration: line-through;">${{ $item->price }}</span>
                                            <span class="text-primary ml-1">${{ $item->discounted_price }}</span>
                                        @else
                                            <span class="text-primary">${{ $item->price }}</span>
                                        @endif
                                    </div>
                                    <!-- Stock Status -->
                                    <p class="text-muted small fixed-stock-status">
                                        {{ $item->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="card-footer d-flex justify-content-between bg-light">
                                    <button class="add-to-cart-btn btn btn-outline-primary btn-sm"
                                        data-product-id="{{ $item->id }}">Add to Cart</button>
                                    <button class="btn btn-primary btn-sm wishlist-icon addToWishlistButton"
                                        data-product-id="{{ $item->id }}">Wishlist</button>

                                </div>
                            </div>
                        </a> <!-- Close the anchor tag here -->
                    </div>
                @endforeach
            </div>


        </div>
    </section>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script></script>
@endsection
