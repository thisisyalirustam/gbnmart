@extends('website.layout.content')
@section('webcontent')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Category</li>
          </ol>
        </nav>
        <h1>Category</h1>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-12">

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
                                @foreach ($collection_product->products as $item)
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
                                                <img src="{{ asset('images/products/' . $firstImage) }}" alt="Product Image"
                                                    class="main-img" loading="lazy">

                                                <div class="product-overlay">
                                                    <div class="product-quick-actions">
                                                        <button type="button" class="quick-action-btn addToWishlistButton"
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
                                                            <span style="text-decoration: line-through;">${{ $item->price }}</span>
                                                            <span class="text-danger ms-1">${{ $item->discounted_price }}</span>
                                                        @else
                                                            <span>${{ $item->price }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="product-rating-container">
                                                    @if($ratingCount > 0)
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
                                                            <span class="rating-number">{{ number_format($avgRating, 1) }}</span>
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

@endsection