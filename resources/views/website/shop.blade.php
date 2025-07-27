@extends('website.layout.content')
@section('webcontent')
    <style>
        .category-link.active,
        .subcategory-link.active {
            font-weight: bold;
            color: #007bff;
            /* or any brand color */
        }
    </style>

    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Shop</li>
                    </ol>
                </nav>
                <h1>Shop</h1>
            </div>
        </div><!-- End Page Title -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 sidebar">

                    <div class="widgets-container">

                        <!-- Product Categories Widget -->
                        @php
                            // Get current route segments to determine active state
                            $currentCategorySlug = request()->segment(2); // e.g., 'electronics'
                            $currentSubCategorySlug = request()->segment(3); // e.g., 'smartphones'
                        @endphp

                        <div class="product-categories-widget widget-item">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="category-tree list-unstyled mb-0">
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        @php
                                            $isActiveCategory = $currentCategorySlug === $category->slug;
                                            $collapseId = 'categories-' . $category->id . '-subcategories';
                                            $hasSubCategories = $category->product_sub_category->isNotEmpty();
                                            $isExpanded = $isActiveCategory && $currentSubCategorySlug; // open if on a subcategory
                                        @endphp

                                        <li class="category-item">
                                            <div class="d-flex justify-content-between align-items-center category-header {{ $hasSubCategories ? 'collapsed' : '' }}"
                                                @if ($hasSubCategories) data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $collapseId }}"
                                                    aria-expanded="{{ $isExpanded ? 'true' : 'false' }}"
                                                aria-controls="{{ $collapseId }}" @endif>
                                                <a href="{{ route('shoppage', $category->slug) }}"
                                                    class="category-link {{ $isActiveCategory && !$currentSubCategorySlug ? 'active' : '' }}">
                                                    {{ $category->name }}
                                                </a>
                                                @if ($hasSubCategories)
                                                    <span class="category-toggle">
                                                        <i class="bi bi-chevron-down"></i>
                                                        <i class="bi bi-chevron-up"></i>
                                                    </span>
                                                @endif
                                            </div>

                                            @if ($hasSubCategories)
                                                <ul id="{{ $collapseId }}"
                                                    class="subcategory-list list-unstyled collapse ps-3 mt-2 {{ $isExpanded ? 'show' : '' }}">
                                                    @foreach ($category->product_sub_category as $subCategory)
                                                        @php
                                                            $isActiveSubCategory =
                                                                $currentSubCategorySlug === $subCategory->slug;
                                                        @endphp
                                                        <li>
                                                            <a href="{{ route('shoppage', [$category->slug, $subCategory->slug]) }}"
                                                                class="subcategory-link {{ $isActiveSubCategory ? 'active' : '' }}">
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

                        <div class="pricing-range-widget widget-item">

                            <h3 class="widget-title">Price Range</h3>

                            <div class="price-range-container">
                                <div class="current-range mb-3">
                                    <span class="min-price">${{ $min_price ?: '0' }}</span>
                                    <span class="max-price float-end">${{ $max_price ?: $maxPriceProduct }}</span>
                                </div>

                                <div class="range-slider">
                                    <div class="slider-track"></div>
                                    <div class="slider-progress" style="left: 0%; width: 50%;"></div>
                                    <input type="range" class="min-range" min="{{ $min_price ?: '0' }}"
                                        max="{{ $max_price }}" value="{{ $min_price ?: '0' }}" step="10">
                                    <input type="range" class="max-range" min="0" max="{{ $maxPriceProduct }}"
                                        value="{{ $max_price }}" step="10">
                                </div>

                                <div class="price-inputs mt-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control min-price-input" placeholder="Min"
                                                    min="0" max="1000" value="0" step="10">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control max-price-input" placeholder="Max"
                                                    min="0" max="1000" value="500" step="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="filter-actions mt-3">
                                    <button type="button" class="btn btn-sm btn-primary w-100">Apply Filter</button>
                                </div>
                            </div>

                        </div><!--/Pricing Range Widget -->

                        <!-- Brand Filter Widget -->
                        <h3 class="brand-filter-widget widget-item">Filter by Brand</h3><!--/Brand Filter Widget -->

                        <!-- Color Filter Widget -->
                        <div class="color-filter-widget widget-item">

                            <h3 class="widget-title">Filter by Color</h3>

                            <div class="color-filter-content">
                                <div class="color-options">
                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="black" id="color-black">
                                        <label class="form-check-label" for="color-black">
                                            <span class="color-swatch" style="background-color: #000000;"
                                                title="Black"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="white" id="color-white">
                                        <label class="form-check-label" for="color-white">
                                            <span class="color-swatch" style="background-color: #ffffff;"
                                                title="White"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="red" id="color-red">
                                        <label class="form-check-label" for="color-red">
                                            <span class="color-swatch" style="background-color: #e74c3c;"
                                                title="Red"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="blue" id="color-blue">
                                        <label class="form-check-label" for="color-blue">
                                            <span class="color-swatch" style="background-color: #3498db;"
                                                title="Blue"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="green" id="color-green">
                                        <label class="form-check-label" for="color-green">
                                            <span class="color-swatch" style="background-color: #2ecc71;"
                                                title="Green"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="yellow"
                                            id="color-yellow">
                                        <label class="form-check-label" for="color-yellow">
                                            <span class="color-swatch" style="background-color: #f1c40f;"
                                                title="Yellow"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="purple"
                                            id="color-purple">
                                        <label class="form-check-label" for="color-purple">
                                            <span class="color-swatch" style="background-color: #9b59b6;"
                                                title="Purple"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="orange"
                                            id="color-orange">
                                        <label class="form-check-label" for="color-orange">
                                            <span class="color-swatch" style="background-color: #e67e22;"
                                                title="Orange"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="pink" id="color-pink">
                                        <label class="form-check-label" for="color-pink">
                                            <span class="color-swatch" style="background-color: #fd79a8;"
                                                title="Pink"></span>
                                        </label>
                                    </div>

                                    <div class="form-check color-option">
                                        <input class="form-check-input" type="checkbox" value="brown" id="color-brown">
                                        <label class="form-check-label" for="color-brown">
                                            <span class="color-swatch" style="background-color: #795548;"
                                                title="Brown"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="filter-actions mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Clear All</button>
                                    <button type="button" class="btn btn-sm btn-primary">Apply Filter</button>
                                </div>
                            </div>

                        </div><!--/Color Filter Widget -->

                        <!-- Brand Filter Widget -->
                        <div class="brand-filter-widget widget-item">

                            <h3 class="widget-title">Filter by Brand</h3>
                            <div class="brand-filter-content">
                                <div class="brand-search">
                                    <input type="text" class="form-control" placeholder="Search brands...">
                                    <i class="bi bi-search"></i>
                                </div>

                                <div class="brand-list">

                                    @if ($brands->isNotEmpty())
                                        @foreach ($brands as $brand)
                                            <div class="brand-item">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="brand{{ $brand->id }}" name="brand[]"
                                                        value="{{ $brand->id }}"
                                                        {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="brand{{ $brand->id }}">
                                                        {{ $brand->name }}
                                                        <span class="brand-count">(24)</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif




                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand2">
                                            <label class="form-check-label" for="brand2">
                                                Adidas
                                                <span class="brand-count">(18)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand3">
                                            <label class="form-check-label" for="brand3">
                                                Puma
                                                <span class="brand-count">(12)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand4">
                                            <label class="form-check-label" for="brand4">
                                                Reebok
                                                <span class="brand-count">(9)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand5">
                                            <label class="form-check-label" for="brand5">
                                                Under Armour
                                                <span class="brand-count">(7)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand6">
                                            <label class="form-check-label" for="brand6">
                                                New Balance
                                                <span class="brand-count">(6)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand7">
                                            <label class="form-check-label" for="brand7">
                                                Converse
                                                <span class="brand-count">(5)</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="brand-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brand8">
                                            <label class="form-check-label" for="brand8">
                                                Vans
                                                <span class="brand-count">(4)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="brand-actions">
                                    <button class="btn btn-sm btn-outline-primary">Apply Filter</button>
                                    <button class="btn btn-sm btn-link">Clear All</button>
                                </div>
                            </div>

                        </div><!--/Brand Filter Widget -->

                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Category Header Section -->
                    <section id="category-header" class="category-header section">

                        <div class="container aos-init aos-animate" data-aos="fade-up">

                            <!-- Filter and Sort Options -->
                            <div class="filter-container mb-4 aos-init aos-animate" data-aos="fade-up"
                                data-aos-delay="100">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="filter-item search-form">
                                            <label for="productSearch" class="form-label">Search Products</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="productSearch"
                                                    placeholder="Search for products..." aria-label="Search for products">
                                                <button class="btn search-btn" type="button">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label for="priceRange" class="form-label">Price Range</label>
                                            <select class="form-select" id="priceRange">
                                                <option selected="">All Prices</option>
                                                <option>Under $25</option>
                                                <option>$25 to $50</option>
                                                <option>$50 to $100</option>
                                                <option>$100 to $200</option>
                                                <option>$200 &amp; Above</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label for="sortBy" class="form-label">Sort By</label>
                                            <select class="form-select" id="sort">
                                                <option selected="">Featured</option>
                                                <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>
                                                    Price:
                                                    Low to High</option>
                                                <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>
                                                    Price: High to Low</option>

                                                <option value="latest_product"
                                                    {{ $sort == 'latest_product' ? 'selected' : '' }}>Newest Arrivals
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="filter-item">
                                            <label class="form-label">View</label>
                                            <div class="d-flex align-items-center">
                                                <div class="view-options me-3">
                                                    <button type="button" class="btn view-btn active" data-view="grid"
                                                        aria-label="Grid view">
                                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn view-btn" data-view="list"
                                                        aria-label="List view">
                                                        <i class="bi bi-list-ul"></i>
                                                    </button>
                                                </div>
                                                <div class="items-per-page">
                                                    <select class="form-select" id="itemsPerPage"
                                                        aria-label="Items per page">
                                                        <option value="12">12 per page</option>
                                                        <option value="24">24 per page</option>
                                                        <option value="48">48 per page</option>
                                                        <option value="96">96 per page</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                        <div class="active-filters">
                                            <span class="active-filter-label">Active Filters:</span>
                                            <div class="filter-tags">
                                                <span class="filter-tag">
                                                    Electronics <button class="filter-remove"><i
                                                            class="bi bi-x"></i></button>
                                                </span>
                                                <span class="filter-tag">
                                                    $50 to $100 <button class="filter-remove"><i
                                                            class="bi bi-x"></i></button>
                                                </span>
                                                <button class="clear-all-btn">Clear All</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </section><!-- /Category Header Section -->

                    <!-- Category Product List Section -->
                    <section id="category-product-list" class="category-product-list section">

                        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                            <div class="row gy-4">
                                @foreach ($products as $item)
                                    @php
                                        $images = json_decode($item->images, true);
                                        $firstImage = $images[0] ?? 'default.jpg';
                                        $rating = $ratingData[$item->id] ?? null;
                                        $avgRating = $rating->avg_rating ?? 0;
                                        $ratingCount = $rating->rating_count ?? 0;
                                    @endphp

                                    <div class="col-lg-3">
                                        <div class="product-box">
                                            <div class="product-thumb">
                                                <img src="{{ asset('images/products/' . $firstImage) }}"
                                                    alt="Product Image" class="main-img" loading="lazy">

                                                <div class="product-overlay">
                                                    <div class="product-quick-actions">
                                                        <button type="button"
                                                            class="quick-action-btn addToWishlistButton"
                                                            data-product-id="{{ $item->id }}">
                                                            <i class="bi bi-heart"></i>
                                                        </button>
                                                        <button type="button" class="quick-action-btn">
                                                            <i class="bi bi-arrow-repeat"></i>
                                                        </button>
                                                        <a href="{{ route('product.detail', $item->slug) }}"
                                                            class="quick-action-btn">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div class="add-to-cart-container">
                                                        <button type="button" class="add-to-cart-btn"
                                                            data-product-id="{{ $item->id }}">
                                                            Add to Cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product-content">
                                                <div class="product-details">
                                                    <h3 class="product-title">
                                                        <a
                                                            href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                                    </h3>
                                                    <div class="product-price">
                                                        @if ($item->discounted_price)
                                                            <span
                                                                style="text-decoration: line-through;">${{ $item->price }}</span>
                                                            <span
                                                                class="text-danger ms-1">${{ $item->discounted_price }}</span>
                                                        @else
                                                            <span>${{ $item->price }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="product-rating-container">
                                                    @if ($ratingCount > 0)
                                                        <div class="rating-stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= floor($avgRating))
                                                                    <i class="bi bi-star-fill"></i>
                                                                @elseif ($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                                                                    <i class="bi bi-star-half"></i>
                                                                @else
                                                                    <i class="bi bi-star"></i>
                                                                @endif
                                                            @endfor
                                                            <span
                                                                class="rating-number">{{ number_format($avgRating, 1) }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No rating yet</span>
                                                    @endif
                                                </div>

                                                <div class="product-color-options">
                                                    @foreach (['#ef4444', '#64748b', '#eab308'] as $i => $color)
                                                        <span class="color-option {{ $i === 0 ? 'active' : '' }}"
                                                            style="background-color: {{ $color }}"></span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>

                    </section><!-- /Category Product List Section -->

                    <!-- Category Pagination Section -->
                    <section id="category-pagination" class="category-pagination section">
                        <div class="container">
                            @if ($products->hasPages())
                                <nav class="d-flex justify-content-center" aria-label="Page navigation">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($products->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link">
                                                    <i class="bi bi-arrow-left"></i>
                                                    <span class="d-none d-sm-inline">Previous</span>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                                    rel="prev">
                                                    <i class="bi bi-arrow-left"></i>
                                                    <span class="d-none d-sm-inline">Previous</span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($products->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $products->nextPageUrl() }}"
                                                    rel="next">
                                                    <span class="d-none d-sm-inline">Next</span>
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link">
                                                    <span class="d-none d-sm-inline">Next</span>
                                                    <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </section><!-- /Category Pagination Section -->

                </div>

            </div>
        </div>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ========== PRICE RANGE ==========
            const priceRangeContainer = document.querySelector('.price-range-container');
            if (priceRangeContainer) {
                const minRange = priceRangeContainer.querySelector('.min-range');
                const maxRange = priceRangeContainer.querySelector('.max-range');
                const sliderProgress = priceRangeContainer.querySelector('.slider-progress');
                const minPriceDisplay = priceRangeContainer.querySelector('.current-range .min-price');
                const maxPriceDisplay = priceRangeContainer.querySelector('.current-range .max-price');
                const minPriceInput = priceRangeContainer.querySelector('.min-price-input');
                const maxPriceInput = priceRangeContainer.querySelector('.max-price-input');
                const applyPriceButton = priceRangeContainer.querySelector('.filter-actions .btn-primary');

                let minValue = parseInt(minRange.value);
                let maxValue = parseInt(maxRange.value);

                function updateSliderProgress() {
                    const min = parseInt(minRange.min);
                    const max = parseInt(maxRange.max);
                    const minPercent = ((minValue - min) / (max - min)) * 100;
                    const maxPercent = ((maxValue - min) / (max - min)) * 100;

                    sliderProgress.style.left = `${minPercent}%`;
                    sliderProgress.style.width = `${maxPercent - minPercent}%`;
                }

                function updateDisplays() {
                    minPriceDisplay.textContent = `$${minValue}`;
                    maxPriceDisplay.textContent = `$${maxValue}`;
                    minPriceInput.value = minValue;
                    maxPriceInput.value = maxValue;
                }

                function updateFromSliderInputs() {
                    minValue = Math.min(parseInt(minRange.value), parseInt(maxRange.value));
                    maxValue = Math.max(parseInt(minRange.value), parseInt(maxRange.value));
                    updateDisplays();
                    updateSliderProgress();
                }

                function updateFromTextInputs() {
                    minValue = Math.max(parseInt(minPriceInput.value) || 0, parseInt(minRange.min));
                    maxValue = Math.min(parseInt(maxPriceInput.value) || parseInt(maxRange.max), parseInt(maxRange
                        .max));
                    minValue = Math.min(minValue, maxValue); // prevent invalid range
                    maxValue = Math.max(minValue, maxValue);
                    minRange.value = minValue;
                    maxRange.value = maxValue;
                    updateDisplays();
                    updateSliderProgress();
                }

                // Slider listeners
                minRange.addEventListener('input', updateFromSliderInputs);
                maxRange.addEventListener('input', updateFromSliderInputs);

                // Input listeners
                minPriceInput.addEventListener('change', updateFromTextInputs);
                maxPriceInput.addEventListener('change', updateFromTextInputs);

                // Initial update
                updateDisplays();
                updateSliderProgress();

                // Apply price filter
                if (applyPriceButton) {
                    applyPriceButton.addEventListener('click', function() {
                        apply_filters();
                    });
                }
            }

            // ========== BRAND FILTER ==========
            document.querySelectorAll('.brand-filter-widget .form-check-input').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    apply_filters();
                });
            });

            // ========== SORT + SEARCH ==========
            const sortSelect = document.getElementById('sort');
            const searchInput = document.getElementById('search');

            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    apply_filters();
                });
            }

            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        apply_filters();
                    }
                });
            }

            // ========== FILTER FUNCTION ==========
            function apply_filters() {
                const url = new URL(window.location.href.split('?')[0]);

                // Get price values
                const minPrice = document.querySelector('.min-price-input')?.value || 0;
                const maxPrice = document.querySelector('.max-price-input')?.value || 1000;

                url.searchParams.set('minprice', minPrice);
                url.searchParams.set('maxprice', maxPrice);

                // Get selected brands
                const brands = Array.from(document.querySelectorAll(
                        '.brand-filter-widget .form-check-input:checked'))
                    .map(cb => cb.value);
                if (brands.length) {
                    url.searchParams.set('brand', brands.join(','));
                }

                // Add search
                const keyword = searchInput?.value;
                if (keyword) {
                    url.searchParams.set('search', keyword);
                }

                // Add sort
                const sortVal = sortSelect?.value;
                if (sortVal) {
                    url.searchParams.set('sort', sortVal);
                }

                // Redirect with filter params
                window.location.href = url.toString();
            }

        });

        // Add this to your existing script
        document.getElementById('itemsPerPage').addEventListener('change', function() {
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', this.value);
            window.location.href = url.toString();
        });
    </script>





@endsection
