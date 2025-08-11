@extends('admin.layout.content')
@section('content')
<style>
    .pagetitle {
        margin-bottom: 20px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
        padding: 15px;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .dx-datagrid .dx-data-row>td.bullet {
        padding-top: 0;
        padding-bottom: 0;
    }

    .stats-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .stats-card h5 {
        margin-bottom: 10px;
        color: #6c757d;
    }

    .stats-card h2 {
        margin: 0;
        color: #007bff;
    }

    .blog-table {
        margin-top: 20px;
    }

    .btn-create {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-create:hover {
        background-color: #218838;
    }

    .search-bar {
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 5px;
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .action-btn {
        margin-right: 10px;
        padding: 5px 10px;
        font-size: 14px;
    }

    .pagination {
        margin-top: 20px;
    }
    .custom-img-size {
    width: 600px;
    height: 400px;
    object-fit: cover;
}

</style>


<div class="pagetitle">
<h1>Blogs Management</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Blogs</li>
        <li class="breadcrumb-item active">Data</li>
    </ol>
</nav>
</div>

<section class="section">
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="product__details__pic">
            <div class="product__details__pic__item">
                <!-- Show the first image as the main display -->
                <img class="custom-img-size" src="{{ asset($blogitem->image) }}" alt="">

            </div>
        </div>
    </div>
</div>


<div class="row">
    
    <div class="col-lg-12">
        
        <div class="card">
            <div class="card-header">
                {{$blogitem->title}}
            </div>
            <div class="card-body">
                {!! $blogitem->content !!}
            </div>
        </div>
    </div>
</div>
</section>
@endsection