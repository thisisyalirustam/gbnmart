@extends('admin.layout.content')
@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product Category</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
        <!-- Toast Notification -->

    </div>
    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;


        }
        /* Container for the image preview */
        #image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Space between images */
            margin-top: 10px;
        }

        /* Individual image container */
        .image-container {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background-color: #f9f9f9;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Hover effect for image container */
        .image-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Image styling */
        .image-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            /* Ensure the image fits nicely */
            border-radius: 5px;
        }

        /* Remove button styling */
        .remove-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        /* Hover effect for remove button */
        .remove-btn:hover {
            background-color: #ff1a1a;
        }
    </style>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a type="button" class="btn mt-2" href="{{ route('product_create') }}">
                            <i class="bi bi-plus-lg txt-primary"></i> Add New
                        </a>
                        <hr>
                        <div id="gridContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- create model --}}
    {{--    --}}

    <!-- Update Modal -->

    <div class="modal fade" id="update" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert"
                        aria-live="assertive" aria-atomic="true" style="position: fixed; bottom: 20px; right: 20px;">
                        <div class="d-flex">
                            <div class="toast-body" id="toast-message">
                                <!-- Toast message will be inserted here -->
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <button type="button" class="btn-close update-model" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="updateProductForm">
                        @csrf

                        <!-- Product Information Section -->
                        <h2 class="mb-3">Product Details</h2>
                        <div class="row">
                            <!-- Left Column -->
                            <input type="hidden" id="updateid" name="id">
                            <div class="col-lg-6">
                                <!-- General Product Info -->
                                <div class="form-group">
                                    <label for="name" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="updatename" class="form-control"
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
                                    <select id="p_category" name="product_category" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="p_sub_cat" class="form-label">Sub Category <span
                                            class="text-danger">*</span></label>
                                    <select id="p_sub_cat" name="sub_category" class="form-select">
                                        @foreach ($subcategories as $subcat)
                                            <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brand" class="form-label">brand <span
                                            class="text-danger">*</span></label>
                                    <select id="brand" name="brand_id" class="form-select">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
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
                                    <input type="number" name="stock_quantity" id="quantity" class="form-control"
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
                                            <select id="p_unit" name="unit_id" class="form-select">
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
                                    <label for="images">Product Images (Max 7 images)</label>
                                    <div class="upload-area border p-3 text-center">
                                        <!-- File Input for New Images -->
                                        <input type="file" name="images[]" id="images" class="d-none" multiple
                                            accept="image/*">
                                        <label for="images" class="btn btn-outline-primary">
                                            <i class="fas fa-upload"></i> Choose Images
                                        </label>
                                        <small class="form-text text-muted">You can upload up to 7 images.</small>
                                    </div>

                                    <!-- Image Preview Section -->
                                    <div id="image-preview" class="row mt-3">
                                        <!-- Existing Images Will Be Dynamically Populated Here -->
                                    </div>

                                    <!-- Hidden Input for Deleted Images -->
                                    <div id="deleted-images-container"></div>
                                </div>

                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- user show model --}}
    <!-- Modal -->
    <div class="modal fade" id="show" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="productName">Product Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Product Images Slider -->
                    <div id="productImagesSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="image1.jpg" class="d-block w-100" alt="Product Image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="image2.jpg" class="d-block w-100" alt="Product Image 2">
                            </div>
                            <div class="carousel-item">
                                <img src="image3.jpg" class="d-block w-100" alt="Product Image 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productImagesSlider"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productImagesSlider"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Product Details -->
                    <div class="mt-4">
                        <p><strong>Description:</strong> <span id="discription">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.<span></p>
                        <p><strong>Price:</strong> <span class="text-decoration-line-through text-danger"
                                id="discount">€100.00</span> <strong class="text-success"
                                id="show_price">€80.00</strong></p>
                        <p><strong>Quantity:</strong>
                            <input type="number" id="show-quantity" value="1" min="1" max="10"
                                class="form-control" style="width: 100px; display: inline-block;">
                        </p>
                        <p><strong>Weight:</strong> 500g</p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap and jQuery CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- edn of user show model --}}

    {{-- user delete modal --}}
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


    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form id="statusForm">
                    <div class="modal-body text-center">
                        <i class="bi bi-shuffle" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h5 class="modal-title mt-3" style="color: #0d6efd;">Change Status</h5>
                        <p class="text-muted">Are you sure you want to update the status?</p>
                    </div>
                    <div class="modal-body">
                        <select id="newStatus" class="form-control" name="status">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="suspend">Suspend</option>
                            <option value="blocked">Block</option>
                        </select>
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- SOF Change Modal -->
    <div id="sofModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form id="sofForm">
                    <div class="modal-body text-center">
                        <i class="bi bi-eye-fill" style="font-size: 3rem; color: #ffc107;"></i>
                        <p class="text-muted">Are you sure you want to change the visibility on the front page?</p>
                        <select id="newSOF" class="form-control mt-2" name="sof">
                            <option value="1">Yes - Show on Front</option>
                            <option value="0">No - Do Not Show on Front</option>
                        </select>
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Confirm Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to handle new image uploads
        document.getElementById('images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview');
            const files = event.target.files;

            if (files.length + previewContainer.children.length > 7) {
                alert('You can only upload up to 7 images.');
                this.value = ''; // Clear the selected files
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';

                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'image-container position-relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded';
                    img.style.maxHeight = '150px';

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.onclick = function() {
                        col.remove();
                        updateFileInput(files, file);
                    };

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    col.appendChild(imgContainer);
                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            }
        });

        // Function to remove existing images
        function removeImage(button, imageName) {
            const col = button.closest('.col-md-3');
            col.remove();

            // Add the removed image to a hidden input for deletion
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'deleted_images[]';
            deleteInput.value = imageName;
            document.querySelector('form').appendChild(deleteInput);
        }

        // Function to update the file input when removing new images
        function updateFileInput(allFiles, fileToRemove) {
            const dataTransfer = new DataTransfer();
            for (let i = 0; i < allFiles.length; i++) {
                if (allFiles[i] !== fileToRemove) {
                    dataTransfer.items.add(allFiles[i]);
                }
            }
            document.getElementById('images').files = dataTransfer.files;
        }

        // Initialize Bootstrap toasts
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl);
            });
        });
    </script>
@endsection
@section('tabledev')
    <script src="{{ asset('admin/customJs/product.js') }}"></script>
    <script src="{{ asset('admin/ajax_crud/product.js') }}"></script>
@endsection
