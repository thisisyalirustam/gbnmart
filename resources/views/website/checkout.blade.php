@extends('website.layout.content')
@section('webcontent')
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form id="orderForm" name="orderForm" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <!-- Billing Details -->
                        <div class="col-lg-8 col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Personal Information</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="John">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="example@domain.com">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="phone">phone</label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                placeholder="0315131313">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="card mb-3">
                                <div class="card-header">Shipping Address</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="address">Street Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="1234 Main St">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="New York">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="NY">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="zip-code">Zip Code</label>
                                            <input type="text" class="form-control" id="zip-code" name="zip_code"
                                                placeholder="10001">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="country">Country</label>
                                            <select class="form-control custom-country" id="country" name="country_id">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartItems as $item)
                                        <li>{{ $item->name }} (x{{ $item->quantity }})
                                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span>${{ number_format($subtotal, 2) }}</span></div>
                                <div class="checkout__order__total">Total <span>${{ number_format($subtotal, 2) }}</span>
                                </div>

                                <!-- Payment Methods -->
                                <h5>Payment Method</h5>
                                <div class="checkout__input__checkbox">
                                    <label for="payment-cash">
                                        Cash on Delivery
                                        <input type="radio" id="payment-cash" name="payment_method" value="cash"
                                            onclick="showPaymentDetails('cash')">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment-bank">
                                        Direct Bank Transfer
                                        <input type="radio" id="payment-bank" name="payment_method" value="bank"
                                            onclick="showPaymentDetails('bank')">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment-paypal">
                                        Paypal
                                        <input type="radio" id="payment-paypal" name="payment_method" value="paypal"
                                            onclick="showPaymentDetails('paypal')" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment-credit">
                                        Credit Card
                                        <input type="radio" id="payment-credit" name="payment_method" value="credit"
                                            onclick="showPaymentDetails('credit')">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <!-- Additional Payment Details -->
                                <div id="payment-details" style="display:none; margin-top: 20px;">
                                    <div id="cash-details" style="display:none;">
                                        <p>Thank you for choosing Cash on Delivery. Please prepare the exact amount.</p>
                                    </div>
                                    <div id="bank-details" style="display:none;">
                                        <p>Please send a screenshot of your bank transfer.</p>
                                        <label for="bank-screenshot">Upload Screenshot:</label>
                                        <input type="file" id="bank-screenshot" name="bank_invoice"
                                            >
                                        <p>Bank Name: EasyPaisa</p>
                                        <p>Account Details: 03157773112</p>
                                    </div>
                                    <div id="paypal-details" style="display:none;">
                                        <p>You will be redirected to PayPal for payment.</p>
                                    </div>
                                    <div id="credit-details" style="display:none;">
                                        {{-- <p>Please enter your credit card details below:</p>
                                    <label for="credit-card-number">Card Number</label>
                                    <input type="text" class="form-control" id="credit-card-number" name="credit_card_number" placeholder="1234 5678 9012 3456" >
                                    <label for="credit-expiration">Expiration Date</label>
                                    <input type="text" class="form-control" id="credit-expiration" name="credit_expiration" placeholder="MM/YY" >
                                    <label for="credit-cvc">CVC</label>
                                    <input type="text" class="form-control" id="credit-cvc" name="credit_cvc" placeholder="123" > --}}
                                    </div>
                                </div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!-- Modal HTML (hidden by default) -->
<!-- Modal HTML (hidden by default) -->
<!-- Modal HTML (hidden by default) -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Thank You for Shopping!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your order has been placed successfully. We will process your order and send you a confirmation email shortly.</p>
                <p>Order Summary:</p>
                <ul id="orderSummary" class="list-unstyled">
                    <!-- Order details will be inserted here dynamically -->
                </ul>
                <p>Thank you for shopping with us!</p>
            </div>
            <div class="modal-footer">
                <!-- Button to refresh the page when clicked -->
                <button type="button" class="btn btn-primary" id="closeModalButton" data-bs-dismiss="modal" onclick="refreshPage()">OK</button>
            </div>
        </div>
    </div>
</div>




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

        $(document).ready(function() {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle form submission with AJAX
    $("#orderForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: '{{ route('checkout.process') }}', // Your checkout processing route
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            dataType: 'JSON',
            success: function(response) {
                if (response.status === true) {
                    // Redirect to the Thank You page using the order ID from the JSON response
                    window.location.href = '/thank-you/' + response.orderId;
                } else {
                    // Handle errors (if any)
                    alert("There was an error with your order. Please try again.");
                }
            },
            error: function(xhr, status, error) {
                // Handle unexpected errors
                console.error(xhr.responseText);
            }
        });
    });
});





    </script>

@endsection
