<!-- resources/views/checkout/thankyou.blade.php -->

@extends('website.layout.content')

@section('webcontent')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Order Confirmation</li>
          </ol>
        </nav>
        <h1>Order Confirmation</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Order Confirmation Section -->
    <section id="order-confirmation" class="order-confirmation section">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="order-confirmation-3">
          <div class="row g-0">
            <!-- Left sidebar with order summary -->
            <div class="col-lg-4 sidebar aos-init aos-animate" data-aos="fade-right">
              <div class="sidebar-content">
                <!-- Success animation -->
                <div class="success-animation">
                  <i class="bi bi-check-lg"></i>
                </div>

                <!-- Order number and date -->
                <div class="order-id">
                  <h4>Order #ORD-{{ $order->id }}</h4>
                  <div class="order-date">March 2, 2025</div>
                </div>

                <!-- Order progress stepper -->
                <div class="order-progress">
                  <div class="stepper-container">
                    <div class="{{ $order->shipping_status == 'Pending' ? 'stepper-item current' : 'stepper-item' }}">
                      <div class="stepper-icon">1</div>
                      <div class="stepper-text">Confirmed</div>
                    </div>
                    <div class="{{ $order->shipping_status == 'Process' ? 'stepper-item current' : 'stepper-item' }}">
                      <div class="stepper-icon">2</div>
                      <div class="stepper-text">Processing</div>
                    </div>
                    <div class="{{ $order->shipping_status == 'Delivered' ? 'stepper-item current' : 'stepper-item' }}">

                      <div class="stepper-icon">3</div>
                      <div class="stepper-text">Delivered</div>
                    </div>
                    <div class="{{ $order->shipping_status == 'Complete' ? 'stepper-item current' : 'stepper-item' }}">
                      <div class="stepper-icon">4</div>
                      <div class="stepper-text">Shipped</div>
                    </div>
                  </div>
                </div>

                <!-- Price summary -->
                <div class="price-summary">
                  <h5>Order Summary</h5>
                  <ul class="summary-list">
                    <li>
                      <span>Subtotal</span>
                      <span>${{ number_format($order->subtotal, 2) }}</span>
                    </li>
                    <li>
                      <span>Discount</span>
                      <span>${{ number_format($order->discount, 2) }}</span>
                    </li>
                    <li>
                      <span>Shipping</span>
                      <span>${{ number_format($order->shipping, 2) }}</span>
                    </li>
                    <li>
                      <span>Tax</span>
                      <span>$0.0</span>
                    </li>
                    <li class="total">
                      <span>Total</span>
                      <span>${{ number_format($order->grand_total, 2) }}</span>
                    </li>
                  </ul>
                </div>

                <!-- Delivery info -->
                <div class="delivery-info">
                  <h5>Delivery Information</h5>
                  <p class="delivery-estimate">
                    <i class="bi bi-calendar-check"></i>
                    <span>Estimated delivery: March 7-9, 2025</span>
                  </p>
                </div>
              </div>
            </div>

            <!-- Main content area -->
            <div class="col-lg-8 main-content aos-init aos-animate" data-aos="fade-in">
              <!-- Thank you message -->
              <div class="thank-you-message">
                <h1>Thanks for your order!</h1>
                <p>We've received your order and will begin processing it right away.
                  We'll send you updates via email as your order progresses.</p>
              </div>

              <!-- Shipping details -->
              <div class="details-card aos-init aos-animate" data-aos="fade-up">
                <div class="card-header" data-toggle="collapse">
                  <h3>
                    <i class="bi bi-geo-alt"></i>
                    Shipping Details
                  </h3>
                  <i class="bi bi-chevron-down toggle-icon"></i>
                </div>
                <div class="card-body">
                  <div class="row g-4">
                    <div class="col-md-6">
                      <div class="detail-group">
                        <label>Ship To</label>
                        <address>
                          {{ $order->name }}<br>
                          {{ $order->address }}<br>
                          {{ $order->city->name }}, {{ $order->state->name }}<br>
                          {{ $order->country->name }}
                        </address>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="detail-group">
                        <label>Contact</label>
                        <div class="contact-info">
                          <p><i class="bi bi-envelope"></i> {{ $order->email }}</p>
                          <p><i class="bi bi-telephone"></i> {{ $order->phone }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Payment details -->
              {{-- <div class="details-card aos-init aos-animate" data-aos="fade-up">
                <div class="card-header" data-toggle="collapse">
                  <h3>
                    <i class="bi bi-credit-card"></i>
                    Payment Details
                  </h3>
                  <i class="bi bi-chevron-down toggle-icon"></i>
                </div>
                <div class="card-body">
                  <div class="payment-method">
                    <div class="payment-icon">
                      <i class="bi bi-credit-card-2-front"></i>
                    </div>
                    <div class="payment-details">
                      <div class="card-type">American Express</div>
                      <div class="card-number">•••• •••• •••• 3782</div>
                    </div>
                  </div>
                  <div class="billing-address mt-4">
                    <h5>Billing Address</h5>
                    <p>Same as shipping address</p>
                  </div>
                </div>
              </div> --}}

              <!-- Order items -->
              <div class="details-card aos-init aos-animate" data-aos="fade-up" "="">
            <div class=" card-header" data-toggle="collapse">
                <h3>
                  <i class="bi bi-bag-check"></i>
                  Order Items
                </h3>
                <i class="bi bi-chevron-down toggle-icon"></i>
              </div>
              <div class="card-body">
                @foreach ($order->items as $item  )
                  <div class="item">
                  <div class="item-image">
                    <img src="{{ asset('images/products/' . $item->product->images) }}" alt="Product" loading="lazy">
                  </div>
                  <div class="item-details">
                    <h4>{{$item->product->name}}</h4>
                    <div class="item-meta">
                      <span>Weight: {{$item->product->weight}} {{$item->product->unit->name}} </span>
                    </div>
                    <div class="item-price">
                      <span class="quantity">{{$item->quantity}} ×</span>
                      <span class="price">${{$item->price}}</span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <!-- Action buttons -->
            <div class="action-area aos-init aos-animate" data-aos="fade-up">
              <div class="row g-3">
                <div class="col-md-6">
                  <a href="{{route('shoppage')}}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Return to Shop
                  </a>
                </div>
                <div class="col-md-6">
                  <a href="" class="btn btn-account">
                    <span>View in Account</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      </div>

    </section><!-- /Order Confirmation Section -->

  </main>

@endsection
