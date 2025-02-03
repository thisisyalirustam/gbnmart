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
                <form id="orderForm" name="orderForm" method="POST" enctype="multipart/form-data">
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
                                            <label for="country">Country</label>
                                            <select class="form-control custom-country" id="country_id" name="country_id">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="state">State</label>
                                            <select class="form-control custom-country" id="state_id" name="state_id"
                                                disabled>
                                                <option value="">Select State</option>
                                            </select>
                                            <p></p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="city">City</label>
                                            <select class="form-control custom-country" id="city_id" name="city_id"
                                                disabled>
                                                <option value="">Select City</option>
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="zip-code">Zip Code</label>
                                            <input type="text" class="form-control" id="zip-code" name="zip_code"
                                                placeholder="10001">
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
                                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                            {{ $item->unit }}
                                            <input type="text" class="form-control" id="unit_id"
                                                value="{{ $item->unit_id }}" hidden>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span id="subtotal">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div>
                                    <strong>Discount: </strong><span id="discount">$0.00</span>
                                    <input type="hidden" name="discount" id="coupon-input" value="0">
                                    <input type="hidden" name="coupon_code" id="coupon_code" value="">

                                </div>
                                <div>
                                    <strong>Shipping Charge: </strong><span id="shipping-charge">$0.00</span>
                                    <input type="hidden" name="shipping_charge" id="shipping-charge-input"
                                        value="0">
                                </div>
                                <div class="checkout__order__total">Total <span
                                        id="grand_total">${{ number_format($subtotal, 2) }}</span>
                                </div>


                                <div class="shoping__discount mt-1 mb-2">
                                    <h5>Discount Codes</h5>

                                    <input type="text" class="form-control" id="coupon" name="coupon"
                                        placeholder="Enter your coupon code">
                                    <button type="button" class="site-btn btn-sm" id="coupon_button">APPLY
                                        COUPON</button>
                                    <span id="coupon-message" class="text-danger"></span>
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
                                        <input type="file" id="bank-screenshot" name="bank_invoice">
                                        <p>Bank Name: EasyPaisa</p>
                                        <p>Account Details: 03157773112</p>
                                    </div>
                                    <div id="paypal-details" style="display:none;">
                                        <p>You will be redirected to PayPal for payment.</p>
                                    </div>
                                    <div id="credit-details" style="display:none;">
                                        <p>Please enter your credit card details below:</p>
                                        <label for="credit-card-number">Card Number</label>
                                    <input type="text" class="form-control" id="credit-card-number" name="credit_card_number" placeholder="1234 5678 9012 3456" >
                                    <label for="credit-expiration">Expiration Date</label>
                                    <input type="text" class="form-control" id="credit-expiration" name="credit_expiration" placeholder="MM/YY" >
                                    <label for="credit-cvc">CVC</label>
                                    <input type="text" class="form-control" id="credit-cvc" name="credit_cvc" placeholder="123" >
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
@endsection
