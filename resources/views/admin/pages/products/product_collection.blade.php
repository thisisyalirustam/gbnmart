@extends('admin.layout.content')

@section('content')
<style>
    :root {
        --primary-color: #1a73e8;
        --secondary-color: #f1f3f5;
        --text-color: #202124;
        --border-color: #e0e0e0;
        --danger-color: #d32f2f;
    }

    .pagetitle {
        margin-bottom: 2rem;
    }

    .pagetitle h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #1557b0;
    }

    .breadcrumb-item.active {
        color: #5f6368;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-body {
        padding: 2rem;
    }

    .collection-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1.5rem;
    }

    .alert {
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: #e6f4ea;
        color: #1e4620;
        border: 1px solid #c3e6cb;
    }

    .alert-warning {
        background: #fff4e5;
        color: #663c00;
        border: 1px solid #ffd699;
    }

    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: var(--secondary-color);
        color: var(--text-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr {
        background: #fff;
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .table img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease;
    }

    .table img:hover {
        transform: scale(1.05);
    }

    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
        color: var(--text-color);
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .btn-remove {
        background: var(--danger-color);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        background: #b71c1c;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-remove i {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        .table td, .table th {
            font-size: 0.85rem;
            padding: 0.75rem;
        }
    }
</style>

<div class="pagetitle">
    <h1>Products in Collection</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="">Collections</a></li>
            <li class="breadcrumb-item active">{{ $collection->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="collection-title">Products in <strong>"{{ $collection->name }}"</strong></h4>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($products->isEmpty())
                        <div class="alert alert-warning">No products found in this collection.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">price</th>
                                        <th scope="col" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @php
                                                    $images = json_decode($product->images, true);
                                                    $firstImage = $images[0] ?? 'default.jpg';
                                                @endphp
                                                @if($firstImage)
                                                    <img src="{{ asset('images/products/' . $firstImage) }}" alt="{{ $product->name }}" />
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{!! Str::limit($product->description, 100) !!}</td>
                                             <td>
                                                @if($product->discounted_price && $product->discounted_price < $product->price)
                                                    <span class="price-discounted">${{ number_format($product->discounted_price, 2) }}</span>
                                                    <span class="price-original">${{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span>${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('collection.product.remove', [$collection->id, $product->id]) }}" onsubmit="return confirm('Are you sure you want to remove this product from the collection?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-remove">
                                                        <i class="bi bi-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('admin.layout.content')

@section('content')
<style>
    :root {
        --primary-color: #1a73e8;
        --secondary-color: #f1f3f5;
        --text-color: #202124;
        --border-color: #e0e0e0;
        --danger-color: #d32f2f;
    }

    .pagetitle {
        margin-bottom: 2rem;
    }

    .pagetitle h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #1557b0;
    }

    .breadcrumb-item.active {
        color: #5f6368;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-body {
        padding: 2rem;
    }

    .collection-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1.5rem;
    }

    .alert {
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: #e6f4ea;
        color: #1e4620;
        border: 1px solid #c3e6cb;
    }

    .alert-warning {
        background: #fff4e5;
        color: #663c00;
        border: 1px solid #ffd699;
    }

    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: var(--secondary-color);
        color: var(--text-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr {
        background: #fff;
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .table img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease;
    }

    .table img:hover {
        transform: scale(1.05);
    }

    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
        color: var(--text-color);
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .price-discounted {
        color: #d32f2f;
        font-weight: 600;
    }

    .price-original {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.85rem;
        margin-left: 0.5rem;
    }

    .btn-remove {
        background: var(--danger-color);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        background: #b71c1c;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-remove i {
        font-size: 1rem;
    }

    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
    }

    .modal-body {
        padding: 1.5rem;
        font-size: 1rem;
        color: var(--text-color);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
    }

    .btn-modal-cancel {
        background: #f1f3f5;
        color: var(--text-color);
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .btn-modal-cancel:hover {
        background: #e0e0e0;
    }

    .btn-modal-confirm {
        background: var(--danger-color);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .btn-modal-confirm:hover {
        background: #b71c1c;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        .table td, .table th {
            font-size: 0.85rem;
            padding: 0.75rem;
        }
    }
</style>

<div class="pagetitle">
    <h1>Products in Collection</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="">Collections</a></li>
            <li class="breadcrumb-item active">{{ $collection->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="collection-title">Products in <strong>"{{ $collection->name }}"</strong></h4>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($products->isEmpty())
                        <div class="alert alert-warning">No products found in this collection.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @php
                                                    $images = json_decode($product->images, true);
                                                    $firstImage = $images[0] ?? 'default.jpg';
                                                @endphp
                                                @if($firstImage)
                                                    <img src="{{ asset('images/products/' . $firstImage) }}" alt="{{ $product->name }}" />
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if($product->discounted_price && $product->discounted_price < $product->price)
                                                    <span class="price-discounted">${{ number_format($product->discounted_price, 2) }}</span>
                                                    <span class="price-original">${{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span>${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>{!! Str::limit($product->description, 100) !!}</td>
                                            <td>
                                                <button type="button" class="btn btn-remove" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>

                                                <!-- Delete Confirmation Modal -->
                                                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Removal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to remove <strong>{{ $product->name }}</strong> from the collection <strong>{{ $collection->name }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                                                                <form method="POST" action="{{ route('collection.product.remove', [$collection->id, $product->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-modal-confirm">Remove</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Ensure Bootstrap modals work with dynamic content
    document.addEventListener('DOMContentLoaded', function () {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                // Ensure modal is properly initialized
                var bootstrapModal = new bootstrap.Modal(modal);
            });
        });
    });
</script>
@endsection