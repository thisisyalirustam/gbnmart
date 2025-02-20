@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product Category</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div>

    <style>
        .dx-datagrid .dx-data-row > td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }
        .col-md-3:hover {
    transform: scale(1.05);
    transition: transform 0.2s;

}
.custom-dashboard-card {
            height: 100px; /* Adjusted height */
        }
        .custom-card-body {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .custom-card-icon {
            font-size: 2.5rem; /* Icon size */
            margin-right: 15px; /* Space between icon and text */
        }
        .custom-card-title {
            font-size: 1.2rem; /* Title font size */
            margin-bottom: 0; /* Remove bottom margin */
        }
        .custom-card-text {
            font-size: 1.5rem; /* Value font size */
            margin-bottom: 0; /* Remove bottom margin */
        }

        .modal-header {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 500;
    }

    .modal-footer {
        border-top: 2px solid #dee2e6;
    }

    /* Product Image in the table */
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    /* Custom table styles */
    .table {
        font-size: 1rem;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    /* Responsive adjustments for small screens */
    @media (max-width: 767px) {
        .table th, .table td {
            font-size: 0.9rem;
        }

        .product-img {
            width: 40px;
            height: 40px;
        }
    }

    /* Button Style for Modal */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    </style>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="bi bi-plus-lg"></i> Add New
                        </button>
                        <hr>
                        <div class="container my-4">
                            <a href="">
                            <div class="row text-center">
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #007bff;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-shopping-cart custom-card-icon text-primary"></i>
                                            <div>
                                                <h5 class="custom-card-title text-primary">Today's Orders</h5>
                                                <p id="todaysSales" class="custom-card-text">{{ $todayorders }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #28a745;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-dollar-sign custom-card-icon text-success"></i>
                                            <div>
                                                <h5 class="custom-card-title text-success">Total Sales</h5>
                                                <p id="totalSales" class="custom-card-text">{{ $totalSalesCount }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #ffc107;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-money-bill-wave custom-card-icon text-warning"></i>
                                            <div>
                                                <h5 class="custom-card-title text-warning">Total Income</h5>
                                                <p id="totalIncome" class="custom-card-text">{{ number_format($totalIncomeAmount, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #dc3545;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-clock custom-card-icon text-danger"></i>
                                            <div>
                                                <h5 class="custom-card-title text-danger">Pending Orders</h5>
                                                <p id="pendingOrders" class="custom-card-text">{{ $pendingOrdersCount }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #007bff;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-calendar-alt custom-card-icon text-primary"></i>
                                            <div>
                                               <a href="#table"><h5 class="custom-card-title text-primary">Monthly Sales</h5></a>
                                                <p id="monthlySales" class="custom-card-text">{{ $monthlySalesCount }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #28a745;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-calendar-dollar custom-card-icon text-success"></i>
                                            <div>
                                                <h5 class="custom-card-title text-success">Monthly Income</h5>
                                                <p id="monthlyIncome" class="custom-card-text">{{ number_format($monthlyIncomeAmount, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-sm custom-dashboard-card" style="border-left: 5px solid #ffc107;">
                                        <div class="custom-card-body">
                                            <i class="fas fa-calendar-check custom-card-icon text-warning"></i>
                                            <div>
                                                <h5 class="custom-card-title text-warning">Today's Sales</h5>
                                                <p id="todaysIncome" class="custom-card-text">{{ $todaysSalesCount }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section id="table">
                        <div id="gridContainer" class=""></div>
                    </section>
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
                        <button type="button" class="btn btn-secondary delet-model" data-bs-dismiss="modal">Cancel</button>
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
                                    <th>Product</th>
                                    <th>Image</th>
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
                        <h6><strong>Shipping Address:</strong> <span id="shipping-address">123 Main St, New York, NY</span></h6>
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

<!-- Bootstrap 5 JS and Popper -->


<!-- Custom CSS for Styling -->
<style>
    
</style>


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
