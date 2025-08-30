@extends('website.layout.content')
@section('webcontent')
<style>
    /* Add this CSS */
#place-order-btn {
    position: relative;
    min-width: 120px;
}

#place-order-btn .spinner-border {
    margin-left: 8px;
}
</style>
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Checkout</li>
                    </ol>
                </nav>
                <h1>Checkout</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Checkout Section -->
        <section id="checkout" class="checkout section">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Checkout Steps -->
                        <div class="checkout-steps mb-4 aos-init aos-animate" data-aos="fade-up">
                            <div class="step active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-title">Information</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-title">Shipping</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-title">Payment</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step" data-step="4">
                                <div class="step-number">4</div>
                                <div class="step-title">Review</div>
                            </div>
                        </div>

                        <!-- Checkout Forms Container -->
                        <div class="checkout-forms aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                            <!-- Step 1: Customer Information -->
                            <div class="checkout-form active" data-form="1">
                                <div class="form-header">
                                    <h3>Customer Information</h3>
                                    <p>Please enter your contact details</p>
                                </div>
                                <form class="checkout-form-element" id="orderForm" name="orderForm" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="first-name">First Name</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Your First Name" required="">
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <label for="last-name">Last Name</label>
                                            <input type="text" name="last-name" class="form-control" id="last-name"
                                                placeholder="Your Last Name" required="">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" required="">

                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="button" class="btn btn-primary next-step" data-next="2">Continue to
                                            Shipping</button>
                                    </div>

                            </div>

                            <!-- Step 2: Shipping Address -->
                            <div class="checkout-form" data-form="2">
                                <div class="form-header">
                                    <h3>Shipping Address</h3>
                                    <p>Where should we deliver your order?</p>
                                </div>
                                <div class="form-group">
                                    <label for="address">Street Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Street Address" required="">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="apartment">Apartment, Suite, etc. (optional)</label>
                                    <input type="text" class="form-control" name="apartment" id="apartment"
                                        placeholder="Apartment, Suite, Unit, etc.">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="country">Country</label>
                                    <select class="form-select" id="country_id" name="country_id" required="">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <label for="city">State</label>
                                        <select class="form-control" id="state_id" name="state_id" required>
                                            {{-- @foreach ($states as $state)
            <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach --}}
                                        </select>

                                    </div>
                                    <div class="col-md-4 form-group mt-3 mt-md-0">
                                        <label for="city">City</label>
                                        <select class="form-control" id="city_id" name="city_id" required>
                                            {{-- @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group mt-3 mt-md-0">
                                        <label for="zip">ZIP Code</label>
                                        <input type="text" name="zip_code" class="form-control" id="zip_code"
                                            placeholder="ZIP Code" required="">
                                    </div>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="save-address"
                                        name="save-address">
                                    <label class="form-check-label" for="save-address">
                                        Save this address for future orders
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary prev-step"
                                        data-prev="1">Back to
                                        Information</button>
                                    <button type="button" class="btn btn-primary next-step" data-next="3">Continue to
                                        Payment</button>
                                </div>

                            </div>

                            <!-- Step 3: Payment Method -->
                            <div class="checkout-form" data-form="3">
                                <div class="form-header">
                                    <h3>Payment Method</h3>
                                    <p>Choose how you'd like to pay</p>
                                </div>

                                <div class="payment-methods">
                                    <div class="payment-method">
                                        <div class="payment-method-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="payment-cash"
                                                    name="payment_method" value="cash"
                                                    onclick="showPaymentDetails('cash')" checked="">
                                                <label class="form-check-label" for="credit-card">
                                                    Credit / Debit Card
                                                </label>
                                            </div>
                                            <div class="payment-icons">
                                                <i class="bi bi-credit-card-2-front"></i>
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                        <div class="payment-method-body d-none">
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="card-number">Card Number</label>
                                                    <input type="text" class="form-control" id="payment-bank"
                                                        name="payment_method" value="bank"
                                                        onclick="showPaymentDetails('bank')"
                                                        placeholder="1234 5678 9012 3456" required="">
                                                </div>
                                            </div>
                                            {{-- <div class="row mt-3">
                                                <div class="col-md-6 form-group">
                                                    <label for="expiry">Expiration Date</label>
                                                    <input type="text" class="form-control" name="expiry"
                                                        id="expiry" placeholder="MM/YY" required="">
                                                </div>
                                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                                    <label for="cvv">Security Code (CVV)</label>
                                                    <input type="text" class="form-control" name="cvv"
                                                        id="cvv" placeholder="123" required="">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="card-name">Name on Card</label>
                                                <input type="text" class="form-control" name="card-name"
                                                    id="card-name" placeholder="John Doe" required="">
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="payment-method mt-3">
                                        <div class="payment-method-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="bank-transfer" value="bank">
                                                <label class="form-check-label" for="bank-transfer">
                                                    Bank Transfer
                                                </label>
                                            </div>
                                            <div class="payment-icons">
                                                <i class="bi bi-bank"></i>
                                            </div>
                                        </div>
                                        <div class="payment-method-body d-none">
                                            <p>Please upload your bank transfer receipt after payment.</p>
                                            <div class="form-group">
                                                <label for="bank-screenshot">Upload Receipt:</label>
                                                <input type="file" class="form-control" id="bank-screenshot"
                                                    name="bank_invoice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-method mt-3">
                                        <div class="payment-method-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="cash-on-delivery" value="cash">
                                                <label class="form-check-label" for="cash-on-delivery">
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                            <div class="payment-icons">
                                                <i class="bi bi-cash"></i>
                                            </div>
                                        </div>
                                        <div class="payment-method-body d-none">
                                            <p>Pay with cash when your order is delivered.</p>
                                        </div>
                                    </div>

                                    <div class="payment-method mt-3 active">
                                        <div class="payment-method-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="payment-paypal"
                                                    name="payment_method" value="paypal"
                                                    onclick="showPaymentDetails('paypal')">
                                                <label class="form-check-label" for="paypal">
                                                    PayPal
                                                </label>
                                            </div>
                                            <div class="payment-icons">
                                                <i class="bi bi-paypal"></i>
                                            </div>
                                        </div>
                                        <div class="payment-method-body">
                                            <p>You will be redirected to PayPal to complete your purchase securely.</p>
                                        </div>
                                    </div>

                                    <div class="payment-method mt-3">
                                        <div class="payment-method-header">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment-method"
                                                    id="apple-pay">
                                                <label class="form-check-label" for="apple-pay">
                                                    Apple Pay
                                                </label>
                                            </div>
                                            <div class="payment-icons">
                                                <i class="bi bi-apple"></i>
                                            </div>
                                        </div>
                                        <div class="payment-method-body d-none">
                                            <p>You will be prompted to authorize payment with Apple Pay.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary prev-step"
                                        data-prev="2">Back to
                                        Shipping</button>
                                    <button type="button" class="btn btn-primary next-step" data-next="4">Review
                                        Order</button>
                                </div>

                            </div>

                            <!-- Step 4: Order Review -->
                            <div class="checkout-form" data-form="4">
                                <div class="form-header">
                                    <h3>Review Your Order</h3>
                                    <p>Please review your information before placing your order</p>
                                </div>
                                <form class="checkout-form-element">
                                    <div class="review-sections" style="display: none;">
                                        <div class="review-section">
                                            <div class="review-section-header">
                                                <h4>Contact Information</h4>
                                                <button type="button" class="btn-edit" data-edit="1">Edit</button>
                                            </div>
                                            <div class="review-section-content">
                                                <p class="review-name">John Doe</p>
                                                <p class="review-email">johndoe@example.com</p>
                                                <p class="review-phone">+1 (555) 123-4567</p>
                                            </div>
                                        </div>

                                        <div class="review-section mt-3">
                                            <div class="review-section-header">
                                                <h4>Shipping Address</h4>
                                                <button type="button" class="btn-edit" data-edit="2">Edit</button>
                                            </div>
                                            <div class="review-section-content">
                                                <p>123 Main Street, Apt 4B</p>
                                                <p>New York, NY 10001</p>
                                                <p>United States</p>
                                            </div>
                                        </div>

                                        <div class="review-section mt-3">
                                            <div class="review-section-header">
                                                <h4>Payment Method</h4>
                                                <button type="button" class="btn-edit" data-edit="3">Edit</button>
                                            </div>
                                            <div class="review-section-content">
                                                <p><i class="bi bi-credit-card-2-front me-2"></i> Credit Card ending in
                                                    3456</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check mt-4" style="display: none;">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms"
                                            required="">
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#termsModal">Terms and
                                                Conditions</a> and <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#privacyModal">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                    <div class="success-message"
                                        style="animation: 0.5s ease 0s 1 normal forwards running fadeInUp;">Your
                                        order has been placed successfully! Thank you for your purchase.</div>
                                   <!-- In the Order Review section, update the button and surrounding elements -->
<div class="d-flex justify-content-between mt-4">
    <button type="button" class="btn btn-outline-secondary prev-step" data-prev="3">Back to Payment</button>
    <button type="button" class="btn btn-success" id="place-order-btn">
        <span class="btn-text">Place Order</span>
        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    </button>
</div> 
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Order Summary -->
                        <div class="order-summary aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                            <div class="order-summary-header">
                                <h3>Order Summary</h3>
                                <button type="button" class="btn-toggle-summary d-lg-none">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>

                            <div class="order-summary-content">
                                <div class="order-items">
                                    @foreach ($cartItems as $item)
                                        <div class="order-item">
                                            <div class="order-item-image">
                                                <img src="{{ asset('images/products/' . $item->first_image) }}"
                                                    alt="Product" class="img-fluid">
                                            </div>
                                            <div class="order-item-details">
                                                <h4>{{ $item->name }}</h4>
                                                <p class="order-item-variant">Unit: {{ $item->unit }} | Size: M</p>
                                                <div class="order-item-price">
                                                    <span class="quantity">{{ $item->quantity }} ×</span>
                                                    <span
                                                        class="price">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="unit_id"
                                            value="{{ $item->unit_id }}" hidden>
                                    @endforeach

                                </div>

                                <div class="order-totals">
                                    <div class="order-subtotal d-flex justify-content-between">
                                        <span>Subtotal</span>
                                        <span>${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div class="order-shipping d-flex justify-content-between">
                                        <span>Shipping</span>
                                        <span id="shipping-charge">$0.00</span>
                                        <input type="hidden"  name="shipping_charge" id="shipping-charge-input"
                                        value="0">
                                    </div>
                                    <div class="order-tax d-flex justify-content-between">
                                        <span>Tax</span>
                                        <span>$0.00</span>
                                    </div>
                                    <div class="order-tax d-flex justify-content-between">
                                        <span>discount</span>
                                        <span id="discount">$0.00</span>
                                    </div>
                                    <div class="order-total d-flex justify-content-between">
                                        <span>Total</span>
                                        <span id="grand_total">${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                </div>

                                <div class="promo-code mt-3">
                                    <div class="input-group">

                                        <input type="text" class="form-control" id="coupon" name="coupon"
                                            placeholder="Promo Code" aria-label="Promo Code">
                                        <button class="btn btn-outline-primary" id="coupon_button"
                                            type="button">Apply</button><br>
                                        <span id="coupon-message" class="text-danger"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="discount" id="coupon-input" value="0">
                                <input type="hidden" name="coupon_code" id="coupon_code" value="">
                                <div class="secure-checkout mt-4">
                                    <div class="secure-checkout-header">
                                        <i class="bi bi-shield-lock"></i>
                                        <span>Secure Checkout</span>
                                    </div>
                                    <div class="payment-icons mt-2">
                                        <i class="bi bi-credit-card-2-front"></i>
                                        <i class="bi bi-credit-card"></i>
                                        <i class="bi bi-paypal"></i>
                                        <i class="bi bi-apple"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Privacy Modals -->
                <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus
                                    hendrerit arcu
                                    sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh
                                    porttitor. Ut in nulla
                                    enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
                                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor
                                    neque eu tellus
                                    rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est
                                    bibendum non
                                    venenatis nisl tempor.</p>
                                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor
                                    neque eu tellus
                                    rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est
                                    bibendum non
                                    venenatis nisl tempor.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I
                                    Understand</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus
                                    hendrerit arcu
                                    sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh
                                    porttitor. Ut in nulla
                                    enim.</p>
                                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor
                                    neque eu tellus
                                    rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est
                                    bibendum non
                                    venenatis nisl tempor.</p>
                                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor
                                    neque eu tellus
                                    rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est
                                    bibendum non
                                    venenatis nisl tempor.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I
                                    Understand</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </form>
        </section><!-- /Checkout Section -->

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // When country is selected, fetch related states
            $('#country_id').change(function() {
                var countryId = $(this).val(); // Correctly define countryId here
                console.log("Country ID: " +
                    countryId); // Debugging line to check if countryId is being fetched

                // Reset state and city dropdowns
                $('#state_id').html('<option value="">Select State</option>');
                $('#city_id').html('<option value="">Select City</option>');
                $('#state_id').prop('disabled', true); // Disable state dropdown initially
                $('#city_id').prop('disabled', true); // Disable city dropdown initially

                if (countryId) {
                    $.ajax({
                        url: '/get-states/' + countryId, // Make sure this route is correct
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.length > 0) {
                                $('#state_id').prop('disabled', false); // Enable state dropdown
                                $.each(response, function(index, state) {
                                    $('#state_id').append('<option value="' + state.id +
                                        '">' + state.name + '</option>');
                                });
                            }
                        },
                        error: function() {
                            alert('Error fetching states.');
                        }
                    });
                }
            });

            // When state is selected, fetch related cities
            $('#state_id').change(function() {
                var stateId = $(this).val(); // Ensure stateId is correctly defined here
                console.log("State ID: " + stateId); // Debugging line to check if stateId is being fetched

                // Reset city dropdown
                $('#city_id').html('<option value="">Select City</option>');
                $('#city_id').prop('disabled', true); // Disable city dropdown initially

                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId, // Make sure this route is correct
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.length > 0) {
                                $('#city_id').prop('disabled', false); // Enable city dropdown
                                $.each(response, function(index, city) {
                                    $('#city_id').append('<option value="' + city.id +
                                        '">' + city.name + '</option>');
                                });
                            }
                        },
                        error: function() {
                            alert('Error fetching cities.');
                        }
                    });
                }
            });



            $('#city_id, #unit_id').change(function() {
                $.ajax({
                    url: '{{ route('get.shipping.charges') }}',
                    type: 'post',
                    data: {
                        city_id: $('#city_id').val(),
                        unit_id: $('#unit_id').val(), // Make sure to include the unit_id
                        _token: '{{ csrf_token() }}' // Include the CSRF token
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == true) {
                            $("#shipping-charge-input").val(response.shippingCharge);
                            $("#shipping-charge").text('$' + response.shippingCharge.toFixed(
                                2)); // Format as a currency value
                            $("#grand_total").text('$' + response.grand_total.toFixed(
                                2)); // Format as a currency value
                        }
                    }
                });
            });

        });
    </script>

    <script>
        function showPaymentDetails(method) {
            // Hide all payment detail sections
            document.getElementById('cash-details').style.display = 'none';
            document.getElementById('bank-details').style.display = 'none';
            document.getElementById('paypal-details').style.display = 'none';
            document.getElementById('credit-details').style.display = 'none';

            // Show selected payment details
            if (method === 'cash') {
                document.getElementById('cash-details').style.display = 'block';
            } else if (method === 'bank') {
                document.getElementById('bank-details').style.display = 'block';
            } else if (method === 'paypal') {
                document.getElementById('paypal-details').style.display = 'block';
            } else if (method === 'credit') {
                document.getElementById('credit-details').style.display = 'block';
            }

            // Show the overall payment details container
            document.getElementById('payment-details').style.display = 'block';
        }

     // Add this JavaScript code
$(document).ready(function() {
    // ... your existing code ...
    
    // Handle the Place Order button click
    $('#place-order-btn').click(function(e) {
        e.preventDefault();
        
        // Validate the terms checkbox
        if (!$('#terms').is(':checked')) {
            alert('Please agree to the Terms and Conditions');
            return;
        }
        
        // Disable button and show spinner
        $(this).prop('disabled', true);
        $('.btn-text', this).text('Processing...');
        $('.spinner-border', this).removeClass('d-none');
        
        // Submit the form via AJAX
        $.ajax({
            url: '{{ route("checkout.process") }}',
            type: 'POST',
            data: new FormData($('#orderForm')[0]),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === true) {
                    // Show success message
                    $('.success-message').show();
                    
                    // Hide other elements
                    $('.review-sections, .form-check, .d-flex.justify-content-between.mt-4').hide();
                    
                    // Redirect after delay
                    setTimeout(function() {
                        window.location.href = '/thank-you/' + response.orderId;
                    }, 2000);
                } else {
                    // Re-enable button on error
                    $('#place-order-btn').prop('disabled', false);
                    $('.btn-text', '#place-order-btn').text('Place Order');
                    $('.spinner-border', '#place-order-btn').addClass('d-none');
                    
                    alert(response.message || "There was an error with your order. Please try again.");
                }
            },
            error: function(xhr) {
                // Re-enable button on error
                $('#place-order-btn').prop('disabled', false);
                $('.btn-text', '#place-order-btn').text('Place Order');
                $('.spinner-border', '#place-order-btn').addClass('d-none');
                
                alert("An error occurred. Please try again.");
                console.error(xhr.responseText);
            }
        });
    });
    
    // ... rest of your existing JavaScript ...
});



        $("#coupon_button").click(function() {
            $.ajax({
                url: '{{ route('checkout.applyCoupon') }}', // Your checkout processing route
                type: 'POST',
                data: {
                    code: $("#coupon").val(),
                    _token: '{{ csrf_token() }}' // Added CSRF token correctly
                },
                dataType: 'JSON',
                success: function(response) {
                    // Handle success response here
                    if (response.status == true) {
                        // Format as a currency value
                        $("#coupon-input").val(response.discount);
                        $("#coupon_code").val(response.coupon);
                        $("#subtotal").text('$' + response.subtotal.toFixed(
                            2)); // Format as a currency value
                        $("#discount").text('$' + response.discount.toFixed(
                            2)); // Format as a currency value
                        $("#grand_total").text('$' + response.grand_total.toFixed(2));
                        $("#coupon-message").text("Your coupon is Correct You Have Dissount Now");
                    }
                    if (response.status == false) {
                        $("#coupon-message").text("coupon is invlid")
                    }
                },
            });
        });
    </script>

    <script>
    $(document).ready(function() {
        // Step navigation
        $('.next-step').click(function() {
            const nextStep = $(this).data('next');
            const currentForm = $(this).closest('.checkout-form');
            
            // Validate current step before proceeding
            if (validateCurrentStep(currentForm.data('form'))) {
                // Hide current step
                currentForm.removeClass('active');
                
                // Show next step
                $(`.checkout-form[data-form="${nextStep}"]`).addClass('active');
                
                // Update step indicators
                $('.checkout-steps .step').removeClass('active');
                $(`.checkout-steps .step[data-step="${nextStep}"]`).addClass('active');
                
                // For step 4 (Review), update the review sections with entered data
                if (nextStep == 4) {
                    updateReviewSection();
                }
            }
        });

        $('.prev-step').click(function() {
            const prevStep = $(this).data('prev');
            const currentForm = $(this).closest('.checkout-form');
            
            // Hide current step
            currentForm.removeClass('active');
            
            // Show previous step
            $(`.checkout-form[data-form="${prevStep}"]`).addClass('active');
            
            // Update step indicators
            $('.checkout-steps .step').removeClass('active');
            $(`.checkout-steps .step[data-step="${prevStep}"]`).addClass('active');
        });

        // Edit button in review section
        $('.btn-edit').click(function() {
            const stepToEdit = $(this).data('edit');
            
            // Hide review step
            $('.checkout-form[data-form="4"]').removeClass('active');
            
            // Show the step to edit
            $(`.checkout-form[data-form="${stepToEdit}"]`).addClass('active');
            
            // Update step indicators
            $('.checkout-steps .step').removeClass('active');
            $(`.checkout-steps .step[data-step="${stepToEdit}"]`).addClass('active');
        });

        // Function to validate current step before proceeding
        function validateCurrentStep(step) {
            let isValid = true;
            
            if (step == 1) {
                // Validate customer information
                if (!$('#name').val() || !$('#email').val() || !$('#phone').val()) {
                    isValid = false;
                    alert('Please fill in all customer information fields');
                }
            } else if (step == 2) {
                // Validate shipping address
                if (!$('#address').val() || !$('#country_id').val() || 
                    !$('#state_id').val() || !$('#city_id').val() || !$('#zip_code').val()) {
                    isValid = false;
                    alert('Please fill in all shipping address fields');
                }
            } else if (step == 3) {
                // Validate payment method
                if (!$('input[name="payment_method"]:checked').val()) {
                    isValid = false;
                    alert('Please select a payment method');
                }
            }
            
            return isValid;
        }

        // Function to update review section with entered data
        function updateReviewSection() {
            // Update contact information
            $('.review-name').text($('#name').val() + ' ' + $('#last-name').val());
            $('.review-email').text($('#email').val());
            $('.review-phone').text($('#phone').val());
            
            // Update shipping address
            const countryName = $('#country_id option:selected').text();
            const stateName = $('#state_id option:selected').text();
            const cityName = $('#city_id option:selected').text();
            
            $('.review-section:nth-child(2) .review-section-content').html(`
                <p>${$('#address').val()}</p>
                <p>${cityName}, ${stateName} ${$('#zip_code').val()}</p>
                <p>${countryName}</p>
            `);
            
            // Update payment method
            const paymentMethod = $('input[name="payment_method"]:checked').val();
            let paymentText = '';
            
            if (paymentMethod === 'cash') {
                paymentText = '<p><i class="bi bi-cash me-2"></i> Cash on Delivery</p>';
            } else if (paymentMethod === 'bank') {
                paymentText = '<p><i class="bi bi-bank me-2"></i> Bank Transfer</p>';
            } else if (paymentMethod === 'paypal') {
                paymentText = '<p><i class="bi bi-paypal me-2"></i> PayPal</p>';
            } else if (paymentMethod === 'credit') {
                paymentText = '<p><i class="bi bi-credit-card me-2"></i> Credit Card</p>';
            }
            
            $('.review-section:nth-child(3) .review-section-content').html(paymentText);
            
            // Show review sections and terms checkbox
            $('.review-sections').show();
            $('.form-check').show();
            $('.success-message').hide();
            $('.d-flex.justify-content-between.mt-4').show();
        }

        // Payment method details toggle
        $('input[name="payment_method"]').change(function() {
            $('.payment-method-body').addClass('d-none');
            $(this).closest('.payment-method').find('.payment-method-body').removeClass('d-none');
        });

        // Initialize first payment method as active
        $('input[name="payment_method"]:first').trigger('change');
        
        // Show first step initially
        $('.checkout-form').removeClass('active');
        $('.checkout-form[data-form="1"]').addClass('active');
    });
</script>
@endsection
