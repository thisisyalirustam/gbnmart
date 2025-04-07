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
    <!-- Stats Cards -->
    <div class="col-lg-4 col-md-6">
        <div class="stats-card">
            <h5>Total Blogs</h5>
            <h2>125</h2>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="stats-card">
            <h5>Published Blogs</h5>
            <h2>95</h2>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="stats-card">
            <h5>Draft Blogs</h5>
            <h2>30</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Blog List
            </div>
            <div class="card-body">
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search blogs..." style="max-width: 300px;">
                    <button class="btn-create mt-2" onclick="window.location.href='{{route('admin.blog.create')}}'">Create New Blog</button>
                </div>

                <!-- Blogs Table -->
                <div class="table-responsive blog-table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Top 10 eCommerce Trends</td>
                                <td>John Doe</td>
                                <td><span class="badge bg-success">Published</span></td>
                                <td>2023-10-15</td>
                                <td>
                                    <button class="btn btn-sm btn-primary action-btn">Edit</button>
                                    <button class="btn btn-sm btn-danger action-btn">Delete</button>
                                    <button class="btn btn-sm btn-warning action-btn">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>How to Optimize Your Store</td>
                                <td>Jane Smith</td>
                                <td><span class="badge bg-warning">Draft</span></td>
                                <td>2023-10-14</td>
                                <td>
                                    <button class="btn btn-sm btn-primary action-btn">Edit</button>
                                    <button class="btn btn-sm btn-danger action-btn">Delete</button>
                                    <button class="btn btn-sm btn-warning action-btn">View</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="pagination" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</section>
@endsection