@extends('website.layout.content')
@section('webcontent')
    <h1 class="app-page-title">Order Details</h1>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Order #{{ $ordershow->id }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order #{{ $ordershow->id }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Order Detail -->
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Items Table -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>All Items</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Items</h5>
                            <ul class="list-group">
                                @foreach ($ordershow->items as $item)
                                    <li class="list-group-item d-flex align-items-start border-bottom">
                                        <img src="{{ asset('images/products/' . $item->product->images) }}" alt="Product"
                                            class="img-thumbnail mr-3"
                                            style="width: 80px; height: 80px; border-radius: 8px;">

                                        <div class="d-flex flex-column flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <small class="text-muted">Product Name</small>
                                                    <h6 class="mb-0">{{ $item->product->name }}</h6>

                                                </div>
                                                <div>
                                                    <small class="text-muted">Quantity</small>
                                                    <p class="mb-0">{{ $item->quantity }}</p>
                                                </div>
                                                <div>
                                                    <small class="text-muted">Price</small>
                                                    <p class="mb-0">${{ number_format($item->product->price, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="progress mt-2" style="height: 5px;">
                                                @if ($ordershow->total_items > 0)
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ ($item->quantity / $ordershow->total_items) * 100 }}%;"
                                                        aria-valuenow="{{ $item->quantity }}" aria-valuemin="0"
                                                        aria-valuemax="{{ $ordershow->total_items }}"></div>
                                                @else
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 100%;" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="1"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>

                    <!-- Cart Totals -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Cart Totals</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Subtotal:</span>
                                    <span
                                        class="font-weight-bold">${{ number_format($ordershow->items->sum(fn($item) => $item->quantity * $item->product->price), 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Shipping:</span>
                                    <span class="font-weight-bold">${{ number_format($ordershow->shipping, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Tax (GST):</span>
                                    <span class="font-weight-bold">${{ number_format($ordershow->tax, 2) }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    <span>Total Price:</span>
                                    <span class="text-danger">${{ number_format($ordershow->grand_total, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>



                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Summary -->



                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-bold">Order Updates</h5>
                        </div>

                        <div class="card-body text-center">
                            <div id="message" class="alert d-none"></div> <!-- Message area -->

                            @if ($ordershow->delivered_date)
                                <h5 class="text-primary" id="delivered-date">
                                    {{ $ordershow->delivered_date->format('d M Y') }}</h5>
                            @else
                                <h5 class="text-danger" id="delivered-date">No delivery date set</h5>
                            @endif

                            <h5 class="mt-3 font-weight-bold">Shipping Status: <span
                                    id="shipping-status">{{ $ordershow->shipping_status }}</span></h5>
                            @if ($ordershow->delivered_date && $ordershow->shipping_status == 'Delivered')
                                <form id="shipping-status-form" class="mt-4">
                                    @csrf
                                    <select class="form-control" name="shipping_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Return">Return</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary mt-2" type="submit">Update Status</button>
                                </form>
                            @else
                                <h5>When your order is delivered You can check and return Your Order</h5>
                            @endif

                        </div>
                    </div>

                    <!-- Include jQuery -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Handle delivery date form submission
                            // Handle shipping status form submission
                            $('#shipping-status-form').on('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission
                                let formData = $(this).serialize(); // Serialize form data
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ route('website.orders.updateShippingStatus', $ordershow->id) }}",
                                    data: formData,
                                    success: function(response) {
                                        // Update the message and shipping status
                                        $('#message').removeClass('d-none alert-danger').addClass(
                                                'alert-success')
                                            .text('Shipping status updated successfully!').fadeIn();
                                        $('#shipping-status').text(response.shipping_status);

                                        // Update the header for shipping status
                                        $('.card-header h5').text('Shipping Status: ' + response
                                            .shipping_status);

                                        setTimeout(function() {
                                            $('#message').fadeOut();
                                        }, 3000);
                                    },
                                    error: function(xhr) {
                                        $('#message').removeClass('d-none alert-success').addClass(
                                                'alert-danger')
                                            .text('Error updating shipping status: ' + xhr.responseJSON.message)
                                            .fadeIn();
                                    }
                                });
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
@endsection
