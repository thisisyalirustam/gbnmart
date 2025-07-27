 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <title>{{ config('app.name', 'Laravel') }}</title>
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     {{-- cdns  --}}
     <link href="https://fonts.googleapis.com" rel="preconnect">
     <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
     <link
         href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap"
         rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Toastr CSS -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
     {{-- end of cdns --}}
     <!-- Fonts -->

     <!-- Favicons -->
     <link href="{{ asset('website/assets/img/favicon.png') }}" rel="icon">
     <link href="{{ asset('website/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
     <!-- Vendor CSS Files -->
     <link href="{{ asset('website/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('website/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
     <link href="{{ asset('website/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
     <link href="{{ asset('website/assets/vendor/aos/aos.css') }}" rel="stylesheet">
     <link href="{{ asset('website/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
     <link href="{{ asset('website/assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

     <!-- Main CSS File -->
     <link href="{{ asset('website/assets/css/main.css') }}" rel="stylesheet">

 </head>

 <body class="index-page">

     <header id="header" class="header position-relative">
         <!-- Top Bar -->
         <div class="top-bar py-2 d-none d-lg-block">
             <div class="container-fluid container-xl">
                 <div class="row align-items-center">
                     <div class="col-lg-6">
                         <div class="d-flex align-items-center">
                             <div class="top-bar-item me-4">
                                 <i class="bi bi-telephone-fill me-2"></i>
                                 <span>Customer Support: </span>
                                 <a href="tel:{{ settings()->phone }}">{{ settings()->phone }}</a>
                             </div>
                             <div class="top-bar-item">
                                 <i class="bi bi-envelope-fill me-2"></i>
                                 <a href="mailto:{{ settings()->email }}">{{ settings()->email }}</a>
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-6">
                         <div class="d-flex justify-content-end">
                             <div class="top-bar-item me-4">
                                 <a href="track-order.html">
                                     <i class="bi bi-truck me-2"></i>Track Order
                                 </a>
                             </div>
                             <div class="top-bar-item dropdown me-4">
                                 <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                     <i class="bi bi-translate me-2"></i>English
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a class="dropdown-item" href="#"><i
                                                 class="bi bi-check2 me-2 selected-icon"></i>English</a></li>
                                     <li><a class="dropdown-item" href="#">Español</a></li>
                                     <li><a class="dropdown-item" href="#">Français</a></li>
                                     <li><a class="dropdown-item" href="#">Deutsch</a></li>
                                 </ul>
                             </div>
                             <div class="top-bar-item dropdown">
                                 <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                     <i class="bi bi-currency-dollar me-2"></i>USD
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a class="dropdown-item" href="#"><i
                                                 class="bi bi-check2 me-2 selected-icon"></i>USD</a></li>
                                     <li><a class="dropdown-item" href="#">PKR</a></li>
                                     <li><a class="dropdown-item" href="#">GBP</a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Main Header -->
         <div class="main-header">
             <div class="container-fluid container-xl">
                 <div class="d-flex py-3 align-items-center justify-content-between">

                     <a href="{{ route('homepage') }}" class="logo d-flex align-items-center"><img
                             src="{{ asset(settings()->logo) }}" style="width:200px; " alt="Logo"></a>

                     <!-- Search -->
                     <form class="search-form desktop-search-form" action="{{ route('shoppage') }}" method="GET">
                         <div class="input-group">
                             <input type="text" class="form-control" name="search" id="search"
                                 value="{{ Request::get('search') }}" placeholder="Search for products...">
                             <button class="btn search-btn" type="submit">
                                 <i class="bi bi-search"></i>
                             </button>
                         </div>
                     </form>
                     <!-- Actions -->
                     <div class="header-actions d-flex align-items-center justify-content-end">

                         <!-- Mobile Search Toggle -->
                         <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                             data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                             aria-controls="mobileSearch">
                             <i class="bi bi-search"></i>
                         </button>

                         <!-- Account -->
                         <div class="dropdown account-dropdown">
                             <button class="header-action-btn" data-bs-toggle="dropdown">
                                 @auth
                                     @if (Auth::user()->image)
                                         <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="User"
                                             class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                     @else
                                         <i class="bi bi-person"></i>
                                     @endif
                                 @else
                                     <i class="bi bi-person"></i>
                                 @endauth
                                 <span class="action-text d-none d-md-inline-block">Account</span>
                             </button>

                             <div class="dropdown-menu">
                                 @if (Route::has('login'))
                                     @auth
                                         {{-- User is Logged In --}}
                                         <div class="dropdown-header">
                                             <h6>Welcome, {{ Auth::user()->name }}</h6>
                                             <p class="mb-0">Access account & manage orders</p>
                                         </div>
                                         <div class="dropdown-body">
                                             <a class="dropdown-item d-flex align-items-center"
                                                 href="{{ route('dashboard') }}">
                                                 <i class="bi bi-person-circle me-2"></i>
                                                 <span>My Profile</span>
                                             </a>
                                             <a class="dropdown-item d-flex align-items-center"
                                                 href="{{ route('option.show') }}">
                                                 <i class="bi bi-bag-check me-2"></i>
                                                 <span>My Orders</span>
                                             </a>
                                             <a class="dropdown-item d-flex align-items-center"
                                                 href="{{ route('wishlist.show') }}">
                                                 <i class="bi bi-heart me-2"></i>
                                                 <span>My Wishlist</span>
                                             </a>
                                             <a class="dropdown-item d-flex align-items-center" href="">
                                                 <i class="bi bi-arrow-return-left me-2"></i>
                                                 <span>Returns & Refunds</span>
                                             </a>
                                             <a class="dropdown-item d-flex align-items-center" href="">
                                                 <i class="bi bi-gear me-2"></i>
                                                 <span>Settings</span>
                                             </a>
                                             <form method="POST" action="{{ route('logout') }}">
                                                 @csrf
                                                 <button type="submit"
                                                     class="dropdown-item d-flex align-items-center text-danger">
                                                     <i class="bi bi-box-arrow-right me-2"></i>
                                                     <span>Logout</span>
                                                 </button>
                                             </form>
                                         </div>
                                     @else
                                         {{-- Guest View (Not Logged In) --}}
                                         <div class="dropdown-header">
                                             <h6>Welcome to <span class="sitename">FashionStore</span></h6>
                                             <p class="mb-0">Access account & manage orders</p>
                                         </div>
                                         <div class="dropdown-footer">
                                             <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Sign
                                                 In</a>
                                             @if (Route::has('register'))
                                                 <a href="{{ route('register') }}"
                                                     class="btn btn-outline-primary w-100">Register</a>
                                             @endif
                                         </div>
                                     @endauth
                                 @endif
                             </div>
                         </div>


                         <!-- Wishlist -->
                         <a href="{{ route('wishlist.show') }}" class="header-action-btn d-none d-md-flex">
                             <i class="bi bi-heart"></i>
                             <span class="action-text d-none d-md-inline-block">Wishlist</span>
                             <span class="badge" id="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                         </a>

                         <!-- Cart -->
                         <div class="dropdown cart-dropdown">
                             <button class="header-action-btn" data-bs-toggle="dropdown">
                                 <i class="bi bi-cart3"></i>
                                 <span class="action-text d-none d-md-inline-block">Cart</span>
                                 <span class="badge" id="cart-count">{{ $cartCount ?? 0 }}</span>
                                 <!-- Corrected ID -->
                             </button>

                             <div class="dropdown-menu cart-dropdown-menu">
                                 <div class="dropdown-header">
                                     <h6>Shopping Cart (<span id="count">{{ $cartCount ?? 0 }}</span>)</h6>
                                 </div>
                                 <div class="dropdown-body">
                                     <div class="cart-items">
                                         <!-- Cart Item 1 -->
                                         <div class="cart-item">
                                             <div class="cart-item-image">
                                                 <img src="assets/img/product/product-1.webp" alt="Product"
                                                     class="img-fluid">
                                             </div>
                                             <div class="cart-item-content">
                                                 <h6 class="cart-item-title">Wireless Headphones</h6>
                                                 <div class="cart-item-meta">1 × $89.99</div>
                                             </div>
                                             <button class="cart-item-remove">
                                                 <i class="bi bi-x"></i>
                                             </button>
                                         </div>

                                         <!-- Cart Item 2 -->
                                         <div class="cart-item">
                                             <div class="cart-item-image">
                                                 <img src="assets/img/product/product-2.webp" alt="Product"
                                                     class="img-fluid">
                                             </div>
                                             <div class="cart-item-content">
                                                 <h6 class="cart-item-title">Smart Watch</h6>
                                                 <div class="cart-item-meta">1 × $129.99</div>
                                             </div>
                                             <button class="cart-item-remove">
                                                 <i class="bi bi-x"></i>
                                             </button>
                                         </div>

                                         <!-- Cart Item 3 -->
                                         <div class="cart-item">
                                             <div class="cart-item-image">
                                                 <img src="assets/img/product/product-3.webp" alt="Product"
                                                     class="img-fluid">
                                             </div>
                                             <div class="cart-item-content">
                                                 <h6 class="cart-item-title">Bluetooth Speaker</h6>
                                                 <div class="cart-item-meta">1 × $59.99</div>
                                             </div>
                                             <button class="cart-item-remove">
                                                 <i class="bi bi-x"></i>
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="dropdown-footer">
                                     <div class="cart-total">
                                         <span>Total:</span>
                                         <span class="cart-total-price">$279.97</span>
                                     </div>
                                     <div class="cart-actions">
                                         <a href="{{ route('cart.show') }}" class="btn btn-outline-primary">View
                                             Cart</a>
                                         <a href="{{ Auth::check() ? route('checkout.index') : route('option.show') }}"
                                             class="btn btn-primary">Checkout</a>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- Mobile Navigation Toggle -->
                         <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                     </div>
                 </div>
             </div>
         </div>

         <!-- Navigation -->
         <div class="header-nav">
             <div class="container-fluid container-xl position-relative">
                 <nav id="navmenu" class="navmenu">
                     <ul>
                         <li><a href="{{ route('homepage') }}" class="active">Home</a></li>
                         <li><a href="about.html">About</a></li>
                         <li><a href="{{ route('shoppage') }}">Shop</a></li>
                         <li><a href="cart.html">Cart</a></li>
                         <li><a href="checkout.html">Checkout</a></li>
                         @php
                             $categories = getCategories();
                             $subcategories = getSubCategories();
                         @endphp

                         @foreach ($categories as $category)
                             @php
                                 $children = $subcategories->where('product_cat_id', $category->id);
                             @endphp
                             <li class="dropdown"><a
                                     href="{{ route('shoppage', $category->slug) }}"><span>{{ $category->name }}</span>
                                     <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                 @if ($children->isNotEmpty())
                                     <ul>
                                         @foreach ($children as $child)
                                             <li><a
                                                     href="{{ route('shoppage', $child->slug) }}">{{ $child->name }}</a>
                                             </li>
                                         @endforeach
                                     </ul>
                             </li>
                         @endif
                         @endforeach


                         <li><a href="{{ route('website.contact') }}">Contact</a></li>

                     </ul>
                 </nav>
             </div>
         </div>

         <!-- Announcement Bar -->
         <div class="announcement-bar py-2">
             <div class="container-fluid container-xl">
                 <div class="announcement-slider swiper init-swiper">
                     <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 1,
              "effect": "slide",
              "direction": "vertical"
            }
          </script>
                     <div class="swiper-wrapper">
                         <div class="swiper-slide">🚚 Free shipping on orders over $50</div>
                         <div class="swiper-slide">💰 30 days money back guarantee</div>
                         <div class="swiper-slide">🎁 20% off on your first order - Use code: FIRST20</div>
                         <div class="swiper-slide">⚡ Flash Sale! Up to 70% off on selected items</div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Mobile Search Form -->
         <div class="collapse" id="mobileSearch">
             <div class="container">
                 <form class="search-form">
                     <div class="input-group">
                         <input type="text" class="form-control" placeholder="Search for products...">
                         <button class="btn search-btn" type="submit">
                             <i class="bi bi-search"></i>
                         </button>
                     </div>
                 </form>
             </div>
         </div>

     </header>
