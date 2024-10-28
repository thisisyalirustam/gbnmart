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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .dx-datagrid .dx-data-row>td.bullet {
        padding-top: 0;
        padding-bottom: 0;
    }
    .input-group {
        position: relative;
    }
    .input-group-text {
        background-color: #007bff;
        color: white;
    }
    .input-group-text i {
        font-size: 1.2rem;
    }
    .preview {
        border: 1px dashed #ccc;
        padding: 10px;
        margin-top: 10px;
    }
    .preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 0.25rem;
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#add">
                        <i class="bi bi-plus-lg txt-primary"></i> Add New Category
                    </button>
                    <hr>
                    <div id="gridContainer"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Create Modal --}}
<div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addform">
                    @csrf
                    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="sof" class="form-label">Show On Front</label>
                                <select class="form-control" name="sof" id="sof">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputImage" class="form-label">Upload Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control d-none" name="image" id="inputImage" accept="image/*">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fileUploadIcon"><i class="fas fa-upload"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="fileName" placeholder="Choose file..." readonly>
                                </div>
                                <div class="preview mt-3" id="imagePreview" style="display: none;">
                                    <img src="" alt="Image Preview" id="imagePreviewImg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Update Modal --}}
<div class="modal fade" id="update" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Product Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateform">
                    @csrf
                    <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="updateid" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="updatename" class="form-label">Category Name</label>
                                <input type="text" name="name" id="updatename" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="updatesof" class="form-label">Show On Front</label>
                                <select class="form-control" name="sof" id="updatesof">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="updatestatus" class="form-label">Status</label>
                                <select class="form-control" name="status" id="updatestatus">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="updateImage" class="form-label">Upload Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control d-none" id="updateImage" name="image" accept="image/*">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="updateFileUploadIcon"><i class="fas fa-upload"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="updateFileName" placeholder="Choose file..." readonly>
                                </div>
                                <div class="preview mt-3" id="updateImagePreview" style="display: none;">
                                    <img src="" alt="Image Preview" id="updateImagePreviewImg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Record</button>
                </form>
            </div>
        </div>
    </div>
</div>



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
                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE"> <!-- Method override for DELETE -->
                <input type="hidden" id="deleteid" name="id" value="">
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger delete-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function handleFileUpload(inputId, previewId, fileNameId) {
        document.getElementById(inputId).addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            const previewImg = preview.querySelector('img');
            const fileNameInput = document.getElementById(fileNameId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
                fileNameInput.value = file.name;
            } else {
                preview.style.display = 'none';
                fileNameInput.value = '';
            }
        });
    }

    handleFileUpload('inputImage', 'imagePreview', 'fileName');
    handleFileUpload('updateImage', 'updateImagePreview', 'updateFileName');

    document.querySelector('#fileUploadIcon').addEventListener('click', function() {
        document.getElementById('inputImage').click();
    });
    document.getElementById('fileName').addEventListener('click', function() {
        document.getElementById('inputImage').click();
    });

    document.querySelector('#updateFileUploadIcon').addEventListener('click', function() {
        document.getElementById('updateImage').click();
    });
    document.getElementById('updateFileName').addEventListener('click', function() {
        document.getElementById('updateImage').click();
    });
</script>
@endsection
@section('tabledev')
<script src="{{ asset('admin/ajax_crud/productCat.js') }}"></script>
@endsection
