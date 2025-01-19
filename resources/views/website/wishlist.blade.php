@extends('website.layout.content')
@section('webcontent')

<!-- Hero Section End -->
     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section set-bg" data-setbg="{{ asset('website/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Your Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Your Wishlist</span>
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
                    <div class="shoping__cart__table">
                        <div class="row">
                            <div class="col-md-3">
                          <h3>Wishlist</h3>
                          <hr>
                            </div>
                        </div>
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
                            {{-- <tbody>

                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-1.jpg" alt="">
                                        <h5>Vegetable’s Package</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $55.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>

                                    <td class="shoping__cart__item__close">
                                      <a href="" class="">Add To Cart</a>
                                    </td>
                                </tr>

                            </tbody> --}}
                            <tbody>
                                @foreach ($wishlist as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        @if($item->product)
                                            <!-- Display first product image -->
                                            @php
                                                // Decode the JSON and get the first image if product exists
                                                $images = json_decode($item->product->images, true); // Assuming image is stored as a JSON array
                                                $firstImage = $images[0] ?? ''; // Safely get the first image or default to an empty string
                                            @endphp
                                            <img src="{{ asset('imges/products/' . $firstImage) }}" alt="{{ $item->product->name }}">
                                            <h5>{{ $item->product->name }}</h5>
                                        @else
                                            <p>No product found</p> <!-- Handle case where product is not found -->
                                        @endif
                                    </td>
                                    <td class="shoping__cart__price">
                                        @if($item->product)
                                            ${{ number_format($item->product->price, 2) }}  <!-- Display product price -->
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1"> <!-- You can make this dynamic if needed -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="" class="btn btn-danger">Remove</a>
                                        <a href="" class="btn btn-primary">Add to Cart</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>



                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
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
                            <li>Subtotal <span>$454.98</span></li>
                            <li>Total <span>$454.98</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Shoping Cart Section End -->
@endsection
