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
                            <i class="bi bi-plus-lg txt-primary"></i> Add New Collection
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
                <form id="addform" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Collection Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            </div>

                           
                        </div>

                        <div class="col-md-6">
                            <!-- Status (is_active) -->
                            <div class="mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-control" name="is_active" id="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>

                            <!-- Show on Front -->
                            <div class="mb-3">
                                <label for="show_on_front" class="form-label">Show On Front</label>
                                <select class="form-control" name="show_on_front" id="show_on_front">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <!-- Image Upload -->
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

                    <!-- Submit -->
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
                <h5 class="modal-title">Update Collection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateform" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="updateid" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="updatename" class="form-label">Collection Name</label>
                                <input type="text" name="name" id="updatename" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="updatedescription" class="form-label">Description</label>
                                <textarea name="description" id="updatedescription" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="updatestatus" class="form-label">Status</label>
                                <select class="form-control" name="is_active" id="updatestatus">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="updatesof" class="form-label">Show On Front</label>
                                <select class="form-control" name="show_on_front" id="updatesof">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="updateImage" class="form-label">Upload Image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control d-none" id="updateImage" 
                                           name="image" accept="image/*">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="updateFileUploadIcon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="updateFileName" 
                                           placeholder="Choose file..." readonly>
                                </div>
                                <div class="preview mt-3" id="updateImagePreview" style="display: none;">
                                    <img src="" alt="Image Preview" id="updateImagePreviewImg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Collection</button>
                </form>
            </div>
        </div>
    </div>
</div>

    {{-- user delete modal --}}
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
                    <input type="hidden" name="_method" value="DELETE"> <!-- Method override for DELETE -->
                    <input type="hidden" id="deleteid" name="id" value="">
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <!-- Trigger AJAX delete with onclick -->
                        <button type="button" class="btn btn-danger delete-btn"
                            onclick="submitDeleteForm()">Delete</button>
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
    <script src="{{ asset('admin/ajax_crud/collections.js') }}"></script>
@endsection
