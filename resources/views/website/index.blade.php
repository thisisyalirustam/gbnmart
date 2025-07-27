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
                        <source src="{{asset('website/Dry Fruits Animation - 720-1.mp4')}}" type="video/mp4" />
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
                        <source src="{{asset('website/Fruits Animation - 720.mp4')}}" type="video/mp4" />
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

        <!-- Category Cards Section -->
    <section id="category-cards" class="category-cards section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="category-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "autoplay": {
                "delay": 5000,
                "disableOnInteraction": false
              },
              "grabCursor": true,
              "speed": 600,
              "slidesPerView": "auto",
              "spaceBetween": 20,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 15
                },
                "576": {
                  "slidesPerView": 3,
                  "spaceBetween": 15
                },
                "768": {
                  "slidesPerView": 4,
                  "spaceBetween": 20
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 20
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            <!-- Category Card 1 -->
            @foreach ($collections as $collection)
                  <div class="swiper-slide">
              <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                <div class="category-image">
                  <img src="{{ asset($collection->image) }}" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title"><p class="small-text">{{$collection->name}}</p></h3>
                <p class="category-count">{{ $collection->products_count }} Products</p>
                <a href="{{route('web.product.collection',$collection->slug)}}" class="stretched-link"></a>
              </div>
            </div>
            @endforeach      
          </div>

          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>

      </div>

    </section><!-- /Category Cards Section -->
        <!-- Promo Cards Section -->
        {{-- <section id="promo-cards" class="promo-cards section">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">
                    <!-- Promo Card 1 -->
                    @foreach ($collections as $collection)
                         <div class="col-md-6 col-lg-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="promo-card card-1">
                            <div class="promo-content">
                                <p class="small-text">{{$collection->name}}</p>
                                <h3 class="promo-title">{{$collection->name}}</h3>
                                <p class="promo-description">{{$collection->description}}</p>
                                <a href="{{route('web.product.collection',$collection->slug)}}" class="btn-shop">Shop Now</a>
                            </div>
                            <div class="promo-image">
                                <img src="{{ asset($collection->image) }}" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

        </section><!-- /Promo Cards Section --> --}}
        
       

<section id="category-cards" class="category-cards section light-background">
    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        @if($frontCategory->count() > 0)
            <div class="category-tabs">
                <ul class="nav justify-content-center" id="category-cards-tabs" role="tablist">
                    @foreach($frontCategory as $index => $pscategory)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                id="category-cards-{{ $pscategory->slug }}-tab" 
                                data-bs-toggle="tab"
                                data-bs-target="#category-cards-{{ $pscategory->slug }}-content" 
                                type="button" role="tab"
                                aria-controls="category-cards-{{ $pscategory->slug }}-content" 
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                SHOP {{ strtoupper($pscategory->name) }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content" id="category-cards-tabContent">
                @foreach($frontCategory as $index => $pcategory)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                         id="category-cards-{{ $pcategory->slug }}-content" 
                         role="tabpanel"
                         aria-labelledby="category-cards-{{ $pcategory->slug }}-tab">
                        <div class="row g-4">
                            @foreach($pcategory->product_sub_category as $subCategory)
                                <div class="col-12 col-md-4 aos-init aos-animate" 
                                     data-aos="fade-up" 
                                     data-aos-delay="{{ ($loop->index + 2) * 100 }}">
                                    <div class="category-card">
                                        @if($subCategory->image)
                                            <img src="{{ asset('storage/'.$subCategory->image) }}" 
                                                 alt="{{ $subCategory->name }}" 
                                                 class="img-fluid" 
                                                 loading="lazy">
                                        @else
                                            <!-- Default image if no image is set -->
                                            <img src="{{ asset('/website/assets/img/product/product-1.webp') }}" 
                                                 alt="{{ $subCategory->name }}" 
                                                 class="img-fluid" 
                                                 loading="lazy">
                                        @endif
                                        <a href="{{ route('shoppage', [$pcategory->slug, $subCategory->slug]) }}" class="category-link">
                                            {{ strtoupper($subCategory->name) }} <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
        <!-- Best Sellers Section -->
        <section id="best-sellers" class="best-sellers section">

            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <h2>Best Sellers</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

  <div class="row g-4">
    @foreach ($sellproduct as $item)
        @php
            $images = json_decode($item->images, true);
            $mainImage = $images[0] ?? 'default.jpg';
            $hoverImage = $images[1] ?? $mainImage;

            $discount = null;
            if ($item->discounted_price && $item->price > 0) {
                $discount = round((($item->price - $item->discounted_price) / $item->price) * 100);
            }

            $rating = $ratingData[$item->id] ?? null;
            $avgRating = $rating->avg_rating ?? 0;
            $ratingCount = $rating->rating_count ?? 0;
        @endphp

        <div class="col-6 col-lg-3">
            <div class="product-card aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                
                {{-- Product Image Section --}}
                <div class="product-image">
                    <img src="{{ asset('images/products/' . $mainImage) }}" class="main-image img-fluid" alt="{{ $item->name }}">
                    <img src="{{ asset('images/products/' . $hoverImage) }}" class="hover-image img-fluid" alt="{{ $item->name }} Variant">

                    {{-- Product Badge --}}
                    @if ($discount)
                        <div class="product-badge sale">-{{ $discount }}%</div>
                    @endif

                    {{-- Overlay Action Buttons --}}
                    <div class="product-overlay">
                        <div class="product-actions">
                            <a href="{{ route('product.detail', $item->slug) }}" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <button type="button" class="action-btn add-to-cart-btn" data-product-id="{{ $item->id }}" title="Add to Cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Product Details --}}
                <div class="product-details">
                    <div class="product-category">{{ $item->product_cat->name ?? 'Category' }}</div>

                    <h4 class="product-title">
                        <a href="{{ route('product.detail', $item->slug) }}">
                            {{ \Illuminate\Support\Str::words(strip_tags($item->name), 4, '...') }}
                        </a>
                    </h4>

                    <div class="product-meta">
                        {{-- Price --}}
                        <div class="product-price">
                            @if ($item->discounted_price)
                                ${{ number_format($item->discounted_price, 2) }}
                                <span class="original-price">${{ number_format($item->price, 2) }}</span>
                            @else
                                ${{ number_format($item->price, 2) }}
                            @endif
                        </div>

                        {{-- Rating --}}
                        <div class="product-rating">
                            @if ($ratingCount > 0)
                                <i class="bi bi-star-fill"></i>
                                {{ number_format($avgRating, 1) }} <span>({{ $ratingCount }})</span>
                            @else
                                <span class="text-muted">No rating</span>
                            @endif
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
                                        <a href="" class="btn-cart add-to-cart-btn"
                                            data-product-id="{{ $item->id }}"><i class="bi bi-cart-plus"></i> Add to
                                            Cart</a>
                                        <div class="product-actions">
                                            <a href="#" class="action-btn addToWishlistButton"
                                                data-product-id="{{ $item->id }}"><i class="bi bi-heart"></i></a>
                                            <a href="{{ route('product.detail', $item->slug) }}" class="action-btn"><i
                                                    class="bi bi-eye"></i></a>
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
                    <a href="{{ route('shoppage') }}" class="view-all-btn">View All Products <i
                            class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </section><!-- /Product List Section -->

    </main>
@endsection
