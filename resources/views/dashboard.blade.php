 @extends('website.layout.content')
 @section('webcontent')
     <main class="main">

         <!-- Page Title -->
         <div class="page-title light-background">
             <div class="container">
                 <nav class="breadcrumbs">
                     <ol>
                         <li><a href="index.html">Home</a></li>
                         <li class="current">Account</li>
                     </ol>
                 </nav>
                 <h1>Account</h1>
             </div>
         </div><!-- End Page Title -->

         <!-- Account Section -->
         <section id="account" class="account section">

             <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                 <!-- Mobile Sidebar Toggle Button -->
                 <div class="sidebar-toggle d-lg-none mb-3">
                     <button class="btn btn-toggle" type="button" data-bs-toggle="collapse"
                         data-bs-target="#profileSidebar" aria-expanded="false" aria-controls="profileSidebar">
                         <i class="bi bi-list me-2"></i> Profile Menu
                     </button>
                 </div>

                 <div class="row">
                     <!-- Profile Sidebar -->
                     <div class="col-lg-3 profile-sidebar collapse d-lg-block aos-init aos-animate" id="profileSidebar"
                         data-aos="fade-right" data-aos-delay="200">
                         <div class="profile-header">
                             <div class="profile-avatar">
                                 <span>S</span>
                             </div>
                             <div class="profile-info">
                                 <h4>{{ auth()->user()->name }}</h4>
                                 <div class="profile-bonus">
                                     <i class="bi bi-gift"></i>
                                     <span>100 bonuses available</span>
                                 </div>
                             </div>
                         </div>

                         <div class="profile-nav">
                             <ul class="nav flex-column" id="profileTabs" role="tablist">
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link active" id="orders-tab" data-bs-toggle="tab"
                                         data-bs-target="#orders" type="button" role="tab" aria-controls="orders"
                                         aria-selected="true">
                                         <i class="bi bi-box-seam"></i>
                                         <span>Orders</span>
                                         <span class="badge">1</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="wishlist-tab" data-bs-toggle="tab"
                                         data-bs-target="#wishlist" type="button" role="tab" aria-controls="wishlist"
                                         aria-selected="false" tabindex="-1">
                                         <i class="bi bi-heart"></i>
                                         <span>Wishlist</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="payment-tab" data-bs-toggle="tab"
                                         data-bs-target="#payment" type="button" role="tab" aria-controls="payment"
                                         aria-selected="false" tabindex="-1">
                                         <i class="bi bi-credit-card"></i>
                                         <span>Payment methods</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                         data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                         aria-selected="false" tabindex="-1">
                                         <i class="bi bi-star"></i>
                                         <span>My reviews</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="personal-tab" data-bs-toggle="tab"
                                         data-bs-target="#personal" type="button" role="tab" aria-controls="personal"
                                         aria-selected="false" tabindex="-1">
                                         <i class="bi bi-person"></i>
                                         <span>Personal info</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="addresses-tab" data-bs-toggle="tab"
                                         data-bs-target="#addresses" type="button" role="tab"
                                         aria-controls="addresses" aria-selected="false" tabindex="-1">
                                         <i class="bi bi-geo-alt"></i>
                                         <span>Addresses</span>
                                     </button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="notifications-tab" data-bs-toggle="tab"
                                         data-bs-target="#notifications" type="button" role="tab"
                                         aria-controls="notifications" aria-selected="false" tabindex="-1">
                                         <i class="bi bi-bell"></i>
                                         <span>Notifications</span>
                                     </button>
                                 </li>
                             </ul>

                             <h6 class="nav-section-title">Customer service</h6>
                             <ul class="nav flex-column">
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="bi bi-question-circle"></i>
                                         <span>Help center</span>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link">
                                         <i class="bi bi-file-text"></i>
                                         <span>Terms and conditions</span>
                                     </a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="#" class="nav-link logout">
                                         <i class="bi bi-box-arrow-right"></i>
                                         <span>Log out</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>

                     <!-- Profile Content -->
                     <div class="col-lg-9 profile-content aos-init aos-animate" data-aos="fade-left"
                         data-aos-delay="300">
                         <div class="tab-content" id="profileTabsContent">
                             <!-- Orders Tab -->
                             <div class="tab-pane fade active show" id="orders" role="tabpanel"
                                 aria-labelledby="orders-tab">
                                 <div class="tab-header">
                                     <h2>Orders</h2>
                                     <div class="tab-filters">
                                         <div class="row">
                                             <div class="col-md-6 mb-3 mb-md-0">
                                                 <div class="dropdown">
                                                     <button class="btn dropdown-toggle" type="button" id="statusFilter"
                                                         data-bs-toggle="dropdown" aria-expanded="false">
                                                         <span>Select status</span>
                                                         <i class="bi bi-chevron-down"></i>
                                                     </button>
                                                     <ul class="dropdown-menu" aria-labelledby="statusFilter">
                                                         <li><a class="dropdown-item" href="#">All statuses</a></li>
                                                         <li><a class="dropdown-item" href="#">In progress</a></li>
                                                         <li><a class="dropdown-item" href="#">Delivered</a></li>
                                                         <li><a class="dropdown-item" href="#">Canceled</a></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="dropdown">
                                                     <button class="btn dropdown-toggle" type="button" id="timeFilter"
                                                         data-bs-toggle="dropdown" aria-expanded="false">
                                                         <span>For all time</span>
                                                         <i class="bi bi-chevron-down"></i>
                                                     </button>
                                                     <ul class="dropdown-menu" aria-labelledby="timeFilter">
                                                         <li><a class="dropdown-item" href="#">For all time</a></li>
                                                         <li><a class="dropdown-item" href="#">Last 30 days</a></li>
                                                         <li><a class="dropdown-item" href="#">Last 6 months</a>
                                                         </li>
                                                         <li><a class="dropdown-item" href="#">Last year</a></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="orders-table">
                                     <div class="table-header">
                                         <div class="row">
                                             <div class="col-md-3">
                                                 <div class="sort-header">
                                                     Order #
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                 <div class="sort-header">
                                                     Order date
                                                     <i class="bi bi-arrow-down-up"></i>
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                 <div class="sort-header">
                                                     Status
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                 <div class="sort-header">
                                                     Total
                                                     <i class="bi bi-arrow-down-up"></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="order-items">
                                         @foreach ($ordershow as $order)
                                             <div class="order-item">
                                                 <div class="row align-items-center">
                                                     <div class="col-md-3">
                                                         <div class="order-id">#{{ $order->id }}</div>
                                                     </div>
                                                     <div class="col-md-3">
                                                         <div class="order-date">{{ $order->created_at->format('d M') }}
                                                         </div>
                                                     </div>
                                                     <div class="col-md-3">
                                                         @php
                                                             $statusClass = match ($order->shipping_status) {
                                                                 'Pending' => 'bg-warning',
                                                                 'Process' => 'bg-primary',
                                                                 'Delivered' => 'bg-success',
                                                                 'Return' => 'bg-danger',
                                                                 'Complete' => 'bg-secondary',
                                                                 default => '',
                                                             };
                                                         @endphp
                                                         <span
                                                             class="badge {{ $statusClass }}">{{ $order->shipping_status }}</span>
                                                     </div>
                                                     <div class="col-md-3">
                                                         <div class="order-total">${{ $order->grand_total }}</div>
                                                     </div>
                                                 </div>

                                                 <div class="order-products">
                                                     <div class="product-thumbnails">
                                                         @foreach ($order->items as $item)
                                                             <img src="{{ asset('images/products/' . $item->product->images) }}"
                                                                 alt="Product" class="product-thumb" loading="lazy">
                                                         @endforeach
                                                     </div>
                                                     <button type="button" class="order-details-link"
                                                         data-bs-toggle="collapse"
                                                         data-bs-target="#orderDetails{{ $order->id }}">
                                                         <i class="bi bi-chevron-down"></i>
                                                     </button>
                                                 </div>

                                                 <div class="collapse order-details" id="orderDetails{{ $order->id }}">
                                                     <div class="order-details-content">
                                                         <div class="order-details-header">
                                                             <h5>Order Details</h5>
                                                             <div class="order-info">
                                                                 <div class="info-item">
                                                                     <span class="info-label">Order Date:</span>
                                                                     <span
                                                                         class="info-value">{{ $order->created_at->format('m/d/Y') }}</span>
                                                                 </div>
                                                                 <div class="info-item">
                                                                     <span class="info-label">Payment Method:</span>
                                                                     <span
                                                                         class="info-value">{{ $order->payment_method ?? 'N/A' }}</span>
                                                                 </div>
                                                             </div>
                                                         </div>

                                                         <div class="order-items-list">
                                                             @foreach ($order->items as $item)
                                                                 <div class="order-item-detail">
                                                                     <div class="item-image">
                                                                         <img src="{{ asset('images/products/' . $item->product->images) }}"
                                                                             alt="Product" loading="lazy">
                                                                     </div>
                                                                     <div class="item-info">
                                                                         <h6>{{ $item->product->name }}</h6>
                                                                         <div class="item-meta">
                                                                             <span class="item-sku">SKU:
                                                                                 {{ $item->product->sku ?? 'N/A' }}</span>
                                                                             <span class="item-qty">Qty:
                                                                                 {{ $item->quantity }}</span>
                                                                         </div>
                                                                     </div>
                                                                     <div class="item-price">${{ $item->price }}</div>
                                                                 </div>
                                                             @endforeach
                                                         </div>

                                                         <div class="order-summary">
                                                             <div class="summary-row">
                                                                 <span>Subtotal:</span>
                                                                 <span>${{ $order->subtotal ?? 'N/A' }}</span>
                                                             </div>
                                                             <div class="summary-row">
                                                                 <span>Shipping:</span>
                                                                 <span>${{ $order->shipping ?? 'N/A' }}</span>
                                                             </div>
                                                             <div class="summary-row">
                                                                 <span>Discount:</span>
                                                                 <span>${{ $order->discount ?? 'N/A' }}</span>
                                                             </div>
                                                             <div class="summary-row total">
                                                                 <span>Total:</span>
                                                                 <span>${{ $order->grand_total }}</span>
                                                             </div>
                                                         </div>

                                                         <div class="shipping-info">
                                                             <div class="shipping-address">
                                                                 <h6>Shipping Address</h6>
                                                                 <p>
                                                                     {{ $order->address }}<br>
                                                                     {{ $order->city->name }}, {{ $order->state->name }}
                                                                     {{ $order->zip }}<br>
                                                                     {{ $order->country->name ?? 'N/A' }}
                                                                 </p>
                                                             </div>
                                                             <div class="shipping-method">
                                                                 <h6>Payment Method</h6>
                                                                 <p>{{ $order->payment_method }}</p>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                    
                                         @endforeach
                                     </div>


                                     <div class="pagination-container">
                                         <nav aria-label="Orders pagination">
                                             <ul class="pagination">
                                                 <li class="page-item active"><a class="page-link" href="#">1</a>
                                                 </li>
                                                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                 <li class="page-item"><a class="page-link" href="#">4</a></li>
                                             </ul>
                                         </nav>
                                     </div>
                                 </div>
                             </div>

                             <!-- Wishlist Tab -->
                             <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                                 <div class="tab-header">
                                     <h2>Wishlist</h2>
                                 </div>
                                 <div class="wishlist-items">
                                     <div class="row">
                                         <!-- Wishlist Item 1 -->
                                         <div class="col-md-6 col-lg-4 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="100">
                                             <div class="wishlist-item">
                                                 <div class="wishlist-image">
                                                     <img src="assets/img/product/product-1.webp" alt="Product"
                                                         loading="lazy">
                                                     <button class="remove-wishlist" type="button">
                                                         <i class="bi bi-x-lg"></i>
                                                     </button>
                                                 </div>
                                                 <div class="wishlist-content">
                                                     <h5>Lorem ipsum dolor sit amet</h5>
                                                     <div class="product-price">$129.99</div>
                                                     <button class="btn btn-add-cart">Add to cart</button>
                                                 </div>
                                             </div>
                                         </div><!-- End Wishlist Item -->

                                         <!-- Wishlist Item 2 -->
                                         <div class="col-md-6 col-lg-4 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="200">
                                             <div class="wishlist-item">
                                                 <div class="wishlist-image">
                                                     <img src="assets/img/product/product-2.webp" alt="Product"
                                                         loading="lazy">
                                                     <button class="remove-wishlist" type="button">
                                                         <i class="bi bi-x-lg"></i>
                                                     </button>
                                                 </div>
                                                 <div class="wishlist-content">
                                                     <h5>Consectetur adipiscing elit</h5>
                                                     <div class="product-price">$89.50</div>
                                                     <button class="btn btn-add-cart">Add to cart</button>
                                                 </div>
                                             </div>
                                         </div><!-- End Wishlist Item -->

                                         <!-- Wishlist Item 3 -->
                                         <div class="col-md-6 col-lg-4 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="300">
                                             <div class="wishlist-item">
                                                 <div class="wishlist-image">
                                                     <img src="assets/img/product/product-3.webp" alt="Product"
                                                         loading="lazy">
                                                     <button class="remove-wishlist" type="button">
                                                         <i class="bi bi-x-lg"></i>
                                                     </button>
                                                 </div>
                                                 <div class="wishlist-content">
                                                     <h5>Sed do eiusmod tempor</h5>
                                                     <div class="product-price">$199.99</div>
                                                     <button class="btn btn-add-cart">Add to cart</button>
                                                 </div>
                                             </div>
                                         </div><!-- End Wishlist Item -->
                                     </div>
                                 </div>
                             </div>

                             <!-- Payment Methods Tab -->
                             <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                                 <div class="tab-header">
                                     <h2>Payment Methods</h2>
                                     <button class="btn btn-add-payment" type="button">
                                         <i class="bi bi-plus-lg"></i> Add payment method
                                     </button>
                                 </div>
                                 <div class="payment-methods">
                                     <!-- Payment Method 1 -->
                                     <div class="payment-method-item aos-init aos-animate" data-aos="fade-up"
                                         data-aos-delay="100">
                                         <div class="payment-card">
                                             <div class="card-type">
                                                 <i class="bi bi-credit-card"></i>
                                             </div>
                                             <div class="card-info">
                                                 <div class="card-number">**** **** **** 4589</div>
                                                 <div class="card-expiry">Expires 09/2026</div>
                                             </div>
                                             <div class="card-actions">
                                                 <button class="btn-edit-card" type="button">
                                                     <i class="bi bi-pencil"></i>
                                                 </button>
                                                 <button class="btn-delete-card" type="button">
                                                     <i class="bi bi-trash"></i>
                                                 </button>
                                             </div>
                                         </div>
                                         <div class="default-badge">Default</div>
                                     </div><!-- End Payment Method -->

                                     <!-- Payment Method 2 -->
                                     <div class="payment-method-item aos-init aos-animate" data-aos="fade-up"
                                         data-aos-delay="200">
                                         <div class="payment-card">
                                             <div class="card-type">
                                                 <i class="bi bi-credit-card"></i>
                                             </div>
                                             <div class="card-info">
                                                 <div class="card-number">**** **** **** 7821</div>
                                                 <div class="card-expiry">Expires 05/2025</div>
                                             </div>
                                             <div class="card-actions">
                                                 <button class="btn-edit-card" type="button">
                                                     <i class="bi bi-pencil"></i>
                                                 </button>
                                                 <button class="btn-delete-card" type="button">
                                                     <i class="bi bi-trash"></i>
                                                 </button>
                                             </div>
                                         </div>
                                         <button class="btn btn-sm btn-make-default" type="button">Make default</button>
                                     </div><!-- End Payment Method -->
                                 </div>
                             </div>

                             <!-- Reviews Tab -->
                             <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                 <div class="tab-header">
                                     <h2>My Reviews</h2>
                                 </div>
                                 <div class="reviews-list">
                                     <!-- Review Item 1 -->
                                     <div class="review-item aos-init aos-animate" data-aos="fade-up"
                                         data-aos-delay="100">
                                         <div class="review-header">
                                             <div class="review-product">
                                                 <img src="assets/img/product/product-4.webp" alt="Product"
                                                     class="product-image" loading="lazy">
                                                 <div class="product-info">
                                                     <h5>Lorem ipsum dolor sit amet</h5>
                                                     <div class="review-date">Reviewed on 01/15/2025</div>
                                                 </div>
                                             </div>
                                             <div class="review-rating">
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star"></i>
                                             </div>
                                         </div>
                                         <div class="review-content">
                                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl
                                                 eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl
                                                 eget nisl.</p>
                                         </div>
                                         <div class="review-actions">
                                             <button class="btn btn-sm btn-edit-review" type="button">Edit</button>
                                             <button class="btn btn-sm btn-delete-review" type="button">Delete</button>
                                         </div>
                                     </div><!-- End Review Item -->

                                     <!-- Review Item 2 -->
                                     <div class="review-item aos-init aos-animate" data-aos="fade-up"
                                         data-aos-delay="200">
                                         <div class="review-header">
                                             <div class="review-product">
                                                 <img src="assets/img/product/product-5.webp" alt="Product"
                                                     class="product-image" loading="lazy">
                                                 <div class="product-info">
                                                     <h5>Consectetur adipiscing elit</h5>
                                                     <div class="review-date">Reviewed on 12/03/2024</div>
                                                 </div>
                                             </div>
                                             <div class="review-rating">
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                                 <i class="bi bi-star-fill"></i>
                                             </div>
                                         </div>
                                         <div class="review-content">
                                             <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                 ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                                 ex ea commodo consequat.</p>
                                         </div>
                                         <div class="review-actions">
                                             <button class="btn btn-sm btn-edit-review" type="button">Edit</button>
                                             <button class="btn btn-sm btn-delete-review" type="button">Delete</button>
                                         </div>
                                     </div><!-- End Review Item -->
                                 </div>
                             </div>

                             <!-- Personal Info Tab -->
                             <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                 <div class="tab-header">
                                     <h2>Personal Information</h2>
                                 </div>
                                 <div class="personal-info-form aos-init aos-animate" data-aos="fade-up"
                                     data-aos-delay="100">
                                     <form class="php-email-form">
                                         <div class="row">
                                             <div class="col-md-6 mb-3">
                                                 <label for="firstName" class="form-label">First Name</label>
                                                 <input type="text" class="form-control" id="firstName"
                                                     name="firstName" value="Lorem" required="">
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                 <label for="lastName" class="form-label">Last Name</label>
                                                 <input type="text" class="form-control" id="lastName"
                                                     name="lastName" value="Ipsum" required="">
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-md-6 mb-3">
                                                 <label for="email" class="form-label">Email</label>
                                                 <input type="email" class="form-control" id="email"
                                                     name="email" value="lorem@example.com" required="">
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                 <label for="phone" class="form-label">Phone</label>
                                                 <input type="tel" class="form-control" id="phone"
                                                     name="phone" value="+1 (555) 123-4567">
                                             </div>
                                         </div>
                                         <div class="mb-3">
                                             <label for="birthdate" class="form-label">Date of Birth</label>
                                             <input type="date" class="form-control" id="birthdate" name="birthdate"
                                                 value="1990-01-01">
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label d-block">Gender</label>
                                             <div class="form-check form-check-inline">
                                                 <input class="form-check-input" type="radio" name="gender"
                                                     id="genderMale" value="male" checked="">
                                                 <label class="form-check-label" for="genderMale">Male</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                 <input class="form-check-input" type="radio" name="gender"
                                                     id="genderFemale" value="female">
                                                 <label class="form-check-label" for="genderFemale">Female</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                 <input class="form-check-input" type="radio" name="gender"
                                                     id="genderOther" value="other">
                                                 <label class="form-check-label" for="genderOther">Other</label>
                                             </div>
                                         </div>
                                         <div class="loading">Loading</div>
                                         <div class="error-message"></div>
                                         <div class="sent-message">Your information has been updated. Thank you!</div>
                                         <div class="text-end">
                                             <button type="submit" class="btn btn-save">Save Changes</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>

                             <!-- Addresses Tab -->
                             <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                 <div class="tab-header">
                                     <h2>My Addresses</h2>
                                     <button class="btn btn-add-address" type="button">
                                         <i class="bi bi-plus-lg"></i> Add new address
                                     </button>
                                 </div>
                                 <div class="addresses-list">
                                     <div class="row">
                                         <!-- Address Item 1 -->
                                         <div class="col-lg-6 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="100">
                                             <div class="address-item">
                                                 <div class="address-header">
                                                     <h5>Home Address</h5>
                                                     <div class="address-actions">
                                                         <button class="btn-edit-address" type="button">
                                                             <i class="bi bi-pencil"></i>
                                                         </button>
                                                         <button class="btn-delete-address" type="button">
                                                             <i class="bi bi-trash"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="address-content">
                                                     <p>123 Main Street<br>Apt 4B<br>New York, NY 10001<br>United States</p>
                                                 </div>
                                                 <div class="default-badge">Default</div>
                                             </div>
                                         </div><!-- End Address Item -->

                                         <!-- Address Item 2 -->
                                         <div class="col-lg-6 mb-4 aos-init aos-animate" data-aos="fade-up"
                                             data-aos-delay="200">
                                             <div class="address-item">
                                                 <div class="address-header">
                                                     <h5>Work Address</h5>
                                                     <div class="address-actions">
                                                         <button class="btn-edit-address" type="button">
                                                             <i class="bi bi-pencil"></i>
                                                         </button>
                                                         <button class="btn-delete-address" type="button">
                                                             <i class="bi bi-trash"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="address-content">
                                                     <p>456 Business Ave<br>Suite 200<br>San Francisco, CA 94107<br>United
                                                         States</p>
                                                 </div>
                                                 <button class="btn btn-sm btn-make-default" type="button">Make
                                                     default</button>
                                             </div>
                                         </div><!-- End Address Item -->
                                     </div>
                                 </div>
                             </div>

                             <!-- Notifications Tab -->
                             <div class="tab-pane fade" id="notifications" role="tabpanel"
                                 aria-labelledby="notifications-tab">
                                 <div class="tab-header">
                                     <h2>Notification Settings</h2>
                                 </div>
                                 <div class="notifications-settings aos-init aos-animate" data-aos="fade-up"
                                     data-aos-delay="100">
                                     <div class="notification-group">
                                         <h5>Order Updates</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Order status changes</div>
                                                 <div class="notification-desc">Receive notifications when your order
                                                     status changes</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="orderStatusNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="orderStatusNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Shipping updates</div>
                                                 <div class="notification-desc">Receive notifications about shipping and
                                                     delivery</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="shippingNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="shippingNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-group">
                                         <h5>Account Activity</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Security alerts</div>
                                                 <div class="notification-desc">Receive notifications about
                                                     security-related activity</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="securityNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="securityNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Password changes</div>
                                                 <div class="notification-desc">Receive notifications when your password is
                                                     changed</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="passwordNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="passwordNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-group">
                                         <h5>Marketing</h5>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Promotions and deals</div>
                                                 <div class="notification-desc">Receive notifications about special offers
                                                     and discounts</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="promoNotif">
                                                 <label class="form-check-label" for="promoNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">New product arrivals</div>
                                                 <div class="notification-desc">Receive notifications when new products are
                                                     added</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="newProductNotif">
                                                 <label class="form-check-label" for="newProductNotif"></label>
                                             </div>
                                         </div>
                                         <div class="notification-item">
                                             <div class="notification-info">
                                                 <div class="notification-title">Personalized recommendations</div>
                                                 <div class="notification-desc">Receive notifications with product
                                                     recommendations based on your interests</div>
                                             </div>
                                             <div class="form-check form-switch">
                                                 <input class="form-check-input" type="checkbox" id="recommendNotif"
                                                     checked="">
                                                 <label class="form-check-label" for="recommendNotif"></label>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="notification-actions">
                                         <button type="button" class="btn btn-save">Save Preferences</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </section><!-- /Account Section -->

     </main>
     
 @endsection
