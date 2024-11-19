@extends('website.layout.content')
@section('webcontent')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('website/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $product->name }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('homepage')}}">Home</a>
                        <a href="{{route('shoppage', $product->product_cat->slug)}}">{{$product->product_cat->name}}</a>
                        <span>{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <!-- Show the first image as the main display -->
                        <img class="product__details__pic__item--large" src="{{ asset('images/products/'.$images[0]) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <!-- Loop through images and display them in the carousel -->
                        @foreach($images as $image)
                            <img data-imgbigurl="{{ asset('images/products/'.$image) }}" src="{{ asset('images/products/'.$image) }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        {{-- <span>({{ $product->reviews }} reviews)</span> --}}
                    </div>

                    <!-- Display discounted price if available, else show regular price -->
                    <div class="product__details__price">
                        @if($product->discounted_price)
                            <span style="text-decoration: line-through;">${{ $product->price }}</span>
                            ${{ $product->discounted_price }}
                        @else
                            ${{ $product->price }}
                        @endif
                    </div>

                    <!-- Render HTML tags in description -->
                    <p>{!! $product->short_description !!}</p>

                    {{-- <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div> --}}
                    <button class="add-to-cart-btn primary-btn" data-product-id="{{ $product->id }}">ADD TO CART</button>

                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>

                    <ul>
                        <li><b>Availability:</b> <span>{{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}</span></li>
                        <li><b>Shipping:</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight:</b> <span>{{ $product->weight }} kg</span></li>


                        <!-- Display color options if available -->
                        <li><b>Colors:</b>
                            <div class="color-options">
                                @foreach($colors as $color)

                                    <span style="background-color: {{ $color }}; width: 20px; height: 20px; display: inline-block; border: 1px solid #ccc; border-radius: 50%; margin-right: 5px;"></span>
                                @endforeach
                            </div>
                        </li>

                        <li><b>Share on:</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Product details tab section -->
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>5</span></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Product Information</h6>
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Additional Information</h6>
                                <p>{!! $product->shipping_info !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Customer Reviews</h6>
                                <p>{!! $product->reviews !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>

.product__details__price {
    font-size: 24px;
    color: #e53637;
}

.product__details__price .original-price {
    font-size: 18px;
    color: #aaa;
    text-decoration: line-through;
    margin-right: 10px;
}

</style>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>

                <div class="row">
                    <div class="product__discount__slider owl-carousel">
                        @foreach ($related as $item)
                        @php
                            $images = json_decode($item->images, true);
                        @endphp

                        <div class="col-lg-4 col-md-6 col-sm-6 product-card mb-4">
                            <div class="card h-100 border-1 shadow-sm position-relative">
                                <!-- Product Image Slider -->
                                <div class="product__discount__percent">-20%</div>
                                <div id="carousel{{ $item->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($images as $index => $imageName)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/products/' . $imageName) }}" class="d-block w-100" alt="...">
                                        </div>
                                        @endforeach

                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $item->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $item->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </a>
                                </div>

                                <!-- Overlay Icons (Wishlist, Share, and Read More) -->
                                <div class="overlay-icons d-flex align-items-center justify-content-center">
                                    <a href="#" class="text-white mx-2" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                    <a href="#" class="text-white mx-2" title="Share"><i class="fa fa-share-alt"></i></a>
                                    <a href="{{ route('product.detail', $item->slug) }}" class="text-white mx-2" title="Read More"><i class="fa fa-ellipsis-h"></i></a>
                                </div>
                                <!-- Product Details -->
                                <div class="card-body text-center p-3">
                                    <h6 class="product-name text-truncate font-weight-bold mb-2">
                                        <a href="{{ route('product.detail', $item->slug) }}" class="text-dark">{{ $item->name }}</a>
                                    </h6>
                                    <p class="product-description text-muted small mb-2">{{ Str::limit(strip_tags($item->description), 50) }}</p>
                                    <!-- Product Price -->
                                    <div class="product-price mb-2">
                                        @if($item->discounted_price)
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
                                    <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                                    <button class="btn btn-primary btn-sm">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

</section>

@endsection
