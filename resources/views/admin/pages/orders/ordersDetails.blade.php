@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Order Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.orders') }}">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order #{{ $ordershow->id }}</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
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
                                             class="img-thumbnail mr-3" style="width: 80px; height: 80px; border-radius: 8px;">

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
                                                @if($ordershow->total_items > 0)
                                                    <div class="progress-bar" role="progressbar" style="width: {{ ($item->quantity / $ordershow->total_items) * 100 }}%;" aria-valuenow="{{ $item->quantity }}" aria-valuemin="0" aria-valuemax="{{ $ordershow->total_items }}"></div>
                                                @else
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="1"></div>
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
                                    <span class="font-weight-bold">${{ number_format($ordershow->items->sum(fn($item) => $item->quantity * $item->product->price), 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Shipping:</span>
                                    <span class="font-weight-bold">{{ number_format($ordershow->shipping, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Discount:</span>
                                    <span class="font-weight-bold">${{ number_format($ordershow->discount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    <span>Total Price:</span>
                                    <span class="text-danger">${{ number_format($ordershow->grand_total, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-center">Buyer Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                @if($ordershow->user)
                                    <img src="{{ asset('uploads/' . $ordershow->user->image) }}" alt="Profile Image" class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview" role="tabpanel">
                                        <h5 class="card-title">About</h5>
                                        <p class="small fst-italic">
                                            This contract outlines the terms and conditions between the parties involved.
                                        </p>

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Full Name</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->user->name ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">City</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->city->name ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">State</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->state->name ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->country->name ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->address ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8">({{ $ordershow->country->phonecode ?? 'N/A' }}) {{ $ordershow->phone ?? 'N/A' }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8">{{ $ordershow->email ?? 'N/A' }}</div>
                                        </div>

                                    </div>

                                @else
                                    <img src="{{ asset('images/images (9).jpeg') }}" alt="Profile Image" class="img-fluid rounded-circle me-3" style="width: 80px; height: 80px;">
                                    <div>
                                        <h6 class="mb-1 fw-bold">User Information Unavailable</h6>
                                        <p class="mb-0 text-muted">State: {{ $ordershow->state->name ?? 'N/A' }}</p>
                                        <p class="mb-0 text-muted">City: {{ $ordershow->city->name ?? 'N/A' }}</p>
                                        <p class="mb-0 text-muted">Address: {{ $ordershow->address ?? 'N/A' }}</p>
                                        <p class="mb-0 text-muted">Country: {{ $ordershow->country->name ?? 'N/A' }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    @if ($ordershow->coupon_code !=null)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-center">Vendor Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Coupon:</span>
                                    <span class="font-weight-bold">{{$vendor->coupon}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Name:</span>
                                        <span class="font-weight-bold">{{ $vendor->user->name}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Discount:</span>
                                        <span class="font-weight-bold">${{ number_format($ordershow->discount, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                        <span>Total Price:</span>
                                        <span class="text-danger">${{ number_format($ordershow->grand_total, 2) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    @endif


                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Summary -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Summary</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Order ID:</strong> #{{ $ordershow->id }}</p>
                            <p><strong>Date:</strong> {{ $ordershow->created_at->format('d M Y') }}</p>
                            <p><strong>Total:</strong> <span class="text-success">${{ number_format($ordershow->grand_total, 2) }}</span></p>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $ordershow->address }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Send Invoice</h5>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="email" value="{{$ordershow->email}}" readonly class="form-control" name="invoice" required>
                                <button class="btn btn-sm btn-primary" id="send-invoice-btn" type="submit">Send Invoice</button>
                                <div id="invoice-message" class="alert d-none mt-3"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Payment Method</h5>
                        </div>
                        <div class="card-body">
                            @if($ordershow->payment_method === 'cash')
                                <p>Payment Method: Cash on Delivery</p>
                            @elseif($ordershow->payment_method === 'bank')
                                <p>Payment Method: Bank</p>
                                @if($ordershow->bank_invoice)
                                    <div>
                                        <img
                                            src="{{ asset($ordershow->bank_invoice) }}"
                                            alt="Bank Invoice"
                                            style="width: 100%; max-height: 300px; cursor: pointer;"
                                            onclick="showFullScreen('{{ asset($ordershow->bank_invoice) }}')"
                                        >
                                    </div>
                                @else
                                    <p>No invoice available.</p>
                                @endif
                            @elseif($ordershow->payment_method === 'paypal')
                                <p>Payment Method: PayPal</p>
                            @elseif($ordershow->payment_method === 'credit')
                                <p>Payment Method: Credit</p>
                                <div>
                                    <h6>Bank Details:</h6>
                                    <ul>
                                        <li>Bank Name: Example Bank</li>
                                        <li>Account Number: 1234-5678-9012</li>
                                        <li>Routing Number: 987654321</li>
                                    </ul>
                                </div>
                            @else
                                <p>Payment Method: Not specified</p>
                            @endif
                        </div>
                    </div>

                    <!-- Full-Screen Image Modal -->
                    <div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.8); z-index:1000;">
                        <span style="position:absolute; top:20px; right:30px; color:white; font-size:30px; cursor:pointer;" onclick="closeFullScreen()">×</span>
                        <img id="modalImage" src="" style="margin:auto; display:block; max-width:90%; max-height:90%;">
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-bold">Expected Date Of Delivery</h5>
                        </div>

                        <div class="card-body text-center">
                            <div id="message" class="alert d-none"></div> <!-- Message area -->

                            @if ($ordershow->delivered_date)
                                <h5 class="text-primary" id="delivered-date">{{ $ordershow->delivered_date->format('d M Y') }}</h5>
                            @else
                                <h5 class="text-danger" id="delivered-date">No delivery date set</h5>
                            @endif

                            <h5 class="mt-3 font-weight-bold">Shipping Status: <span id="shipping-status">{{ $ordershow->shipping_status }}</span></h5>

                            @if (is_null($ordershow->delivered_date))
                                <form id="delivery-date-form" class="mt-4">
                                    @csrf
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="delivered_date" required>
                                        <button class="btn btn-sm btn-primary" type="submit">Set Delivery Date</button>
                                    </div>
                                </form>
                            @endif

                            <form id="shipping-status-form" class="mt-4">
                                @csrf
                                <select class="form-control" name="shipping_status" required>
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Process">Process</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Return">Return</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <button class="btn btn-sm btn-primary mt-2" type="submit">Update Status</button>
                            </form>
                        </div>
                    </div>

                    <!-- Include jQuery -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Handle delivery date form submission
                            $('#delivery-date-form').on('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission
                                let formData = $(this).serialize(); // Serialize form data
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ route('orders.updateDeliveryDate', $ordershow->id) }}",
                                    data: formData,
                                    success: function(response) {
                                        // Update the message and delivery date
                                        $('#message').removeClass('d-none alert-danger').addClass('alert-success')
                                                     .text('Delivery date updated successfully!').fadeIn();
                                        $('#delivered-date').text(new Date(response.delivered_date).toLocaleDateString());

                                        // Update the header for delivery date
                                        $('.card-header h5').text('Expected Date Of Delivery: ' + new Date(response.delivered_date).toLocaleDateString());

                                        setTimeout(function() {
                                            $('#message').fadeOut();
                                        }, 3000);
                                    },
                                    error: function(xhr) {
                                        $('#message').removeClass('d-none alert-success').addClass('alert-danger')
                                                     .text('Error updating delivery date: ' + xhr.responseJSON.message).fadeIn();
                                    }
                                });
                            });

                            // Handle shipping status form submission
                            $('#shipping-status-form').on('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission
                                let formData = $(this).serialize(); // Serialize form data
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ route('orders.updateShippingStatus', $ordershow->id) }}",
                                    data: formData,
                                    success: function(response) {
                                        // Update the message and shipping status
                                        $('#message').removeClass('d-none alert-danger').addClass('alert-success')
                                                     .text('Shipping status updated successfully!').fadeIn();
                                        $('#shipping-status').text(response.shipping_status);

                                        // Update the header for shipping status
                                        $('.card-header h5').text('Shipping Status: ' + response.shipping_status);

                                        setTimeout(function() {
                                            $('#message').fadeOut();
                                        }, 3000);
                                    },
                                    error: function(xhr) {
                                        $('#message').removeClass('d-none alert-success').addClass('alert-danger')
                                                     .text('Error updating shipping status: ' + xhr.responseJSON.message).fadeIn();
                                    }
                                });
                            });

                            $('#send-invoice-btn').on('click', function() {
                // Display loading message
                $('#invoice-message').removeClass('d-none alert-danger alert-success').addClass('alert-info')
                    .text('Sending email...').fadeIn();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('orders.sendInvoice', $ordershow->id) }}", // Adjust route to your controller method
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#invoice-message').removeClass('alert-info').addClass('alert-success')
                            .text('Invoice sent successfully!').fadeIn();
                        setTimeout(function() {
                            $('#invoice-message').fadeOut();
                        }, 3000);
                    },
                    error: function(xhr) {
                        $('#invoice-message').removeClass('alert-info').addClass('alert-danger')
                            .text('Error sending email: ' + xhr.responseJSON.message).fadeIn();
                    }
                });
            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>

    <script>
        function showFullScreen(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.style.display = 'block';
        }

        function closeFullScreen() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
        }


    </script>

@endsection

@section('tabledev')
<script src="{{ asset('admin/ajax_crud/orders.js') }}"></script>
@endsection
