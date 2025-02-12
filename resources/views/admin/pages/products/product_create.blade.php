@extends('admin.layout.content')
@section('content')
    <link rel="stylesheet" href="{{ asset('admin/custom_css/product.css') }}">
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product Category</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>

        <section class="section">
            <div class="container">
                <div class="card shadow p-4 mb-5 bg-white rounded">
                    <form id="addform" enctype="multipart/form-data" method="POST" action="{{ route('product.store') }}"
                        class="needs-validation" novalidate>
                        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                        <h2 class="mb-3">Product Details</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- General Product Info -->
                                <div class="form-group">
                                    <label for="name" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter product name" required>
                                </div>

                                <div class="form-group">
                                    <label for="sku" class="form-label">Product SKU <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="sku" id="sku" class="form-control"
                                        placeholder="Enter SKU" required>
                                </div>
                                <div class="form-group">
                                    <label for="p_category" class="form-label">Product Category <span
                                            class="text-danger">*</span></label>
                                    <select id="p_category" name="product_category" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="p_sub_cat" class="form-label">Sub Category <span
                                            class="text-danger">*</span></label>
                                    <select id="p_sub_cat" name="sub_category" class="form-select" required>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brand" class="form-label">Brand Name</label>
                                    <select id="brand" name="brand_id" class="form-select">
                                        <option value="">Select Brand</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price" class="form-label">Price <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Enter price" required>
                                </div>

                                <div class="form-group">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" name="discount_price" id="discount_price" class="form-control"
                                        placeholder="Enter discount price (optional)">
                                </div>

                                <div class="form-group">
                                    <label for="quantity" class="form-label">Quantity <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="quantity" class="form-control"
                                        placeholder="Enter quantity in stock" required>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="shortDescription" class="form-label">
                                            Short Description <span class="text-danger mt-2">*</span>
                                        </label>
                                        <div id="shortDescriptionEditor"></div>
                                        <input type="hidden" id="shortDescription" name="short_description">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h2 class="mb-3">Add Description</h2>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="form-label">
                                    Description <span class="text-danger mt-2">*</span>
                                </label>
                                <div id="description-editor"></div>
                                <input type="hidden" id="description" name="description">
                            </div>
                        </div>

                        <div class="row mt-4 mb-5"></div>
                        <div class="row">
                            <div class="form-group ">
                                <label for="shippingInfo" class="form-label ">
                                    Shipping Information <span class="text-danger">*</span>
                                </label>
                                <div id="shippingInfoEditor"></div>
                                <input type="hidden" id="shippingInfo" name="shipping_info">
                            </div>
                        </div>
                        <div class="row mt-4 mb-5"></div>

                        <!-- Image Upload and Color Selection -->
                        <h2 class="mt-5">Additional Information</h2>
                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="weight" class="form-label">Weight (in kg) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="weight" id="weight"
                                                class="form-control" placeholder="Enter weight" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="weight" class="form-label">Unit (in kg) <span
                                                    class="text-danger">*</span></label>
                                            <select id="p_unit" name="unit_id" class="form-select" required>
                                                <option value="">Select Unit</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->symbol }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="dimensions" class="form-label">Dimensions (L x W x H in cm) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="dimensions" id="dimensions" class="form-control"
                                        placeholder="Enter dimensions" required>
                                </div>

                                <div class="form-group">
                                    <label for="tags" class="form-label">Select Tag Line</label>
                                    <input type="text" id="tags" name="tags[]" class="form-control"
                                        placeholder="Select or add tags">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="color_input" class="form-label">Available Colors <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="color_input" class="form-control"
                                        placeholder="Enter color name and press 'Add'">
                                    <button type="button" id="add_color_btn" class="btn btn-info btn-sm mt-2"
                                        onclick="addColor()">Add Color</button>
                                    <div id="color-swatches" class="mt-3 d-flex flex-wrap"></div>
                                    <input type="hidden" name="colors[]" id="colors">
                                </div>

                                <div class="form-group">
                                    <label for="images" class="form-label">Product Images <span
                                            class="text-danger">*</span></label>
                                    <div id="image-upload-container" class="image-upload-container">
                                        <div id="image-preview" class="image-preview"></div>
                                        <button type="button" id="add_image_btn" class="add-image-btn"
                                            onclick="document.getElementById('images').click();">
                                            <span>+</span>
                                        </button>
                                        <input type="file" id="images" name="images[]" class="form-control d-none"
                                            accept="image/*" multiple onchange="handleImageFiles(this.files);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">
                                <input type="submit" class="btn btn-sm btn-success" value="Save Product">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <!-- jQuery for AJAX Requests -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#addform').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this); // Prepare FormData
                    $('#description').val(quillDescription.root.innerHTML);
                    $('#shortDescription').val(quillShortDescription.root.innerHTML);
                    $('#shippingInfo').val(quillShippingInfo.root.innerHTML);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('product.store') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            alert('Product saved successfully!');
                            window.location.href =
                                "{{ route('product.index') }}"; // Redirect to index
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", xhr.responseText); // Log error
                            alert('Error: ' + xhr.responseText); // Display error to the user
                        }
                    });
                });

            });
        </script>
    </div>
@endsection
@section('tabledev')
    <script src="{{ asset('admin/customJs/product.js') }}"></script>
    <script src="{{ asset('admin/ajax_crud/product.js') }}"></script>
@endsection
