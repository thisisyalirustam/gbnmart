@extends('website.layout.content')
@section('webcontent')

<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Cart</li>
          </ol>
        </nav>
        <h1>Cart</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Cart Section -->
    <section id="cart" class="cart section">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
@if (count($cartItems) > 0)
    <div class="cart-items">
              <div class="cart-header d-none d-lg-block">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <h5>Product</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Price</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Quantity</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Total</h5>
                  </div>
                </div>
              </div>
                           
              <!-- Cart Item 1 -->
               @foreach ($cartItems as $item)
              <div class="cart-item">
                <div class="row align-items-center">
                  <div class="col-lg-6 col-12 mt-3 mt-lg-0 mb-lg-0 mb-3">
                    <div class="product-info d-flex align-items-center">
                      <div class="product-image">
                        <img src="{{ asset('images/products/' . $item->first_image) }}" alt="{{ $item->name }}" class="img-fluid" loading="lazy">
                      </div>
                      <div class="product-details">
                        <h6 class="product-title">{{ $item->name }}</h6>
                        <div class="product-meta">
                          <span class="product-color">Color: Black</span>
                          <span class="product-size">Size: M</span>
                        </div>
                           <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                             @csrf
                            <button class="remove-item" type="submit">
                          <i class="bi bi-trash"></i> Remove
                        </button>
                            
                            </form>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="price-tag">
                      <span class="current-price"> {{ $item->price }}</span>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <form action="{{ route('cart.update.quantity', $item->product_id) }}" method="POST">
                     @csrf
                    <div class="quantity-selector">
                     <button class="quantity-btn decrease" type="button">
    <i class="bi bi-dash"></i>
</button>
<input type="number" name="quantity" class="quantity-input" value="{{ $item->quantity }}" min="" max="10">
<button class="quantity-btn increase" type="button">
    <i class="bi bi-plus"></i>
</button>

                    </div>
                    </form>
                    
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="item-total">
                      <span id="item-total-{{ $item->product_id }}">${{ number_format($item->quantity * $item->price, 2) }}</span>
                    </div>
                  </div>
                </div>
              </div><!-- End Cart Item -->
@endforeach
         
              <div class="cart-actions">
                <div class="row">
                  <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="coupon-form">
                      <div class="input-group">
                        {{-- <input type="text" class="form-control" placeholder="Coupon code">
                        <button class="btn btn-outline-accent" type="button">Apply Coupon</button> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 text-md-end">
                    <button class="btn btn-outline-heading me-2">
                      <i class="bi bi-arrow-clockwise"></i> Update Cart
                    </button>
                    <button class="btn btn-outline-remove">
                      <i class="bi bi-trash"></i> Clear Cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @else
                        <p>Your cart is empty.</p>
@endif
            
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
            <div class="cart-summary">
              <h4 class="summary-title">Order Summary</h4>

              <div class="summary-item">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value" id="cart-subtotal">${{ number_format($subtotal, 2) }}</span>
              </div>
              {{-- <div class="summary-item shipping-item">
                <span class="summary-label">Shipping</span>
                <div class="shipping-options">
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="standard" checked="">
                    <label class="form-check-label" for="standard">
                      Standard Delivery - $4.99
                    </label>
                  </div>
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="express">
                    <label class="form-check-label" for="express">
                      Express Delivery - $12.99
                    </label>
                  </div>
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="free">
                    <label class="form-check-label" for="free">
                      Free Shipping (Orders over $300)
                    </label>
                  </div>
                </div>
              </div> --}}

              {{-- <div class="summary-item">
                <span class="summary-label">Tax</span>
                <span class="summary-value">$00.00</span>
              </div> --}}

              {{-- <div class="summary-item discount">
                <span class="summary-label">Discount</span>
                <span class="summary-value">-$0.00</span>
              </div> --}}

              <div class="summary-total">
                <span class="summary-label">Total</span>
                <span class="summary-value" id="cart-total">${{ number_format($subtotal, 2) }}</span>
              </div>

              <div class="checkout-button">
                <a href="{{ Auth::check() ? route('checkout.index') : route('option.show') }}" class="btn btn-accent w-100">
                  Proceed to Checkout <i class="bi bi-arrow-right"></i>
                </a>
              </div>

              <div class="continue-shopping">
                <a href="{{route('shoppage')}}" class="btn btn-link w-100">
                  <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
              </div>

              <div class="payment-methods">
                <p class="payment-title">We Accept</p>
                <div class="payment-icons">
                  <i class="bi bi-credit-card"></i>
                  <i class="bi bi-paypal"></i>
                  <i class="bi bi-wallet2"></i>
                  <i class="bi bi-bank"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Cart Section -->

  </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {

        function updateCartQuantity(inputElement) {
            let quantity = inputElement.val();
            let form = inputElement.closest('form');
            let productId = form.attr('action').split('/').pop();

            $.ajax({
                url: `/cart/update-quantity/${productId}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function (response) {
                    $(`#item-total-${productId}`).text(`$${parseFloat(response.itemTotal).toFixed()}`);
                    $('#cart-subtotal').text(`$${parseFloat(response.subtotal).toFixed(2)}`);
                    $('#cart-total').text(`$${parseFloat(response.subtotal).toFixed(2)}`);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Quantity input manually changed
        $('input.quantity-input').on('change', function () {
            updateCartQuantity($(this));
        });

        // Increase button
        $('.quantity-btn.increase').on('click', function () {
            let input = $(this).siblings('.quantity-input');
            let currentVal = parseInt(input.val()) || 1;
            if (currentVal < 10) {
                input.val(currentVal + 1).trigger('change');
            }
        });

        // Decrease button
        $('.quantity-btn.decrease').on('click', function () {
            let input = $(this).siblings('.quantity-input');
            let currentVal = parseInt(input.val()) || 1;
            if (currentVal > 1) {
                input.val(currentVal - 1).trigger('change');
            }
        });
    });
</script>



@endsection
