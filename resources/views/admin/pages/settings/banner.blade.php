@extends('admin.layout.content')

@section('content')
    <div class="pagetitle">
        <h1>Website Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Website Settings</li>
                <li class="breadcrumb-item active">Update Settings</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <!-- Left Column (Form with fields) -->
            <div class="col-xl-5">
                <div class="card shadow-sm border-light">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h4>Create New Banner</h4>
                        <form id="bannerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Banner Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="percentage" class="form-label">Percentage</label>
                                <input type="text" class="form-control" id="percentage" name="percentage">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subcategory_id" class="form-label">Subcategory</label>
                                <select class="form-control" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select class="form-control" id="brand_id" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Create Banner</button>
                        </form>

                        <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                            Banner created successfully!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (3 Cards per Row) -->
            <div class="col-xl-7" style="background-color: #f9f9f9; border-left: 1px solid #ddd;">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-light h-100">
                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Category: {{ $product->product_cat->name ?? 'N/A' }}</li>
                                        <li class="list-group-item">Subcategory: {{ $product->product_sub_category->name ?? 'N/A' }}</li>
                                        <li class="list-group-item">Brand: {{ $product->product_brand->name ?? 'N/A' }}</li>
                                        <li class="list-group-item">Percentage: {{ $product->percentage }}%</li>
                                    </ul>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    Created at: {{ $product->created_at->format('d-m-Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle the form submission
            $('#bannerForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this);

                // Make the AJAX request
                $.ajax({
                    url: "{{ route('banners.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Display success message
                            $('#successMessage').show().fadeOut(5000);
                            $('#bannerForm')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            // Handle the validation errors here
                            alert(errors);
                        }
                    }
                });
            });
        });
    </script>

@endsection

@section('tabledev')
    <!-- Custom scripts for this page -->
@endsection
