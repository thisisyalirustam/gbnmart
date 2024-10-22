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
    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>

<style>
    .container {
        max-width: 1200px;
        margin: 20px auto;
    }
    .card {
        background: #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 8px;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }
    .form-control, .form-select {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    .image-upload-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .image-preview {
        display: flex;
        flex-wrap: nowrap;
        gap: 10px;
        align-items: center;
    }
    .image-preview img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }
    .add-image-btn {
        width: 50px;
        height: 50px;
        border: none;
        background-color: #4CAF50;
        color: white;
        font-size: 24px;
        border-radius: 50%;
        cursor: pointer;
    }
    .add-image-btn:hover {
        background-color: #45a049;
    }
    .add-image-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        color: white;
    }
    .btn-success {
        background-color: #28a745;
    }
    .btn-info {
        background-color: #17a2b8;
    }
    .btn-success:hover, .btn-info:hover {
        opacity: 0.85;
    }
    .text-danger {
        color: red;
    }
</style>

<section class="section">
    <div class="container">
        <div class="card shadow p-4 mb-5 bg-white rounded">
            <form id="addform" enctype="multipart/form-data" method="POST" action="{{ route('product.store') }}" class="needs-validation" novalidate>
                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">

                <!-- Product Information Section -->
                <h2 class="mb-3">Product Details</h2>
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- General Product Info -->
                        <div class="form-group">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                        </div>

                        <div class="form-group">
                            <label for="sku" class="form-label">Product SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" id="sku" class="form-control" placeholder="Enter SKU" required>
                        </div>
                        <div class="form-group">
                            <label for="p_category" class="form-label">Product Category <span class="text-danger">*</span></label>
                            <select id="p_category" name="product_category" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="p_sub_cat" class="form-label">Sub Category <span class="text-danger">*</span></label>
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
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" required>
                        </div>

                        <div class="form-group">
                            <label for="discount_price" class="form-label">Discount Price</label>
                            <input type="number" name="discount_price" id="discount_price" class="form-control" placeholder="Enter discount price (optional)">
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity in stock" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Product Description <span class="text-danger">*</span></label>
                            <div id="description-editor"></div>
                            <input type="hidden" id="description" name="description">
                            <small id="descriptionHelp" class="form-text text-muted">Max 1000 characters</small>
                        </div>
                    </div>
                </div>

                <!-- Image Upload and Color Selection -->
                <h2 class="mb-3">Additional Information</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="weight" class="form-label">Weight (in kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="weight" id="weight" class="form-control" placeholder="Enter weight" required>
                        </div>
                        <div class="form-group">
                            <label for="dimensions" class="form-label">Dimensions (L x W x H in cm) <span class="text-danger">*</span></label>
                            <input type="text" name="dimensions" id="dimensions" class="form-control" placeholder="Enter dimensions" required>
                        </div>

                        <div class="form-group">
                            <label for="tags" class="form-label">Select Tag Line</label>
                            <input type="text" id="tags" name="tags[]" class="form-control" placeholder="Select or add tags">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="color_input" class="form-label">Available Colors <span class="text-danger">*</span></label>
                            <input type="text" id="color_input" class="form-control" placeholder="Enter color name and press 'Add'">
                            <button type="button" id="add_color_btn" class="btn btn-info mt-2" onclick="addColor()">Add Color</button>
                            <div id="color-swatches" class="mt-3 d-flex flex-wrap"></div>
                            <input type="hidden" name="colors[]" id="colors">
                        </div>

                        <div class="form-group">
                            <label for="images" class="form-label">Product Images <span class="text-danger">*</span></label>
                            <div id="image-upload-container" class="image-upload-container">
                                <div id="image-preview" class="image-preview"></div>
                                <button type="button" id="add_image_btn" class="add-image-btn" onclick="document.getElementById('images').click();">
                                    <span>+</span>
                                </button>
                                <input type="file" id="images" name="images[]" class="form-control d-none" accept="image/*" multiple onchange="handleImageFiles(this.files);">
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

<!-- AJAX Form Submission -->
<script>
$(document).ready(function() {
    $('#addform').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);  // Prepare FormData
    formData.append('description', quill.root.innerHTML); // Append Quill editor content

    $.ajax({
        type: 'POST',
        url: "{{ route('product.store') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert('Product saved successfully!');
            window.location.href = "{{ route('product.index') }}"; // Redirect to index
        },
        error: function(xhr, status, error) {
            console.log("Error:", xhr.responseText); // Log error
            alert('Error: ' + xhr.responseText); // Display error to the user
        }
    });
});


    // Handle Category Change to Fetch Subcategories and Brands
    $('#p_category').on('change', function() {
        var categoryId = $(this).val();

        if (categoryId) {
            $.ajax({
                url: '/get-subcategories-brands/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate subcategories
                    $('#p_sub_cat').empty().append('<option value="">Select Sub Category</option>');
                    $.each(data.subcategories, function(index, subcategory) {
                        $('#p_sub_cat').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                    });

                    // Populate brands
                    $('#brand').empty().append('<option value="">Select Brand</option>');
                    $.each(data.brands, function(index, brand) {
                        $('#brand').append('<option value="' + brand.id + '">' + brand.name + '</option>');
                    });
                }
            });
        } else {
            $('#p_sub_cat, #brand').empty().append('<option value="">Select Option</option>');
        }
    });
});
</script>

<!-- Quill Editor for Product Description -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
var quill = new Quill('#description-editor', {
    theme: 'snow',
    placeholder: 'Enter product description...',
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered'}, { list: 'bullet' }],
            ['link', 'image']
        ]
    }
});
</script>

<!-- Color Management and Image Preview -->
<script>
let imageArray = [];
let colors = [];

function handleImageFiles(files) {
    const remainingSlots = 7 - imageArray.length;
    const filesToAdd = Array.from(files).slice(0, remainingSlots);
    filesToAdd.forEach(file => {
        if (imageArray.length < 7) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                document.getElementById('image-preview').appendChild(img);
                imageArray.push(file);
                if (imageArray.length === 7) {
                    document.getElementById('add_image_btn').style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
}

function addColor() {
    const colorInput = document.getElementById('color_input');
    const colorName = colorInput.value.trim();

    if (colorName === "" || colors.includes(colorName)) {
        alert("Please enter a unique color.");
        return;
    }

    const colorDiv = document.createElement('div');
    colorDiv.style.backgroundColor = colorName;
    colorDiv.style.width = '30px';
    colorDiv.style.height = '30px';
    colorDiv.style.borderRadius = '10%';
    document.getElementById('color-swatches').appendChild(colorDiv);
    colors.push(colorName);
    document.getElementById('colors').value = JSON.stringify(colors);
    colorInput.value = "";
}
</script>

<!-- Tagify for Tags Input -->
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector('#tags');
    var tagify = new Tagify(input, {
        whitelist: ["iPhone", "MacBook", "Samsung", "PlayStation"],
        maxTags: 10,
        dropdown: {
            maxItems: 20,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false
        }
    });
});
</script>


<!-- Include jQuery if it's not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#addform').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('description', quill.root.innerHTML);
            $.ajax({
                type: 'POST',
                url: "{{ route('product.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Success:', response);
                    alert('Product saved successfully!');
                },
                error: function(xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                    alert('Error saving product!');
                }
            });
        });
    });
    </script>

<script>

    $(document).ready(function() {
        // Listen for changes on the category dropdown
        $('#p_category').on('change', function() {
            var categoryId = $(this).val();  // Get the selected category ID

            if (categoryId) {
                // If a category is selected, make an AJAX request to fetch subcategories and brands
                $.ajax({
                    url: '/get-subcategories-brands/' + categoryId,  // URL to fetch subcategories and brands
                    type: 'GET',  // GET request
                    dataType: 'json',  // Expect JSON response
                    success: function(data) {
                        // Clear and populate the subcategory dropdown
                        $('#p_sub_cat').empty();
                        $('#p_sub_cat').append('<option value="">Select Sub Category</option>');
                        $.each(data.subcategories, function(key, value) {
                            $('#p_sub_cat').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        // Clear and populate the brand dropdown
                        $('#brand').empty();
                        $('#brand').append('<option value="">Select Brand</option>');
                        $.each(data.brands, function(key, value) {
                            $('#brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                        console.log("Response: " + xhr.responseText);
                    }
                });
            } else {
                // If no category is selected, clear both subcategory and brand dropdowns
                $('#p_sub_cat').empty();
                $('#p_sub_cat').append('<option value="">Select Sub Category</option>');

                $('#brand').empty();
                $('#brand').append('<option value="">No Brand Yet</option>');
            }
        });
    });
</script>


<script>

    let imageArray = [];
    let colors = [];

    function handleImageFiles(files) {
        const remainingSlots = 7 - imageArray.length;
        const filesToAdd = Array.from(files).slice(0, remainingSlots);
        filesToAdd.forEach(file => {
            if (imageArray.length < 7) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    document.getElementById('image-preview').appendChild(img);
                    imageArray.push(file);
                    if (imageArray.length === 7) {
                        document.getElementById('add_image_btn').style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function addColor() {
        const colorInput = document.getElementById('color_input');
        const colorName = colorInput.value.trim();
        if (colorName === "" || colors.includes(colorName)) {
            alert("Please enter a unique color.");
            return;
        }
        const colorDiv = document.createElement('div');
        colorDiv.style.backgroundColor = colorName;
        colorDiv.style.width = '30px';
        colorDiv.style.height = '30px';
        colorDiv.style.borderRadius = '10%';
        document.getElementById('color-swatches').appendChild(colorDiv);
        colors.push(colorName);
        document.getElementById('colors').value = JSON.stringify(colors);
        colorInput.value = "";
    }
</script>

<!-- Include Quill Editor CSS & JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


<!-- Custom Script to Handle Quill Editor -->
<script>
    // Initialize Quill editor
    var quill = new Quill('#description-editor', {
        theme: 'snow',
        placeholder: 'Enter product description...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered'}, { list: 'bullet' }],
                ['link', 'image', 'video']
            ]
        }
    });

    // On form submit, store the editor content in hidden input
    document.getElementById('addform').onsubmit = function() {
        document.getElementById('description').value = quill.root.innerHTML;
    };
</script>
<!-- Include Tagify CSS & JS -->
<!-- Include Tagify CSS & JS -->

<!-- Link to Tagify CSS -->
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

<!-- Input field for tags -->


<!-- Include Tagify JS -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector('#tags'); // Get the input element
    var tagify = new Tagify(input, {
        whitelist: ["iPhone 13", "MacBook Pro", "Samsung Galaxy", "PlayStation 5", "Nintendo Switch", "Sony Headphones", "Dell XPS", "Canon Camera"],
        maxTags: 10, // Maximum number of tags
        dropdown: {
            maxItems: 20,    // Max items to show in the dropdown
            classname: "tags-look", // Custom classname for the dropdown
            enabled: 0,      // Always show the dropdown
            closeOnSelect: false // Keep the dropdown open after selecting
        }
    });

    // If you need to handle form submission:
    input.form.addEventListener('submit', (e) => {
        e.preventDefault();  // Prevent the native form submission
        console.log(tagify.value.map(item => item.value));  // Log or process the array of tags
    });
});
</script>

</div>
@endsection
@section('tabledev')
<script src="{{ asset('admin/customJs/product.js') }}"></script>
<script src="{{ asset('admin/ajax_crud/product.js') }}"></script>
@endsection
