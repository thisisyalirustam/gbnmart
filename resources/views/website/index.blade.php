@extends('website.layout.content')
@section('webcontent')
    <style>
        /* Carousel item full height responsiveness */
        #nikeCarousel .carousel-item {
            height: 100vh;
            min-height: 400px;
            position: relative;
            overflow: hidden;
        }

        /* Make video fill the entire container */
        #nikeCarousel .carousel-item video {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        /* Responsive captions */
        #nikeCarousel .carousel-caption h2 {
            font-size: 3rem;
        }

        #nikeCarousel .carousel-caption p {
            font-size: 1.25rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            #nikeCarousel .carousel-caption h2 {
                font-size: 2.5rem;
            }

            #nikeCarousel .carousel-caption p {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            #nikeCarousel .carousel-item {
                height: 70vh;
            }

            #nikeCarousel .carousel-caption h2 {
                font-size: 2rem;
            }

            #nikeCarousel .carousel-caption p {
                font-size: 1rem;
            }

            #nikeCarousel .carousel-caption {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .btn {
                padding: 10px 20px !important;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            #nikeCarousel .carousel-caption h2 {
                font-size: 1.5rem;
            }

            #nikeCarousel .carousel-caption p {
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="ecommerce-hero-2 hero">
        <div id="nikeCarousel" class="carousel slide carousel-fade hero-slider ">

            <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": {
                "delay": 5000
              },
              "effect": "fade",
              "fadeEffect": {
                "crossFade": true
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>
            <!-- Inner -->
            <div class="swiper-wrapper">
                <!-- Slide Template -->
                <div class="carousel-item active position-relative" style="height: 80vh;" data-aos-delay="100">
                    <video class="w-100 h-100 object-fit-cover" autoplay loop muted playsinline>
                        <source src="https://mdbcdn.b-cdn.net/img/video/Tropical.mp4" type="video/mp4" />
                    </video>
                    <!-- Dark Gradient Overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: linear-gradient(to bottom right, rgba(0,0,0,0.7), rgba(0,0,0,0.4)); z-index: 1;">
                    </div>

                    <!-- Captions -->
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100 align-items-start animate__animated animate__fadeInLeft"
                        style="z-index: 2; padding-left: 5%;">
                        <h2 class="mb-3 display-4 fw-bold text-uppercase text-white">AIR MAX DN</h2>
                        <p class="mb-4 fs-5 text-white" style="max-width: 500px; text-align: start;">
                            Tap into skateboarding's boreal energy with the all-new responsive design.
                        </p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light text-dark px-4 py-2 rounded-pill fw-bold shadow-sm">SHOP</button>
                            <button class="btn btn-outline-light px-4 py-2 rounded-pill fw-bold">EXPLORE</button>
                        </div>
                    </div>
                </div>

                <!-- Repeat for Other Slides (with similar structure & reduced height) -->
                <div class="carousel-item position-relative" style="height: 80vh;">
                    <video class="w-100 h-100 object-fit-cover" autoplay loop muted playsinline>
                        <source src="https://mdbcdn.b-cdn.net/img/video/forest.mp4" type="video/mp4" />
                    </video>
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: linear-gradient(to top left, rgba(0,0,0,0.6), rgba(0,0,0,0.4)); z-index: 1;">
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100 align-items-start animate__animated animate__fadeInLeft"
                        style="z-index: 2; padding-left: 5%;">
                        <h2 class="mb-3 display-4 fw-bold text-uppercase text-white">ULTRA RESPONSE</h2>
                        <p class="mb-4 fs-5 text-white" style="max-width: 500px; text-align: start;">
                            Experience next-level comfort with our dynamic cushioning system.
                        </p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light text-dark px-4 py-2 rounded-pill fw-bold shadow-sm">SHOP</button>
                            <button class="btn btn-outline-light px-4 py-2 rounded-pill fw-bold">EXPLORE</button>
                        </div>
                    </div>
                </div>

                <div class="carousel-item position-relative" style="height: 80vh;">
                    <video class="w-100 h-100 object-fit-cover" autoplay loop muted playsinline>
                        <source src="https://mdbcdn.b-cdn.net/img/video/Agua-natural.mp4" type="video/mp4" />
                    </video>
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.4)); z-index: 1;">
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100 align-items-start animate__animated animate__fadeInLeft"
                        style="z-index: 2; padding-left: 5%;">
                        <h2 class="mb-3 display-4 fw-bold text-uppercase text-white">LIMITED EDITION</h2>
                        <p class="mb-4 fs-5 text-white" style="max-width: 500px; text-align: start;">
                            Discover the exclusive colorways available only this season.
                        </p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light text-dark px-4 py-2 rounded-pill fw-bold shadow-sm">SHOP</button>
                            <button class="btn btn-outline-light px-4 py-2 rounded-pill fw-bold">EXPLORE</button>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-prev" type="button" data-bs-target="#nikeCarousel" data-bs-slide="prev"></div>
                <div class="swiper-button-next" type="button" data-bs-target="#nikeCarousel" data-bs-slide="next"></div>
            </div>

        </div>
    </div>


    <main class="main">
        <!-- Promo Cards Section -->
        <section id="promo-cards" class="promo-cards section">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">
                    <!-- Promo Card 1 -->
                    <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="promo-card card-1">
                            <div class="promo-content">
                                <p class="small-text">Etiam vel augue</p>
                                <h3 class="promo-title">Nullam quis ante</h3>
                                <p class="promo-description">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                    arcu in enim justo rhoncus ut.</p>
                                <a href="#" class="btn-shop">Shop Now</a>
                            </div>
                            <div class="promo-image">
                                <img src="{{ asset('website/assets/img/product/product-1.webp') }}" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 2 -->
                    <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <div class="promo-card card-2">
                            <div class="promo-content">
                                <p class="small-text">Maecenas tempus</p>
                                <h3 class="promo-title">Sed fringilla mauris</h3>
                                <p class="promo-description">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                    arcu in enim justo rhoncus ut.</p>
                                <a href="#" class="btn-shop">Shop Now</a>
                            </div>
                            <div class="promo-image">
                                <img src="{{ asset('website/assets/img/product/product-2.webp') }}" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 3 -->
                    <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="promo-card card-3">
                            <div class="promo-content">
                                <p class="small-text">Aenean commodo</p>
                                <h3 class="promo-title">Fusce vulputate eleifend</h3>
                                <p class="promo-description">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                    arcu in enim justo rhoncus ut.</p>
                                <a href="#" class="btn-shop">Shop Now</a>
                            </div>
                            <div class="promo-image">
                                <img src="{{ asset('website/assets/img/product/product-f-1.webp') }}" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 4 -->
                    <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                        <div class="promo-card card-4">
                            <div class="promo-content">
                                <p class="small-text">Pellentesque auctor</p>
                                <h3 class="promo-title">Vestibulum dapibus nunc</h3>
                                <p class="promo-description">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                    arcu in enim justo rhoncus ut.</p>
                                <a href="#" class="btn-shop">Shop Now</a>
                            </div>
                            <div class="promo-image">
                                <img src="{{ asset('website/assets/img/product/product-m-1.webp') }}" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Promo Cards Section -->



        <!-- Category Cards Section -->
        <section id="category-cards" class="category-cards section light-background">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="category-tabs">
                    <ul class="nav justify-content-center" id="category-cards-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="category-cards-men-tab" data-bs-toggle="tab"
                                data-bs-target="#category-cards-men-content" type="button" role="tab"
                                aria-controls="category-cards-men-content" aria-selected="false" tabindex="-1">SHOP
                                MEN</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="category-cards-women-tab" data-bs-toggle="tab"
                                data-bs-target="#category-cards-women-content" type="button" role="tab"
                                aria-controls="category-cards-women-content" aria-selected="true">SHOP WOMEN</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="category-cards-accesoires-tab" data-bs-toggle="tab"
                                data-bs-target="#category-cards-accesoires-content" type="button" role="tab"
                                aria-controls="category-cards-accesoires-content" aria-selected="false"
                                tabindex="-1">SHOP ACCESSOIRCES</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="category-cards-tabContent">
                    <!-- Men's Categories -->
                    <div class="tab-pane fade" id="category-cards-men-content" role="tabpanel"
                        aria-labelledby="category-cards-men-tab">
                        <div class="row g-4">
                            <!-- Leather Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-m-11.webp') }}"
                                        alt="Men's Leather" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        LEATHER <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Denim Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-m-12.webp') }}"
                                        alt="Men's Denim" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        DENIM <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Swimwear Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-m-19.webp') }}"
                                        alt="Men's Swimwear" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        SWIMWEAR <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Women's Categories -->
                    <div class="tab-pane fade show active" id="category-cards-women-content" role="tabpanel"
                        aria-labelledby="category-cards-women-tab">
                        <div class="row g-4">
                            <!-- Dresses Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-f-11.webp') }}"
                                        alt="Women's Dresses" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        DRESSES <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Tops Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-f-18.webp') }}"
                                        alt="Women's Tops" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        TOPS <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Accessories Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-f-13.webp') }}"
                                        alt="Women's Accessories" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        ACCESSORIES <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kid's Categories -->
                    <div class="tab-pane fade" id="category-cards-accesoires-content" role="tabpanel"
                        aria-labelledby="category-cards-accesoires-tab">
                        <div class="row g-4">
                            <!-- Boys Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-1.webp') }}"
                                        alt="Boys Clothing" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        BOYS <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Girls Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-1.webp') }}"
                                        alt="Girls Clothing" class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        GIRLS <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Toys Category -->
                            <div class="col-12 col-md-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                <div class="category-card">
                                    <img src="{{ asset('/website/assets/img/product/product-1.webp') }}" alt="Kids Toys"
                                        class="img-fluid" loading="lazy">
                                    <a href="#" class="category-link">
                                        TOYS <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Category Cards Section -->

        <!-- Best Sellers Section -->
        <section id="best-sellers" class="best-sellers section">

            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>Best Sellers</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">
                    <!-- Product 1 -->
                    @foreach ($product as $item)
                        @php
                            $images = json_decode($item->images, true);
                            $mainImage = isset($images[0]) ? $images[0] : 'default.jpg';
                            $hoverImage = isset($images[1]) ? $images[1] : $mainImage; // fallback if only one image
                        @endphp

                        <div class="col-6 col-lg-3">
                            <div class="product-card aos-init aos-animate" data-aos="zoom-in">
                                <div class="product-image">
                                    <img src="{{ asset('images/products/' . $mainImage) }}" class="main-image img-fluid"
                                        alt="{{ $item->name }}">
                                    <img src="{{ asset('images/products/' . $hoverImage) }}"
                                        class="hover-image img-fluid" alt="{{ $item->name }} variant">

                                    <div class="product-overlay">
                                        <div class="product-actions">
                                            <a type="button" href="{{ route('product.detail', $item->slug) }}" class="action-btn" data-bs-toggle="tooltip"
                                                title="Quick View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="action-btn add-to-cart-btn"
                                                data-product-id="{{ $item->id }}" title="Add to Cart">
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-details">
                                    <div class="product-category">{{ $item->product_cat->name ?? 'Category' }}</div>
                                    <h4 class="product-title">
                                        <a href="{{ route('product.detail', $item->slug) }}">
                                            {{ \Illuminate\Support\Str::words(strip_tags($item->name), 4, '...') }}
                                        </a>
                                    </h4>


                                    <div class="product-meta">
                                        <div class="product-price">
                                            @if ($item->discounted_price)
                                                <span class="text-muted"
                                                    style="text-decoration: line-through;">${{ $item->price }}</span>
                                                <span class="text-primary">${{ $item->discounted_price }}</span>
                                            @else
                                                <span class="text-primary">${{ $item->price }}</span>
                                            @endif
                                        </div>
                                        <div class="product-rating">
                                            <i class="bi bi-star-fill"></i>
                                            4.8 <span>(42)</span> {{-- You can replace this with dynamic rating later --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section><!-- /Best Sellers Section -->

        <!-- Product List Section -->
        <section id="product-list" class="product-list section">

            <div class="container isotope-layout aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"
                data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row">
                    <div class="col-12">
                        <div class="product-filters isotope-filters mb-5 d-flex justify-content-center aos-init aos-animate"
                            data-aos="fade-up">
                            <ul class="d-flex flex-wrap gap-2 list-unstyled">
                                <li class="filter-active" data-filter="*">All</li>
                                @foreach ($category as $cat)
                                    <li data-filter=".filter-{{ $cat->slug }}">{{ $cat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row product-container isotope-container aos-init aos-animate" data-aos="fade-up"
                    data-aos-delay="200" style="position: relative; height: 5192px;">

                    @foreach ($product as $item)
                        @php
                            $images = json_decode($item->images, true);
                            $mainImage = $images[0] ?? 'default.jpg';
                            $hoverImage = $images[1] ?? $mainImage;
                            $categorySlug = $item->product_cat->slug ?? 'uncategorized';
                        @endphp

                        <div class="col-md-6 col-lg-3 product-item isotope-item filter-{{ $categorySlug }}">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('images/products/' . $mainImage) }}" class="img-fluid main-img"
                                        alt="{{ $item->name }}">
                                    <img src="{{ asset('images/products/' . $hoverImage) }}" class="img-fluid hover-img"
                                        alt="{{ $item->name }}">
                                    <div class="product-overlay">
                                        <a href="" class="btn-cart add-to-cart-btn" data-product-id="{{ $item->id }}"><i class="bi bi-cart-plus"></i> Add to
                                            Cart</a>
                                        <div class="product-actions">
                                            <a href="#" class="action-btn addToWishlistButton"  data-product-id="{{ $item->id }}"><i class="bi bi-heart"></i></a>
                                            <a href="{{ route('product.detail', $item->slug) }}" class="action-btn"><i class="bi bi-eye"></i></a>
                                            <a href="#" class="action-btn"><i
                                                    class="bi bi-arrow-left-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title">
                                        <a href="{{ route('product.detail', $item->slug) }}">
                                            {{ \Illuminate\Support\Str::words($item->name, 10, '...') }}
                                        </a>
                                    </h5>
                                    <div class="product-price">
                                        @if ($item->discounted_price)
                                            <span class="current-price">${{ $item->discounted_price }}</span>
                                            <span class="old-price">${{ $item->price }}</span>
                                        @else
                                            <span class="current-price">${{ $item->price }}</span>
                                        @endif
                                    </div>
                                    {{-- Optional: Add rating, stock info here --}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="text-center mt-5 aos-init aos-animate" data-aos="fade-up">
                    <a href="{{route('shoppage')}}" class="view-all-btn">View All Products <i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </section><!-- /Product List Section -->

    </main>
@endsection
