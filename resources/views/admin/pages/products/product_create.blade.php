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
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form id="addform">
                        @csrf
                        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">

                        <!-- Product Information Section -->
                        <div class="row">

                            <!-- Left Column for General Product Info -->
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="brand" class="form-label">Brand Name</label>
                                        <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter brand name (if applicable)">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="sku" class="form-label">Product SKU</label>
                                        <input type="text" name="sku" id="sku" class="form-control" placeholder="Enter SKU (Stock Keeping Unit)" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="p_category" class="form-label">Product Category</label>
                                        <select id="p_category" name="product_category" class="form-select" required>
                                            <option selected disabled>Select Product Category</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="clothing">Clothing</option>
                                            <option value="home_appliances">Home Appliances</option>
                                            <!-- Add more categories as needed -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="p_sub_cat" class="form-label">Sub Category</label>
                                        <select id="p_sub_cat" name="sub_category" class="form-select" required>
                                            <option selected disabled>Select Sub Category</option>
                                            <option value="smartphones">Smartphones</option>
                                            <option value="laptops">Laptops</option>
                                            <option value="accessories">Accessories</option>
                                            <!-- Add more subcategories as needed -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column for Price, Quantity, and Images -->
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity in stock" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="description" class="form-label">Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" maxlength="1000" placeholder="Provide a brief description of the product..." required></textarea>
                                        <small id="descriptionHelp" class="form-text text-muted">Max 1000 characters</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="seo_keywords" class="form-label">SEO Keywords</label>
                                        <input type="text" name="seo_keywords" id="seo_keywords" class="form-control" placeholder="Enter keywords for SEO, separated by commas" required>
                                        <small id="keywordsHelp" class="form-text text-muted">Example: "smartphone, electronics, gadgets"</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="seo_slug" class="form-label">URL Slug (Optional)</label>
                                        <input type="text" name="seo_slug" id="seo_slug" class="form-control" placeholder="Enter custom URL slug for this product">
                                        <small id="slugHelp" class="form-text text-muted">Example: "new-smartphone-2024"</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="seo_meta_desc" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="seo_meta_desc" name="seo_meta_desc" rows="4" maxlength="160" placeholder="Write a brief meta description for SEO (max 160 characters)" required></textarea>
                                        <small id="metaDescHelp" class="form-text text-muted">This will appear in search engine results.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row for Image Uploads -->
                        <div class="row">
                            <div class="col-md-3">
                                <label for="imageUpload1" class="form-label">Upload Image 1</label>
                                <div id="dropArea1" class="border border-primary rounded p-3 text-center drop-area">
                                    <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                    <p>Select Product Image</p>
                                    <input type="file" id="imageUpload1" name="image_1" class="form-control d-none" accept="image/*" required>
                                    <div id="preview1" class="mt-3 preview-container"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="imageUpload2" class="form-label">Upload Image 2</label>
                                <div id="dropArea2" class="border border-primary rounded p-3 text-center drop-area">
                                    <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                    <p>Select Product Image</p>
                                    <input type="file" id="imageUpload2" name="image_2" class="form-control d-none" accept="image/*" required>
                                    <div id="preview2" class="mt-3 preview-container"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="imageUpload3" class="form-label">Upload Image 3</label>
                                <div id="dropArea3" class="border border-primary rounded p-3 text-center drop-area">
                                    <p><i class="bi bi-upload" style="font-size: 2rem; color: #6c757d;"></i></p>
                                    <p>Select Product Image</p>
                                    <input type="file" id="imageUpload3" name="image_3" class="form-control d-none" accept="image/*" required>
                                    <div id="preview3" class="mt-3 preview-container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-3 mt-4">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection
