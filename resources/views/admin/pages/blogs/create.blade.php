@extends('admin.layout.content')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .pagetitle {
        margin-bottom: 30px;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        background: #ffffff;
        margin-bottom: 25px;
    }

    .card-header {
        background-color: #f0f2f5;
        border-bottom: 1px solid #e9ecef;
        border-radius: 12px 12px 0 0;
        padding: 20px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 1.25rem;
    }

    .card-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 10px;
        color: #34495e;
        font-size: 1rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-size: 0.95rem;
        background: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0,123,255,0.2);
        background: #fff;
    }

    .ql-container {
        border: 1px solid #ced4da;
        border-radius: 8px;
        min-height: 300px;
        background: #fff;
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
    }

    .ql-toolbar {
        border: 1px solid #ced4da;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        background: #f8f9fa;
        padding: 10px;
    }

    .ql-editor {
        padding: 15px;
        line-height: 1.6;
    }

    .ql-editor:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0,123,255,0.2);
        outline: none;
    }

    .btn-save {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: 500;
        font-size: 1rem;
    }

    .btn-save:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: 500;
        font-size: 1rem;
    }

    .btn-cancel:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .image-preview {
        max-width: 350px;
        margin-top: 15px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
        display: none;
    }
</style>

<div class="pagetitle">
    <h1>Create New Blog</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="blogs.html" class="text-decoration-none text-muted">Blogs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Write Your Blog
                </div>
                <div class="card-body">
                    <form id="blogForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter blog title">
                            <div id="titleError" class="error">Title is required.</div>
                        </div>

                        <div class="form-group">
                            <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" required placeholder="Enter author name">
                            <div id="authorError" class="error">Author name is required.</div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="eCommerce">eCommerce</option>
                                <option value="Technology">Technology</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Trends">Trends</option>
                            </select>
                            <div id="categoryError" class="error">Category is required.</div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                            <div id="statusError" class="error">Status is required.</div>
                        </div>

                        <div class="form-group">
                            <label for="featuredImage" class="form-label">Featured Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="featuredImage" name="featuredImage" accept="image/*" onchange="previewImage(event)">
                            <img id="imagePreview" class="image-preview" style="display: none;">
                            <div id="imageError" class="error">Featured image is required.</div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="form-label">Blog Content <span class="text-danger">*</span></label>
                            <div id="editor"></div>
                            <div id="contentError" class="error">Content is required.</div>
                        </div>

                        <div class="form-group d-flex gap-3">
                            <button type="submit" class="btn-save">Save Blog</button>
                            <button type="button" class="btn-cancel" onclick="window.location.href='blogs.html'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quill Script for WordPad-like Editor -->
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize Quill Editor (WordPad-like)
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Write your blog content here...',
    });

    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }

    document.getElementById('blogForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        // Reset errors
        document.querySelectorAll('.error').forEach(error => error.style.display = 'none');

        // Validate fields
        const title = document.getElementById('title').value;
        const author = document.getElementById('author').value;
        const category = document.getElementById('category').value;
        const status = document.getElementById('status').value;
        const featuredImage = document.getElementById('featuredImage').files[0];
        const content = quill.root.innerHTML;

        if (!title) {
            document.getElementById('titleError').style.display = 'block';
            isValid = false;
        }
        if (!author) {
            document.getElementById('authorError').style.display = 'block';
            isValid = false;
        }
        if (!category) {
            document.getElementById('categoryError').style.display = 'block';
            isValid = false;
        }
        if (!status) {
            document.getElementById('statusError').style.display = 'block';
            isValid = false;
        }
        if (!featuredImage) {
            document.getElementById('imageError').style.display = 'block';
            isValid = false;
        }
        if (!content || content === '<p><br></p>') {
            document.getElementById('contentError').style.display = 'block';
            isValid = false;
        }

        if (isValid) {
            // Here you can add code to submit the form data to your backend
            const formData = new FormData();
            formData.append('title', title);
            formData.append('author', author);
            formData.append('category', category);
            formData.append('status', status);
            formData.append('featuredImage', featuredImage);
            formData.append('content', content);

            alert('Blog saved successfully!'); // Placeholder for success message
            // Example: fetch('/api/blogs', { method: 'POST', body: formData })
        }
    });
</script>
@endsection