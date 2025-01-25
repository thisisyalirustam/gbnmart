@extends('website.layout.content')
@section('webcontent')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('website/img/breadcrumb.jpg') }}">
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
                    {{-- <div class="product__discount">
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
                                            <div id="carousel{{ $item->id }}" class="carousel slide"
                                                data-ride="carousel">
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
                                                <a href="{{ route('product.detail', $item->slug) }}"
                                                    class="text-white mx-2" title="Read More"><i
                                                        class="fa fa-ellipsis-h"></i></a>
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
                                                        <span
                                                            class="text-primary ml-1">${{ $item->discounted_price }}</span>
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
                    </div> --}}
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
        </script>



    @endsection
