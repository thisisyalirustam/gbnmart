@extends('admin.layout.content')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<div class="pagetitle">
    <h1>Create New Blog</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.blog') }}" class="text-decoration-none text-muted">Blogs</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Write Your Blog</div>
                <div class="card-body">
                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" id="createBlogForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Blog Title</label>
                            <input type="text" name="title" class="form-control" required>
                            @error('title') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                            @error('status') <div class="error">{{ $message }}</div> @enderror
                        </div>

                      <div class="form-group mb-3">
                            <label class="form-label">Featured Image</label><br>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Blog Content</label>
                            <div id="editor" style="min-height: 300px;"></div>
                            <input type="hidden" name="content" id="contentInput">
                            @error('content') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group d-flex gap-3">
                            <button type="submit" class="btn btn-success">Save Blog</button>
                            <a href="{{ route('admin.blog') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    let quill = new Quill('#editor', {
        theme: 'snow'
    });

    document.getElementById('createBlogForm').addEventListener('submit', function(e) {
        document.getElementById('contentInput').value = quill.root.innerHTML;
    });

    function previewImage(event, index) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview' + index);
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
