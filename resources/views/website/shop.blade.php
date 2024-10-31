@extends('website.layout.content')
@section('webcontent')


    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('shoppage', $category->slug) }}" class="main-category-link">
                                                {{ $category->name }}
                                            </a>
                                            @if ($category->product_sub_category->isNotEmpty())
                                                <a href="#submenu{{$category->id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle ml-2">
                                                    <i class="fas fa-chevron-down"></i> <!-- Optional icon for dropdown -->
                                                </a>
                                                <ul class="collapse list-unstyled" id="submenu{{$category->id}}">
                                                    @foreach ($category->product_sub_category as $subCategory)
                                                        <li>
                                                            <a href="{{ route('shoppage', [$category->slug, $subCategory->slug]) }}">
                                                                {{ $subCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- JavaScript to control collapse -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function(){
                                // Allow only one submenu to be open at a time
                                $('.sidebar__item .dropdown-toggle').on('click', function() {
                                    // Close all other submenus
                                    $('.sidebar__item ul.collapse').not($(this).next()).collapse('hide');
                                });
                            });
                        </script>

                        <!-- CSS Styles -->
                        <style>
                            .sidebar__item ul {
                                list-style: none;
                                padding: 0;
                            }

                            .sidebar__item ul li {
                                padding: 5px 10px;
                            }

                            .sidebar__item ul li a {
                                color: black;
                                text-decoration: none;
                            }

                            .sidebar__item ul li a:hover,
                            .sidebar__item ul li a:focus {
                                color: darkblue;
                            }

                            .list-unstyled {
                                background-color: #f8f9fa;
                                border-left: 3px solid #007bff;
                            }
                        </style>

                                  <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($products as $item)
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
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $item)
                        @php
                            $images = json_decode($item->images, true);
                        @endphp

                        <div class="col-lg-4 col-md-6 col-sm-6 product-card mb-4">
                            <div class="card h-100 border-1 shadow-sm position-relative">
                                <!-- Product Image Slider -->
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
                        <style>
                            /* General Card Styling */
                            .product-card .card {
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                                border: 1px solid #d0d3d4;
                                border-radius: 8px;
                                overflow: hidden;
                                background-color: #fff;
                            }
                            .product-card .card:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                            }

                            /* Product Image Styling */
                            .product-image-container {
                                position: relative;
                            }
                            .product-image-container img {
                                transition: transform 0.3s ease;
                            }
                            .product-card .card:hover .product-image-container img {
                                transform: scale(1.05);
                            }

                            /* Slider Control Buttons */
                            .product-image-container .btn {
                                background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
                                color: white;
                                border: none;
                                opacity: 0;
                                transition: opacity 0.3s ease;
                            }
                            .product-image-container:hover .btn {
                                opacity: 1;
                            }

                            /* Action Buttons */
                            .card-footer button {
                                width: 48%;
                                transition: background 0.3s ease;
                            }
                            .card-footer button:hover {
                                background: #0056b3;
                                color: #fff;
                            }
                            /* General and Overlay styling as previously defined... */

                            /* Carousel */
                            .carousel {
                                position: relative;
                                width: 100%;
                                height: 250px;
                            }
                            .carousel img {
                                width: 100%;
                                height: 250px;
                                object-fit: cover;
                            }

                            /* Hover effect for Overlay Icons */
                            .product-image-container:hover .overlay-icons {
                                opacity: 1;
                            }

                                        </style>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
 @endsection
