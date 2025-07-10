@extends('website.layout.content')

@section('webcontent')

<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="current">Wishlist</li>
                </ol>
            </nav>
            <h1>Wishlist</h1>
        </div>
    </div>

    <!-- Account Section -->
    <section id="account" class="account section mb-4">
        <div class="row">
            <div class="col-lg-12 profile-content" data-aos="fade-left" data-aos-delay="300">
                <div class="tab-content" id="profileTabsContent">
                    <div class="tab-pane fade active show" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                        <div class="tab-header">
                            <h2>Wishlist</h2>
                        </div>
                        <div class="wishlist-items">
                            <div class="row" id="wishlist-container">
                                @forelse ($wishlistItems as $item)
                                <div class="col-md-6 col-lg-4 wishlist-card" data-product-id="{{ $item['product']->id ?? 0 }}">
                                    <div class="wishlist-item">
                                        <div class="wishlist-image">
                                            @php
                                                $images = json_decode($item['product']->images ?? '[]', true);
                                                $firstImage = $images[0] ?? 'website/img/placeholder-product.jpg';
                                            @endphp
                                            <img src="{{ asset('images/products/' . $firstImage) }}" alt="{{ $item['product']->name ?? 'No product' }}">
                                            <button class="remove-wishlist" type="button" data-product-id="{{ $item['product']->id ?? 0 }}">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <div class="wishlist-content">
                                            <h5>{{ $item['product']->name ?? 'Product not available' }}</h5>
                                            <div class="product-price">
                                                @if(isset($item['product']))
                                                    ${{ number_format($item['product']->price, 2) }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                            @if(isset($item['product']))
                                            <button class="btn btn-add-cart" type="button" data-product-id="{{ $item['product']->id }}">Add to cart</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center">
                                    <p>Your wishlist is empty</p>
                                    <a href="{{route('shoppage')}}" class="btn btn-primary">Continue Shopping</a>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

{{-- JavaScript Section --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Remove from Wishlist
    $(document).on('click', '.remove-wishlist', function () {
        let productId = $(this).data('product-id');
        let itemCard = $(this).closest('.wishlist-card');

        $.ajax({
            url: '{{ route("shoppage") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response) {
                if (response.success) {
                    itemCard.remove();

                    if ($('.wishlist-card').length === 0) {
                        $('#wishlist-container').html(`
                            <div class="col-12 text-center">
                                <p>Your wishlist is empty</p>
                                <a href="{{ route('shoppage') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                        `);
                    }
                }
            },
            error: function () {
                alert('Failed to remove product from wishlist.');
            }
        });
    });

    // Add to Cart
    $(document).on('click', '.btn-add-cart', function () {
        let productId = $(this).data('product-id');
        let itemCard = $(this).closest('.wishlist-card');

        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            },
            success: function (response) {
                if (response.success) {
                    alert('Product added to cart!');
                    itemCard.find('.remove-wishlist').click(); // Remove from wishlist
                }
            },
            error: function () {
                alert('Failed to add product to cart.');
            }
        });
    });
});
</script>

@endsection

