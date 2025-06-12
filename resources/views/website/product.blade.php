@extends('website.layout.content')
@section('webcontent')

    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('homepage') }}">Home</a></li>
                        <li><a
                                href="{{ route('shoppage', $product->product_cat->slug) }}">{{ $product->product_cat->name }}</a>
                        </li>
                        <li class="current">{{ $product->name }}</li>
                    </ol>
                </nav>
                <h1>{{ $product->name }}</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Product Details Section -->
        <section id="product-details" class="product-details section">
            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <!-- Product Images Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                        <div class="product-gallery">
                            <!-- Vertical Thumbnails -->
                            <div class="thumbnails-vertical">
                                <div class="thumbnails-container">
                                    @foreach ($images as $image)
                                        <div class="thumbnail-item" data-image="{{ asset('images/products/' . $image) }}">
                                            <img src="{{ asset('images/products/' . $image) }}" alt="Product Thumbnail"
                                                class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main Image -->
                            <div class="main-image-wrapper">
                                <div class="image-zoom-container">
                                    <a href="{{ asset('images/products/' . $images[0]) }}" class="glightbox"
                                        data-gallery="product-gallery">
                                        <img src="{{ asset('images/products/' . $images[0]) }}" alt="Product Image"
                                            class="img-fluid main-image drift-zoom" id="main-product-image"
                                            data-zoom="{{ asset('images/products/' . $images[0]) }}">
                                        <div class="zoom-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="image-nav">
                                    <button class="image-nav-btn prev-image">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="image-nav-btn next-image">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info Column -->
                    <div class="col-lg-6 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                        <div class="product-info-wrapper" id="product-info-sticky">
                            <!-- Product Meta -->
                            <div class="product-meta">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="product-category">{{ $product->product_cat->name }}</span>
                                    <div class="product-share">
                                        <button class="share-btn" aria-label="Share product">
                                            <i class="bi bi-share"></i>
                                        </button>
                                        <div class="share-dropdown">
                                            <a href="#" aria-label="Share on Facebook"><i
                                                    class="bi bi-facebook"></i></a>
                                            <a href="#" aria-label="Share on Twitter"><i
                                                    class="bi bi-twitter-x"></i></a>
                                            <a href="#" aria-label="Share on Pinterest"><i
                                                    class="bi bi-pinterest"></i></a>
                                            <a href="#" aria-label="Share via Email"><i
                                                    class="bi bi-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <h1 class="product-title">{{ $product->name }}</h1>

                                @if ($ratingandreviewcount > 0)
                                    @php
                                        $avgRating = $ratingandreview->avg('rating');
                                    @endphp
                                    <div class="product-rating">
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($avgRating))
                                                    <i class="bi bi-star-fill"></i>
                                                @elseif($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                            <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                                        </div>
                                        <a href="#reviews" class="rating-count">{{ $ratingandreviewcount }} Reviews</a>
                                    </div>
                                @else
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <span class="rating-value">No rating and review yet</span>
                                @endif

                            </div>

                            <!-- Product Price -->
                            <div class="product-price-container">
                                <div class="price-wrapper">
                                    @if ($product->discounted_price)
                                        <span class="current-price">${{ $product->discounted_price }}</span>
                                        <span class="original-price">${{ $product->price }}</span>
                                    @else
                                        <span class="current-price">${{ $product->price }}</span>
                                    @endif
                                </div>
                                @if ($product->discounted_price)
                                    @php
                                        $discountPercent = round(
                                            (($product->price - $product->discounted_price) / $product->price) * 100,
                                        );
                                    @endphp
                                    <span class="discount-badge">Save {{ $discountPercent }}%</span>
                                @endif
                                <div class="stock-info">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>{{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                                    @if ($product->stock_quantity > 0)
                                        <span class="stock-count">({{ $product->stock_quantity }} items left)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product-short-description">
                                <p>{!! $product->short_description !!}</p>
                            </div>

                            <!-- Product Options -->
                            <div class="product-options">
                                <!-- Color Options -->
                                @if (!empty($colors))
                                    <div class="option-group">
                                        <div class="option-header">
                                            <h6 class="option-title">Color</h6>
                                            <span class="selected-option">{{ $colors[0] }}</span>
                                        </div>
                                        <div class="color-options">
                                            @foreach ($colors as $color)
                                                <div class="color-option {{ $loop->first ? 'active' : '' }}"
                                                    data-color="{{ $color }}"
                                                    style="background-color: {{ $color }};">
                                                    <i class="bi bi-check"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Quantity Selector -->
                                <div class="option-group">
                                    <h6 class="option-title">Quantity</h6>
                                    <div class="quantity-selector">
                                        <button class="quantity-btn decrease">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" class="quantity-input" value="1" min="1"
                                            max="{{ $product->stock_quantity }}">
                                        <button class="quantity-btn increase">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="product-actions">
                                <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                                <button class="btn btn-outline-primary buy-now-btn">
                                    <i class="bi bi-lightning-fill"></i> Buy Now
                                </button>
                                <button class="btn btn-outline-secondary wishlist-btn" aria-label="Add to wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>

                            <!-- Delivery Options -->
                            <div class="delivery-options">
                                <div class="delivery-option">
                                    <i class="bi bi-truck"></i>
                                    <div>
                                        <h6>Free Shipping</h6>
                                        <p>On orders over $50</p>
                                    </div>
                                </div>
                                <div class="delivery-option">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <div>
                                        <h6>30-Day Returns</h6>
                                        <p>Hassle-free returns</p>
                                    </div>
                                </div>
                                <div class="delivery-option">
                                    <i class="bi bi-shield-check"></i>
                                    <div>
                                        <h6>2-Year Warranty</h6>
                                        <p>Full coverage</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sticky Add to Cart Bar (appears on scroll) -->
                <div class="sticky-add-to-cart">
                    <div class="container">
                        <div class="sticky-content">
                            <div class="product-preview">
                                <img src="{{ asset('images/products/' . $images[0]) }}" alt="Product"
                                    class="product-thumbnail">
                                <div class="product-info">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <div class="product-price">
                                        @if ($product->discounted_price)
                                            ${{ $product->discounted_price }}
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="sticky-actions">
                                <div class="quantity-selector">
                                    <button class="quantity-btn decrease">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" class="quantity-input" value="1" min="1"
                                        max="{{ $product->stock_quantity }}">
                                    <button class="quantity-btn increase">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                                <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details Accordion -->
                <div class="row mt-5 aos-init aos-animate" data-aos="fade-up">
                    <div class="col-12">
                        <div class="product-details-accordion">
                            <!-- Description Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#description" aria-expanded="true" aria-controls="description">
                                        Product Description
                                    </button>
                                </h2>
                                <div id="description" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="product-description">
                                            <h4>Product Overview</h4>
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#specifications" aria-expanded="false"
                                        aria-controls="specifications">
                                        Shipping Information
                                    </button>
                                </h2>
                                <div id="specifications" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="product-specifications">
                                            {!! $product->shipping_info !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Accordion -->
                            <div class="accordion-item" id="reviews">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#reviewsContent" aria-expanded="false"
                                        aria-controls="reviewsContent">
                                        Customer Reviews ({{ $ratingandreviewcount }})
                                    </button>
                                </h2>
                                <div id="reviewsContent" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="product-reviews">
                                            @if ($ratingandreviewcount > 0)
                                                <div class="reviews-summary">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="overall-rating">
                                                                @php
                                                                    $avgRating = $ratingandreview->avg('rating');
                                                                @endphp
                                                                <div class="rating-number">
                                                                    {{ number_format($avgRating, 1) }}</div>
                                                                <div class="rating-stars">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= floor($avgRating))
                                                                            <i class="bi bi-star-fill"></i>
                                                                        @elseif($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                                                                            <i class="bi bi-star-half"></i>
                                                                        @else
                                                                            <i class="bi bi-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <div class="rating-count">Based on
                                                                    {{ $ratingandreviewcount }} reviews</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8">
                                                            <div class="rating-breakdown">
                                                                @php
                                                                    $ratingCounts = [
                                                                        5 => 0,
                                                                        4 => 0,
                                                                        3 => 0,
                                                                        2 => 0,
                                                                        1 => 0,
                                                                    ];

                                                                    foreach ($ratingandreview as $review) {
                                                                        $ratingCounts[$review->rating]++;
                                                                    }
                                                                @endphp

                                                                @for ($i = 5; $i >= 1; $i--)
                                                                    <div class="rating-bar">
                                                                        <div class="rating-label">{{ $i }}
                                                                            stars</div>
                                                                        <div class="progress">
                                                                            @php
                                                                                $percentage =
                                                                                    $ratingandreviewcount > 0
                                                                                        ? ($ratingCounts[$i] /
                                                                                                $ratingandreviewcount) *
                                                                                            100
                                                                                        : 0;
                                                                            @endphp
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="width: {{ $percentage }}%;"
                                                                                aria-valuenow="{{ $percentage }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                        <div class="rating-count">{{ $ratingCounts[$i] }}
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="reviews-list">
                                                    @foreach ($ratingandreview as $review)
                                                        <!-- Review Item -->
                                                        <div class="review-item">
                                                            <div class="review-header">
                                                                <div class="reviewer-info">
                                                                    <div class="reviewer-avatar-placeholder">
                                                                        {{ substr($review->reviewer_name, 0, 1) }}</div>
                                                                    <div>
                                                                        <h5 class="reviewer-name">
                                                                            {{ $review->reviewer_name }}</h5>
                                                                        <div class="review-date">
                                                                            {{ $review->created_at->format('m/d/Y') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="review-rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <i class="bi bi-star-fill"></i>
                                                                        @else
                                                                            <i class="bi bi-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="review-content">
                                                                <p>{{ $review->review }}</p>
                                                            </div>
                                                        </div><!-- End Review Item -->
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="no-reviews">
                                                    <p>No reviews yet. Be the first to review this product!</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Product Details Section -->

        <!-- Related Product Section -->
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Related Products</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($related as $item)
                        @php
                            $relatedImages = json_decode($item->images, true);
                        @endphp

                        <div class="col-lg-4 col-md-6 col-sm-6 product-card mb-4">
                            <div class="card h-100 border-1 shadow-sm position-relative">
                                @if ($item->discounted_price)
                                    @php
                                        $discountPercent = round(
                                            (($item->price - $item->discounted_price) / $item->price) * 100,
                                        );
                                    @endphp
                                    <div class="product__discount__percent">-{{ $discountPercent }}%</div>
                                @endif

                                <div id="carousel{{ $item->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($relatedImages as $index => $imageName)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('images/products/' . $imageName) }}"
                                                    class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="card-body text-center p-3">
                                    <h6 class="product-name text-truncate font-weight-bold mb-2">
                                        <a href="{{ route('product.detail', $item->slug) }}"
                                            class="text-dark">{{ $item->name }}</a>
                                    </h6>
                                    <p class="product-description text-muted small mb-2">
                                        {{ Str::limit(strip_tags($item->short_description), 50) }}</p>
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
                                <div class="card-footer d-flex justify-content-around bg-light">
                                    <button class="btn btn-outline-primary btn-sm add-to-cart-btn"
                                        data-product-id="{{ $item->id }}">Add to Cart</button>
                                    <button class="btn btn-primary btn-sm">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <style>
        .reviewer-avatar-placeholder {
            width: 40px;
            height: 40px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #333;
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
        }

        .star-rating input[type=radio] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 1.25rem;
            padding: 0 2px;
            cursor: pointer;
        }

        .star-rating input[type=radio]:checked~label {
            color: #ffc107;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
        }

        .product-price-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .price-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .current-price {
            font-size: 24px;
            font-weight: bold;
            color: #e53637;
        }

        .original-price {
            font-size: 18px;
            color: #aaa;
            text-decoration: line-through;
        }

        .discount-badge {
            background-color: #e53637;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .stock-info {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #28a745;
        }

        .stock-count {
            color: #666;
            font-size: 14px;
        }
    </style>

    <script>
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const quantity = this.closest('.product-actions') ?
                    document.querySelector('.quantity-input').value :
                    this.closest('.card-footer').previousElementSibling.querySelector('.quantity-input')
                    .value;

                // AJAX call to add to cart
                fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity || 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update cart count in header
                            const cartCount = document.querySelector('.cart-count');
                            if (cartCount) {
                                cartCount.textContent = data.cart_count;
                            }

                            // Show success message
                            alert('Product added to cart successfully!');
                        } else {
                            alert('Failed to add product to cart: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding to cart');
                    });
            });
        });

        // Image gallery functionality
        document.querySelectorAll('.thumbnail-item').forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const mainImage = document.getElementById('main-product-image');
                const newImageSrc = this.getAttribute('data-image');

                // Update main image
                mainImage.src = newImageSrc;
                mainImage.setAttribute('data-zoom', newImageSrc);

                // Update active thumbnail
                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');

                // Update lightbox
                const lightboxLink = mainImage.closest('a');
                lightboxLink.href = newImageSrc;
            });
        });

        // Quantity selector functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const input = this.closest('.quantity-selector').querySelector('.quantity-input');
                let value = parseInt(input.value);

                if (this.classList.contains('decrease')) {
                    if (value > 1) {
                        input.value = value - 1;
                    }
                } else {
                    if (value < parseInt(input.max)) {
                        input.value = value + 1;
                    }
                }
            });
        });
    </script>



@endsection
