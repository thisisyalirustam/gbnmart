@extends('admin.layout.content')

@section('content')
<div class="pagetitle">
    <h1>Product Management Dashboard</h1>
    <nav class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6f9;
    }

    /* Card Styling */
    .dashboard-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-icon {
        font-size: 2.5rem;
        color: #ffffff;
        background: linear-gradient(45deg, #007bff, #00aaff);
        padding: 15px;
        border-radius: 50%;
        margin-bottom: 10px;
        display: inline-block;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 1.8rem;
        font-weight: 700;
        color: #34495e;
    }

    /* Navigation Styling */
    .nav-tabs {
        border-bottom: none;
        justify-content: center;
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        background: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        margin: 0 10px;
        padding: 10px 20px;
        font-weight: 500;
        color: #34495e;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-link.active {
        background: linear-gradient(45deg, #007bff, #00aaff);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }

    .nav-tabs .nav-link i {
        margin-right: 8px;
    }

    /* Table Styling */
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background: #f8f9fa;
        color: #34495e;
        font-weight: 600;
    }

    .table td {
        vertical-align: middle;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(45deg, #007bff, #00aaff);
        color: #ffffff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .modal-title {
        font-weight: 600;
    }

    .modal-body {
        padding: 30px;
    }

    /* Quick Actions */
    .quick-actions {
        margin-bottom: 20px;
    }

    .quick-actions .btn {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-card {
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            margin: 5px;
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .quick-actions .btn {
            margin-bottom: 10px;
        }
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Quick Actions -->
                    <div class="quick-actions mt-4">
                        <h5 class="mb-3">Quick Actions</h5>
                        <div class="d-flex justify-content-center flex-wrap gap-2">
                            <a href="" class="btn btn-primary btn-sm"><i class="fas fa-plus me-2"></i>Add Product</a>
                            <a href="" class="btn btn-success btn-sm"><i class="fas fa-plus me-2"></i>Add Category</a>
                            <a href="" class="btn btn-warning btn-sm"><i class="fas fa-plus me-2"></i>Add Brand</a>
                            <a href="" class="btn btn-info btn-sm"><i class="fas fa-plus me-2"></i>Add Collection</a>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs mt-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('product.index') }}"><i class="fas fa-boxes"></i> Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product-cat.index') }}"><i class="fas fa-layer-group"></i> Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product-sub-cat.index') }}"><i class="fas fa-sitemap"></i> Sub Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product-brand.index') }}"><i class="fas fa-tags"></i> Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products.collection.index')}}"><i class="fas fa-th-large"></i> Collections</a>
                        </li>
                    </ul>

                    <!-- Card Section -->
                    <div class="container my-4">
                        <div class="row text-center">
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <i class="fas fa-boxes card-icon"></i>
                                        <h5 class="card-title">Total Products</h5>
                                        <p id="totalProducts" class="card-text">{{$product_cont}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <i class="fas fa-layer-group card-icon"></i>
                                        <h5 class="card-title">Total Categories</h5>
                                        <p id="totalCategories" class="card-text">{{$product_cat}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <i class="fas fa-tags card-icon"></i>
                                        <h5 class="card-title">Total Brands</h5>
                                        <p id="totalBrands" class="card-text">{{$product_brand}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Table -->
                    <div class="container my-4" id="table">
                        <h5 class="mb-3">Recent Products</h5>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                <!-- Dynamically populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
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
</div>

<!-- Product Details Modal -->
<div class="modal fade" id="show" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6><strong>Product ID:</strong> <span id="product-id"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Product Name:</strong> <span id="product-name"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Category:</strong> <span id="product-category"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Sub Category:</strong> <span id="product-subcategory"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Brand:</strong> <span id="product-brand"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Collection:</strong> <span id="product-collection"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Price:</strong> <span id="product-price"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Discount:</strong> <span id="product-discount"></span></h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6><strong>Status:</strong> <span id="product-status"></span></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="edit-product" href="#" class="btn btn-primary">Edit Product</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('tabledev')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="{{ asset('admin/ajax_crud/products.js') }}"></script>
@endsection