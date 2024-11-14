@extends('website.layout.content')
@section('webcontent')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('website/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (count($cartItems) > 0)
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{ asset('images/products/' . $item->first_image) }}"
                                                    alt="{{ $item->name }}" width="50" height="50">
                                                <h5>{{ $item->name }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ $item->price }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <form action="{{ route('cart.update.quantity', $item->product_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="quantity">
                                                        <div class="">
                                                            <input type="number" name="quantity"
                                                                value="{{ $item->quantity }}" min="1">
                                                        </div>
                                                    </div>
                                                </form>

                                            </td>
                                            <td class="shoping__cart__total" id="item-total-{{ $item->product_id }}">
                                                {{ number_format($item->quantity * $item->price, 2) }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="icon_close"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Your cart is empty.</p>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('shoppage')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="{{route('shoppage')}}" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span id="cart-subtotal">{{ number_format($subtotal, 2) }}</span></li>
                            <li>Total <span id="cart-total">{{ number_format($subtotal, 2) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle quantity update via AJAX
            $('input[name="quantity"]').on('change', function(e) {
                e.preventDefault(); // Prevent the form's default submission behavior

                let quantity = $(this).val();
                let productId = $(this).closest('form').attr('action').split('/').pop();

                // Send AJAX request to update quantity without refreshing
                $.ajax({
                    url: `/cart/update-quantity/${productId}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        // Update the item total and cart subtotal without refreshing the page
                        $(`#item-total-${productId}`).text(response.itemTotal.toFixed(2));
                        $('#cart-subtotal').text(response.subtotal.toFixed(2));
                        $('#cart-total').text(response.subtotal.toFixed(
                        2)); // Update total if subtotal and total are the same
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                // Prevent the form from submitting and redirecting
                return false;
            });
        });
    </script>


@endsection
