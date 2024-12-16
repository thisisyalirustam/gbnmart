@extends('website.layout.content')
@section('webcontent')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="{{ asset(getbanners()->image) }}">
                        <div class="hero__text">
                            <span>{{getbanners()->title}}</span>
                        <h2>{{getbanners()->product_cat->name}} <br />{{getbanners()->percentage}} % </h2>
                            <p>{{getbanners()->description}}</p>
                            <a href="{{ route('shoppage', getbanners()->product_cat->slug) }}" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($category as $cat)
                            <li data-filter=".{{$cat->slug}}">{{$cat->name}}</li>
                          @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($product as $item)
                    @php
                        $images = json_decode($item->images, true);
                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 product-card mb-4 mix {{$item->product_cat->slug}}">
                        <div class="card h-100 border-1 shadow-sm position-relative">
                            <!-- Product Image Slider -->
                            <div id="carousel{{ $item->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $imageName)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/products/' . $imageName) }}" class="d-block w-100"
                                                alt="...">
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
                            <!-- Overlay Icons (Wishlist, Share, and Read More) -->
                            <div class="overlay-icons d-flex align-items-center justify-content-center">
                                <a href="#" class="text-white mx-2" title="Add to Wishlist"><i
                                        class="fa fa-heart"></i></a>
                                <a href="#" class="text-white mx-2" title="Share"><i
                                        class="fa fa-share-alt"></i></a>
                                <a href="{{ route('product.detail', $item->slug) }}" class="text-white mx-2"
                                    title="Read More"><i class="fa fa-ellipsis-h"></i></a>
                            </div>
                            <!-- Product Details -->
                            <div class="card-body text-center p-3">
                                <h6 class="product-name text-truncate font-weight-bold mb-2">
                                    <a href="{{ route('product.detail', $item->slug) }}"
                                        class="text-dark">{{ $item->name }}</a>
                                </h6>
                                <p class="product-description text-muted small mb-2">
                                    {{ Str::limit(strip_tags($item->description), 50) }}
                                </p>
                                <!-- Product Price -->
                                <div class="product-price mb-2">
                                    @if ($item->discounted_price)
                                        <span class="text-muted" style="text-decoration: line-through;">${{ $item->price }}</span>
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
                            <div class="card-footer d-flex justify-content-around bg-light">
                                <button class="add-to-cart-btn btn btn-outline-primary btn-sm" data-product-id="{{ $item->id }}">Add to Cart</button>
                                <button class="btn btn-primary btn-sm">Buy Now</button>
                            </div>
                        </div>
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

<script>



</script>
@endsection
