@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Order Dashboard</h1>
        <nav class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">order</li>
            </ol>
        </nav>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Card Section Styling */
        .custom-dashboard-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .custom-dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .custom-card-body {
            text-align: center;
        }

        .custom-card-icon {
            font-size: 3rem;
        }

        .custom-card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .custom-card-text {
            font-size: 1.5rem;
            color: #333;
        }

        .text-primary {
            color: #007bff !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .font-weight-bold {
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .custom-dashboard-card {
                margin-bottom: 1rem;
            }
        }

        .navbar {
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-item .nav-link {
            font-size: 1.1rem;
            color: #333;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-item .nav-link i {
            font-size: 1.3rem;
        }
    </style>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <!-- Navbar -->



                <!-- Card Section -->
                <div class="card">
                    <div class="card-body">


                        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                            <div class="container-fluid justify-content-center">
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('order.all')}}">
                                                <i class="fas fa-list-alt me-2"></i>All Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('order.active')}}">
                                                <i class="fas fa-clock me-2"></i>Active Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('order.return')}}">
                                                <i class="fas fa-undo me-2"></i>Return Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('order.compelete')}}">
                                                <i class="fas fa-check-circle me-2"></i>Complete Orders
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark px-3 py-2 mx-2 rounded-pill" href="{{route('admin.rating_review')}}">
                                                <i class="fas fa-user-cog me-2"></i>Rating And Review
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <hr>
                        <div class="container my-4">
                            <!-- Row for main cards -->
                            <div class="row text-center">
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-shopping-cart custom-card-icon text-primary"></i>
                                            <h5 class="custom-card-title text-primary mt-3">Today's Orders</h5>
                                            <p id="todaysSales" class="custom-card-text font-weight-bold">
                                                {{ $todayorders }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-dollar-sign custom-card-icon text-success"></i>
                                            <h5 class="custom-card-title text-success mt-3">Total Sales</h5>
                                            <p id="totalSales" class="custom-card-text font-weight-bold">
                                                {{ $totalSalesCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-money-bill-wave custom-card-icon text-warning"></i>
                                            <h5 class="custom-card-title text-warning mt-3">Total Income</h5>
                                            <p id="totalIncome" class="custom-card-text font-weight-bold">
                                                {{ number_format($totalIncomeAmount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-clock custom-card-icon text-danger"></i>
                                            <h5 class="custom-card-title text-danger mt-3">Pending Orders</h5>
                                            <p id="pendingOrders" class="custom-card-text font-weight-bold">
                                                {{ $pendingOrdersCount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Row for additional cards -->
                            <div class="row text-center">
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-calendar-alt custom-card-icon text-primary"></i>
                                            <a href="#table">
                                                <h5 class="custom-card-title text-primary mt-3">Monthly Sales</h5>
                                            </a>
                                            <p id="monthlySales" class="custom-card-text font-weight-bold">
                                                {{ $monthlySalesCount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-calendar-day custom-card-icon text-success"></i>
                                            <h5 class="custom-card-title text-success mt-3">Monthly Income</h5>
                                            <p id="monthlyIncome" class="custom-card-text font-weight-bold">
                                                {{ number_format($monthlyIncomeAmount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card custom-dashboard-card shadow-lg rounded">
                                        <div class="custom-card-body p-4">
                                            <i class="fas fa-calendar-check custom-card-icon text-warning"></i>
                                            <h5 class="custom-card-title text-warning mt-3">Today's Sales</h5>
                                            <p id="todaysIncome" class="custom-card-text font-weight-bold">
                                                {{ $todaysSalesCount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                       
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                    <h5 class="card-title text-danger mt-3">Are You Sure?</h5>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <form id="deleteForm" class="delete-form">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE"> <!-- Method override for DELETE -->
                    <input type="hidden" id="deleteid" name="id" value="">
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary delet-model"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger delete-btn">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Trigger button for the modal -->


    <!-- Modal Structure -->
    <div class="modal fade" id="show" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header with Custom Styling -->
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-dark">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Order ID -->
                        <div class="col-md-6 mb-3">
                            <h6><strong>Order ID:</strong> <span id="order-id">#123456</span></h6>
                        </div>

                        <!-- Customer Name -->
                        <div class="col-md-6 mb-3">
                            <h6><strong>Customer Name:</strong> <span id="customer-name">John Doe</span></h6>
                        </div>

                        <!-- Product Details Section -->
                        <div class="col-12 mb-3">
                            <h6><strong>Product Details:</strong></h6>
                            <table class="table table-bordered" id="product-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product Rows will be dynamically populated -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-md-6 mb-3">
                            <h6><strong>Order Total:</strong> <span id="order-total">$130</span></h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6><strong>Shipping Address:</strong> <span id="shipping-address">123 Main St, New York,
                                    NY</span></h6>
                        </div>

                        <!-- Order Status -->
                        <div class="col-md-6 mb-3">
                            <h6><strong>Status:</strong> <span id="order-status">Shipped</span></h6>
                        </div>

                        <!-- Payment Information -->
                        <div class="col-md-6 mb-3">
                            <h6><strong>Payment Method:</strong> <span id="payment-method">Credit Card (Visa)</span></h6>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    {{-- User Delete Modal --}}
    {{-- <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                    <h5 class="card-title text-danger mt-3">Are You Sure?</h5>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <form id="deleteForm" class="delete-form">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" id="deleteid" name="id" value="">
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger delete-btn">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection

@section('tabledev')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('admin/ajax_crud/orders.js') }}"></script>
@endsection
