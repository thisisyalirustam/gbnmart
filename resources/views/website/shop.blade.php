@extends('website.layout.content')
@section('webcontent')

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

    <div class="container">
      <div class="row">

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Product Categories Widget -->
            <div class="product-categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>

              <ul class="category-tree list-unstyled mb-0">
                <!-- Clothing Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-clothing-subcategories" aria-expanded="false" aria-controls="categories-1-clothing-subcategories">
                    <a href="javascript:void(0)" class="category-link">Clothing</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-clothing-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Men's Wear</a></li>
                    <li><a href="#" class="subcategory-link">Women's Wear</a></li>
                    <li><a href="#" class="subcategory-link">Kids' Clothing</a></li>
                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                  </ul>
                </li>

                <!-- Electronics Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-electronics-subcategories" aria-expanded="false" aria-controls="categories-1-electronics-subcategories">
                    <a href="javascript:void(0)" class="category-link">Electronics</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-electronics-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Smartphones</a></li>
                    <li><a href="#" class="subcategory-link">Laptops</a></li>
                    <li><a href="#" class="subcategory-link">Tablets</a></li>
                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                  </ul>
                </li>

                <!-- Home & Kitchen Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-home-subcategories" aria-expanded="false" aria-controls="categories-1-home-subcategories">
                    <a href="javascript:void(0)" class="category-link">Home &amp; Kitchen</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-home-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Furniture</a></li>
                    <li><a href="#" class="subcategory-link">Kitchen Appliances</a></li>
                    <li><a href="#" class="subcategory-link">Home Decor</a></li>
                    <li><a href="#" class="subcategory-link">Bedding</a></li>
                  </ul>
                </li>

                <!-- Beauty & Personal Care Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-beauty-subcategories" aria-expanded="false" aria-controls="categories-1-beauty-subcategories">
                    <a href="javascript:void(0)" class="category-link">Beauty &amp; Personal Care</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-beauty-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Skincare</a></li>
                    <li><a href="#" class="subcategory-link">Makeup</a></li>
                    <li><a href="#" class="subcategory-link">Hair Care</a></li>
                    <li><a href="#" class="subcategory-link">Fragrances</a></li>
                  </ul>
                </li>

                <!-- Sports & Outdoors Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-sports-subcategories" aria-expanded="false" aria-controls="categories-1-sports-subcategories">
                    <a href="javascript:void(0)" class="category-link">Sports &amp; Outdoors</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-sports-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Fitness Equipment</a></li>
                    <li><a href="#" class="subcategory-link">Outdoor Gear</a></li>
                    <li><a href="#" class="subcategory-link">Sports Apparel</a></li>
                    <li><a href="#" class="subcategory-link">Team Sports</a></li>
                  </ul>
                </li>

                <!-- Books Category (no subcategories) -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header">
                    <a href="#" class="category-link">Books</a>
                  </div>
                </li>

                <!-- Toys & Games Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-toys-subcategories" aria-expanded="false" aria-controls="categories-1-toys-subcategories">
                    <a href="javascript:void(0)" class="category-link">Toys &amp; Games</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-toys-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Board Games</a></li>
                    <li><a href="#" class="subcategory-link">Puzzles</a></li>
                    <li><a href="#" class="subcategory-link">Action Figures</a></li>
                    <li><a href="#" class="subcategory-link">Educational Toys</a></li>
                  </ul>
                </li>
              </ul>

            </div><!--/Product Categories Widget -->

            <!-- Pricing Range Widget -->
            <div class="pricing-range-widget widget-item">

              <h3 class="widget-title">Price Range</h3>

              <div class="price-range-container">
                <div class="current-range mb-3">
                  <span class="min-price">$0</span>
                  <span class="max-price float-end">$500</span>
                </div>

                <div class="range-slider">
                  <div class="slider-track"></div>
                  <div class="slider-progress" style="left: 0%; width: 50%;"></div>
                  <input type="range" class="min-range" min="0" max="1000" value="0" step="10">
                  <input type="range" class="max-range" min="0" max="1000" value="500" step="10">
                </div>

                <div class="price-inputs mt-3">
                  <div class="row g-2">
                    <div class="col-6">
                      <div class="input-group input-group-sm">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control min-price-input" placeholder="Min" min="0" max="1000" value="0" step="10">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="input-group input-group-sm">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control max-price-input" placeholder="Max" min="0" max="1000" value="500" step="10">
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
                      <span class="color-swatch" style="background-color: #000000;" title="Black"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="white" id="color-white">
                    <label class="form-check-label" for="color-white">
                      <span class="color-swatch" style="background-color: #ffffff;" title="White"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="red" id="color-red">
                    <label class="form-check-label" for="color-red">
                      <span class="color-swatch" style="background-color: #e74c3c;" title="Red"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="blue" id="color-blue">
                    <label class="form-check-label" for="color-blue">
                      <span class="color-swatch" style="background-color: #3498db;" title="Blue"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="green" id="color-green">
                    <label class="form-check-label" for="color-green">
                      <span class="color-swatch" style="background-color: #2ecc71;" title="Green"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="yellow" id="color-yellow">
                    <label class="form-check-label" for="color-yellow">
                      <span class="color-swatch" style="background-color: #f1c40f;" title="Yellow"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="purple" id="color-purple">
                    <label class="form-check-label" for="color-purple">
                      <span class="color-swatch" style="background-color: #9b59b6;" title="Purple"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="orange" id="color-orange">
                    <label class="form-check-label" for="color-orange">
                      <span class="color-swatch" style="background-color: #e67e22;" title="Orange"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="pink" id="color-pink">
                    <label class="form-check-label" for="color-pink">
                      <span class="color-swatch" style="background-color: #fd79a8;" title="Pink"></span>
                    </label>
                  </div>

                  <div class="form-check color-option">
                    <input class="form-check-input" type="checkbox" value="brown" id="color-brown">
                    <label class="form-check-label" for="color-brown">
                      <span class="color-swatch" style="background-color: #795548;" title="Brown"></span>
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
                  <div class="brand-item">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="brand1">
                      <label class="form-check-label" for="brand1">
                        Nike
                        <span class="brand-count">(24)</span>
                      </label>
                    </div>
                  </div>

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

        <div class="col-lg-8">

          <!-- Category Header Section -->
          <section id="category-header" class="category-header section">

            <div class="container aos-init aos-animate" data-aos="fade-up">

              <!-- Filter and Sort Options -->
              <div class="filter-container mb-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-3">
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="filter-item search-form">
                      <label for="productSearch" class="form-label">Search Products</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="productSearch" placeholder="Search for products..." aria-label="Search for products">
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
                      <select class="form-select" id="sortBy">
                        <option selected="">Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Customer Rating</option>
                        <option>Newest Arrivals</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="filter-item">
                      <label class="form-label">View</label>
                      <div class="d-flex align-items-center">
                        <div class="view-options me-3">
                          <button type="button" class="btn view-btn active" data-view="grid" aria-label="Grid view">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                          </button>
                          <button type="button" class="btn view-btn" data-view="list" aria-label="List view">
                            <i class="bi bi-list-ul"></i>
                          </button>
                        </div>
                        <div class="items-per-page">
                          <select class="form-select" id="itemsPerPage" aria-label="Items per page">
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
                          Electronics <button class="filter-remove"><i class="bi bi-x"></i></button>
                        </span>
                        <span class="filter-tag">
                          $50 to $100 <button class="filter-remove"><i class="bi bi-x"></i></button>
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
                <!-- Product 1 -->
                @foreach ($products as $item)
    @php
        $images = json_decode($item->images, true);
        $firstImage = $images[0] ?? 'default.jpg';
    @endphp

    <div class="col-lg-6">
        <div class="product-box">
            <div class="product-thumb position-relative">
                <span class="product-label">New Season</span>

                <!-- Product Image -->
                <img src="{{ asset('images/products/' . $firstImage) }}" alt="Product Image"
                    class="main-img" loading="lazy" style="height: 300px; object-fit: cover;">

                <!-- Overlay Actions -->
                <div class="product-overlay">
                    <div class="product-quick-actions">
                        <button type="button" class="quick-action-btn addToWishlistButton"
                            data-product-id="{{ $item->id }}">
                            <i class="bi bi-heart"></i>
                        </button>
                        <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                        <a href="{{ route('product.detail', $item->slug) }}" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                    <div class="add-to-cart-container">
                        <button type="button" class="add-to-cart-btn" data-product-id="{{ $item->id }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Content -->
            <div class="product-content">
                <div class="product-details">
                    <h3 class="product-title">
                        <a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                    </h3>
                    <div class="product-price">
                        @if ($item->discounted_price)
                            <span style="text-decoration: line-through;">${{ $item->price }}</span>
                            <span class="text-danger ms-1">${{ $item->discounted_price }}</span>
                        @else
                            <span>${{ $item->price }}</span>
                        @endif
                    </div>
                </div>

                <!-- Rating -->
                <div class="product-rating-container">
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($item->rating))
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-number">{{ number_format($item->rating, 1) }}</span>
                </div>

                <!-- Color Options -->
                <div class="product-color-options">
                    @foreach (['#3b82f6', '#22c55e', '#f97316'] as $i => $color)
                        <span class="color-option {{ $i == 2 ? 'active' : '' }}" style="background-color: {{ $color }}"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

                <!-- End Product 1 -->
          
              </div>

            </div>

          </section><!-- /Category Product List Section -->

          <!-- Category Pagination Section -->
          <section id="category-pagination" class="category-pagination section">

            <div class="container">
              <nav class="d-flex justify-content-center" aria-label="Page navigation">
                <ul>
                  <li>
                    <a href="#" aria-label="Previous page">
                      <i class="bi bi-arrow-left"></i>
                      <span class="d-none d-sm-inline">Previous</span>
                    </a>
                  </li>

                  <li><a href="#" class="active">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li class="ellipsis">...</li>
                  <li><a href="#">8</a></li>
                  <li><a href="#">9</a></li>
                  <li><a href="#">10</a></li>

                  <li>
                    <a href="#" aria-label="Next page">
                      <span class="d-none d-sm-inline">Next</span>
                      <i class="bi bi-arrow-right"></i>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>

          </section><!-- /Category Pagination Section -->

        </div>

      </div>
    </div>

  </main>

    <!-- Breadcrumb Section Begin -->
    {{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('website/img/breadcrumb.jpg') }}">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
        media="all" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4 class="sidebar__title">Department</h4>
                            <ul class="category-list">
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <li class="category-item">
                                            <!-- Category name for filtering -->
                                            <a href="{{ route('shoppage', $category->slug) }}" class="main-category-link">
                                                <span class="category-name">{{ $category->name }}</span>
                                            </a>
                                            @if ($category->product_sub_category->isNotEmpty())
                                                <a href="javascript:void(0);" class="dropdown-toggle"
                                                    onclick="toggleDropdown('{{ $category->id }}')">
                                                    <i class="fas fa-chevron-down"></i>
                                                    <i class="fas fa-chevron-up" style="display: none;"></i>
                                                </a>
                                                <ul class="collapse list-unstyled submenu" id="submenu{{ $category->id }}">
                                                    @foreach ($category->product_sub_category as $subCategory)
                                                        <li class="sub-category-item">
                                                            <a href="{{ route('shoppage', [$category->slug, $subCategory->slug]) }}"
                                                                class="sub-category-link">
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

                        <div class="sidebar__item">
                            <h4>Select Brands</h4>
                            <ul class="brand-list">
                                @if ($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <li class="brand-item">
                                            <input class="brand-label" type="checkbox" id="brand{{ $brand->id }}"
                                                name="brand[]" value="{{ $brand->id }}"
                                                {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }}>
                                            <label for="brand{{ $brand->id }}">{{ $brand->name }}</label>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>


                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="{{ $min_price ?: '0' }}" data-max="{{ $max_price ?: $maxPriceProduct }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount" name="minamount">
                                        <input type="text" id="maxamount" name="maxamount">
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
                                    <input type="checkbox" id="large" name="size">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="checkbox" id="medium" name="size">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="checkbox" id="small" name="size">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="checkbox" id="tiny" name="size">
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                  
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select id="sort" name="sort">
                                        <option value="0">Default</option>
                                        <option value="latest_product" {{ $sort == 'latest_product' ? 'selected' : '' }}>
                                            Latest Products</option>
                                        <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Price
                                            High
                                        </option>
                                        <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Price Low
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>8</span> Products found</h6>
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
                                            @foreach ($images as $index => $imageName)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('images/products/' . $imageName) }}"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel{{ $item->id }}"
                                            role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel{{ $item->id }}"
                                            role="button" data-slide="next">
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
                                            {{ Str::limit(strip_tags($item->description), 50) }}</p>
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
                                        <button class="add-to-cart-btn btn btn-outline-primary btn-sm"
                                            data-product-id="{{ $item->id }}">Add to Cart</button>
                                            <button class="btn btn-primary btn-sm wishlist-icon addToWishlistButton"
                                            data-product-id="{{ $item->id }}">Wishlist</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    < !-- Product Section End -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <script>
            function toggleDropdown(categoryId) {
                var submenu = document.getElementById('submenu' + categoryId);
                var chevronDown = submenu.previousElementSibling.querySelector('.fas.fa-chevron-down');
                var chevronUp = submenu.previousElementSibling.querySelector('.fas.fa-chevron-up');

                submenu.classList.toggle('show');
                chevronDown.style.display = submenu.classList.contains('show') ? 'none' : 'inline-block';
                chevronUp.style.display = submenu.classList.contains('show') ? 'inline-block' : 'none';
            }


            function getSelectedSizes() {
                var sizes = [];
                document.querySelectorAll('.sidebar__item__size input[type="checkbox"]:checked').forEach(function(item) {
                    sizes.push(item.parentNode.textContent.trim());
                });
                alert('Selected Sizes: ' + sizes.join(', '));
            }



            var rangeSlider = $(".price-range"),
                minamount = $("#minamount"),
                maxamount = $("#maxamount"),
                minPrice = parseInt(rangeSlider.data('min')),
                maxPrice = parseInt(rangeSlider.data('max'));


            $(document).ready(function() {


                rangeSlider.slider({
                    range: true,
                    min: 0,
                    max: {{ $maxPriceProduct }},
                    values: [minPrice, maxPrice],
                    slide: function(event, ui) {
                        minamount.val('$' + ui.values[0]);
                        maxamount.val('$' + ui.values[1]);
                    },
                    change: function(event, ui) {
                        apply_filters();
                    }
                });

                minamount.val('$' + minPrice);
                maxamount.val('$' + maxPrice);

                $(".brand-label").change(function() {
                    apply_filters();
                });

                $('#sort').change(function() {
                    apply_filters();
                });

                function apply_filters() {
                    var brands = $(".brand-label:checked").map(function() {
                        return $(this).val();
                    }).get().join(',');


                    var url = '{{ url()->current() }}';

                    url += '?minprice=' + minamount.val().replace('$', '') + '&maxprice=' + maxamount.val().replace('$',
                        '');
                    var keyword = $("#search").val();

                    if (keyword.length > 0) {
                        url += '&search=' + keyword;
                    }

                    url += '&sort=' + $("#sort").val();

                    if (brands) {
                        url += '&brand=' + brands.toString();
                    }

                    window.location.href = url;
                }
            });

            
        </script> --}}



    @endsection
